import { cpSync, existsSync, mkdirSync, writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { renderPage } from '../dev/render.ts';

const ROOT = join(import.meta.dirname, '..');
const DIST = join(ROOT, 'dist');
const TEMPLATE_ASSETS = join(ROOT, 'local/templates/coffee/assets');

const pages = [
  {
    file: 'index.html',
    title: 'Nord Bean — Искусный кофе для успешного утра',
    path: '/',
    include: 'home/content.php',
  },
  {
    file: 'menu/index.html',
    title: 'Меню — Nord Bean',
    path: '/menu/',
    include: 'menu/content.php',
  },
  {
    file: 'about/index.html',
    title: 'О нас — Nord Bean',
    path: '/about/',
    include: 'about/content.php',
  },
  {
    file: 'contact/index.html',
    title: 'Контакты — Nord Bean',
    path: '/contact/',
    include: 'contact/content.php',
  },
];

for (const page of pages) {
  mkdirSync(dirname(join(DIST, page.file)), { recursive: true });
  writeFileSync(join(DIST, page.file), renderPage(page.title, page.path, page.include));
}

cpSync(join(TEMPLATE_ASSETS, 'dist'), join(DIST, 'local/templates/coffee/assets/dist'), {
  recursive: true,
});

cpSync(join(TEMPLATE_ASSETS, 'images'), join(DIST, 'local/templates/coffee/assets/images'), {
  recursive: true,
});

if (!existsSync(join(DIST, 'index.html'))) {
  throw new Error('dist/index.html was not generated');
}
