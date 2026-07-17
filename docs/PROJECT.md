# medplakaty.ru — документация проекта

Bitrix-интернет-магазин медицинских плакатов и стендов (шаблон **medical-templates**).

## Репозиторий и окружения

| | |
|---|---|
| GitHub | https://github.com/bziksv/medplakaty |
| **Git root** | `medplakaty.ru/` (= корень сайта на prod), ветка **master** |
| Prod IP | `217.28.220.186` (SSH: `vilmed`) |
| Prod path | `/var/www/medplakaty_r_usr/data/www/medplakaty.ru` |
| Домен | https://medplakaty.ru |
| Локально | http://127.0.0.1:8090/ |

Родительская папка `medplakaty/` — **не в git**: дампы БД (`medplakaty_r.sql`, `medplakaty_r.sql.gz`), `.cursorignore`.

## Структура

```
medplakaty/                    # workspace (Mac)
├── medplakaty_r.sql           # дамп БД (не в git)
├── medplakaty_r.sql.gz
├── .cursorignore
└── medplakaty.ru/             # git root
    ├── .cursor/rules/         # правила Cursor
    ├── .local/                # nginx/php-fpm (Mac)
    ├── docs/                  # документация
    ├── scripts/               # dev + deploy
    ├── bitrix/
    ├── upload/                # не в git
    └── personal/
```

## Git — что в репозитории

**В git:** код сайта, `bitrix/modules/`, шаблоны, компоненты, `scripts/`, `docs/`, `.local/*.example`, `.local/nginx/`, `.local/php/`.

**Не в git:** `upload/`, кэш Bitrix, секреты (`.settings.php`, `dbconn.php`, `license_key.php`), дампы `*.sql`, `.local/db.env`, `.local/run/`.

## Локальная разработка (Mac, soft)

Порты: **8090** (nginx), **9090** (php-fpm). MySQL 3306 (Homebrew).

```bash
cd medplakaty.ru
cp .local/db.env.example .local/db.env   # один раз
./scripts/setup-local-db.sh --background # один раз, импорт дампа
./scripts/start-dev.sh
./scripts/stop-dev.sh
```

Soft-режим: php-fpm `ondemand`, max 2 workers, 256M RAM, opcache 64M.

### Занятые порты (соседние проекты)

| Порт | Проект |
|------|--------|
| 8080 | almamed |
| 8082 | vilmed |
| 8083 | kosmamed |
| 8084 | polimer |
| 8085 | lormag |
| 8086 | metplus-vrn |
| 8087 | oftalmag |
| 8088 | metprof-vrn |
| 8089 | (занят) |
| **8090** | **medplakaty** |
| **9090** | **medplakaty php-fpm** |

## Деплой на prod

**Два отдельных шага — не путать:**

| Шаг | Когда | Команда |
|-----|-------|---------|
| 1. Git | После **любых** правок кода | `git commit` + `git push origin master` |
| 2. Prod | **Только** когда пользователь явно попросил | `./scripts/deploy-prod.sh` |

Push в GitHub **не выкатывает** сайт на prod автоматически.

```bash
cd medplakaty.ru
git add … && git commit -m "…" && git push origin master   # после правок

# только когда пользователь просит:
./scripts/deploy-prod.sh
```

**Запрещено:** автодеплой на prod, правки на prod без commit, `scp` файлов кода.

Скрипт деплоя:
- `git push` → на сервере `git fetch` + `merge --ff-only origin/master`
- бэкап и восстановление `.settings.php`, `dbconn.php`, `license_key.php`
- сброс кэша Bitrix

## Стек

- 1C-Bitrix **22.500.700** (2023), PHP 8.3 локально (soft)
- Шаблон сайта: `bitrix/templates/medical-templates`
- Прочие шаблоны: `desktop_app`, `eshop_app`, `landing24`

## Проверка после изменений

```bash
curl -sS -o /dev/null -w '%{http_code}\n' https://medplakaty.ru/
```

Локально: `./scripts/start-dev.sh` и curl на `:8090`.
