import { createServer } from 'node:http';
import { existsSync, readFileSync, statSync } from 'node:fs';
import { extname, join } from 'node:path';
import { renderPage } from './render.ts';

const ROOT = join(import.meta.dirname, '..');
const PORT = Number(process.env.PORT ?? 8080);

const routes: Record<string, { title: string; path: string; include: string }> = {
  '/': { title: 'Nord Bean — Искусный кофе для успешного утра', path: '/', include: 'home/content.php' },
  '/menu': { title: 'Меню — Nord Bean', path: '/menu/', include: 'menu/content.php' },
  '/menu/': { title: 'Меню — Nord Bean', path: '/menu/', include: 'menu/content.php' },
  '/about': { title: 'О нас — Nord Bean', path: '/about/', include: 'about/content.php' },
  '/about/': { title: 'О нас — Nord Bean', path: '/about/', include: 'about/content.php' },
  '/contact': { title: 'Контакты — Nord Bean', path: '/contact/', include: 'contact/content.php' },
  '/contact/': { title: 'Контакты — Nord Bean', path: '/contact/', include: 'contact/content.php' },
};

const mimeTypes: Record<string, string> = {
  '.css': 'text/css',
  '.js': 'text/javascript',
  '.json': 'application/json',
  '.svg': 'image/svg+xml',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.webp': 'image/webp',
  '.ico': 'image/x-icon',
};

function serveStatic(urlPath: string, res: import('node:http').ServerResponse): boolean {
  const filePath = join(ROOT, urlPath);

  if (!filePath.startsWith(ROOT) || !existsSync(filePath) || statSync(filePath).isDirectory()) {
    return false;
  }

  const ext = extname(filePath);
  res.writeHead(200, { 'Content-Type': mimeTypes[ext] ?? 'application/octet-stream' });
  res.end(readFileSync(filePath));
  return true;
}

const server = createServer((req, res) => {
  const url = new URL(req.url ?? '/', `http://localhost:${PORT}`);
  const pathname = url.pathname;

  if (pathname !== '/' && extname(pathname)) {
    if (serveStatic(pathname, res)) {
      return;
    }
  }

  const route = routes[pathname];

  if (route) {
    res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
    res.end(renderPage(route.title, route.path, route.include));
    return;
  }

  res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
  res.end('<!DOCTYPE html><html lang="ru"><body><h1>404</h1><p><a href="/">На главную</a></p></body></html>');
});

server.listen(PORT, () => {
  console.log('');
  console.log('  Nord Bean — локальный просмотр');
  console.log(`  Открой в браузере: http://localhost:${PORT}`);
  console.log('  (не localhost:5173)');
  console.log('');
});

server.on('error', (err: NodeJS.ErrnoException) => {
  if (err.code === 'EADDRINUSE') {
    console.error(`\n  Порт ${PORT} занят. Выполни: lsof -ti :${PORT} | xargs kill -9\n`);
    process.exit(1);
  }
  throw err;
});
