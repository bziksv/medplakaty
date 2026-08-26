#!/usr/bin/env node
/**
 * Генерация PNG из legal/print.php (без шапки и подвала сайта).
 * Запуск: node scripts/generate-legal-pngs.mjs [baseUrl]
 */
import puppeteer from 'puppeteer';
import { mkdir } from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const siteRoot = path.resolve(__dirname, '..');
const assetsDir = path.join(siteRoot, 'legal', 'assets');
const baseUrl = (process.argv[2] || 'http://127.0.0.1:8100').replace(/\/$/, '');

const docs = [
	{ doc: 'politika-pdn', file: 'politika-pdn.png' },
	{ doc: 'soglasie-pdn', file: 'soglasie-pdn.png' },
	{ doc: 'cookie', file: 'cookie.png' },
	{ doc: 'rekomendatelnye-tehnologii', file: 'rekomendatelnye-tehnologii.png' },
];

await mkdir(assetsDir, { recursive: true });

const browser = await puppeteer.launch({
	headless: true,
	args: ['--no-sandbox', '--disable-setuid-sandbox'],
});

try {
	for (const { doc, file } of docs) {
		const url = `${baseUrl}/legal/print.php?doc=${doc}`;
		const page = await browser.newPage();
		await page.setViewport({ width: 980, height: 800, deviceScaleFactor: 2 });
		await page.goto(url, { waitUntil: 'networkidle0', timeout: 120000 });
		await page.evaluate(async () => {
			await document.fonts?.ready;
		});
		const outPath = path.join(assetsDir, file);
		await page.screenshot({ path: outPath, fullPage: true, type: 'png' });
		await page.close();
		console.log(`${url} -> legal/assets/${file}`);
	}
} finally {
	await browser.close();
}
