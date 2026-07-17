#!/bin/sh
set -e
cd "$(dirname "$0")/.."
SITE_ROOT="$(pwd)"
PROD_PATH=/var/www/medplakaty_r_usr/data/www/medplakaty.ru
HOST=vilmed
PROD_USER=medplakaty_r_usr
REMOTE=origin
BRANCH=master

echo "==> Push local commits (if any)"
git status -sb | head -5
git push "$REMOTE" "$BRANCH"

echo "==> Pull on production via git"
ssh "$HOST" "cd $PROD_PATH &&
  set -e
  git config --global --add safe.directory $PROD_PATH
  if [ -f bitrix/license_key.php ]; then
    cp -a bitrix/license_key.php /tmp/medplakaty_license_key.php.bak
  fi
  if [ -f bitrix/.settings.php ]; then
    cp -a bitrix/.settings.php /tmp/medplakaty_settings.php.bak
  fi
  if [ -f bitrix/php_interface/dbconn.php ]; then
    cp -a bitrix/php_interface/dbconn.php /tmp/medplakaty_dbconn.php.bak
  fi
  if [ -f .htaccess ]; then
    cp -a .htaccess /tmp/medplakaty_htaccess.bak
  fi
  if [ ! -d .git ]; then
    git init
    git remote add $REMOTE https://github.com/bziksv/medplakaty.git
  else
    git remote set-url $REMOTE https://github.com/bziksv/medplakaty.git 2>/dev/null || true
  fi
  GIT_TERMINAL_PROMPT=0 git fetch $REMOTE $BRANCH
  if git rev-parse --verify $BRANCH >/dev/null 2>&1 && git merge-base --is-ancestor HEAD $REMOTE/$BRANCH 2>/dev/null; then
    git merge --ff-only $REMOTE/$BRANCH
  else
    git checkout -B $BRANCH $REMOTE/$BRANCH 2>/dev/null || git branch -M $BRANCH 2>/dev/null || true
    git reset --hard $REMOTE/$BRANCH
  fi
  if [ ! -f bitrix/license_key.php ] && [ -f /tmp/medplakaty_license_key.php.bak ]; then
    cp -a /tmp/medplakaty_license_key.php.bak bitrix/license_key.php
    echo 'restored bitrix/license_key.php'
  fi
  if [ -f /tmp/medplakaty_settings.php.bak ]; then
    cp -a /tmp/medplakaty_settings.php.bak bitrix/.settings.php
  fi
  if [ -f /tmp/medplakaty_dbconn.php.bak ]; then
    cp -a /tmp/medplakaty_dbconn.php.bak bitrix/php_interface/dbconn.php
  fi
  if [ -f /tmp/medplakaty_htaccess.bak ]; then
    cp -a /tmp/medplakaty_htaccess.bak .htaccess
    echo 'restored .htaccess'
  fi
  chown -R ${PROD_USER}:${PROD_USER} .
  rm -rf bitrix/cache/* bitrix/managed_cache/* bitrix/stack_cache/* 2>/dev/null || true
  find bitrix/html_pages -type f -name '*.html' -delete 2>/dev/null || true
  git log -1 --oneline
  echo cache_cleared
"

echo "==> Verify"
/usr/bin/curl -sS -o /dev/null -w 'home %{http_code}\n' --max-time 20 https://medplakaty.ru/
/usr/bin/curl -sS -o /dev/null -w 'catalog section %{http_code}\n' --max-time 20 https://medplakaty.ru/catalog/obuchayushchie-plakaty/
echo "==> Done"
