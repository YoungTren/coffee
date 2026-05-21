import { readFileSync } from 'node:fs';
import { join } from 'node:path';

const ROOT = join(import.meta.dirname, '..');
const TEMPLATE = join(ROOT, 'local/templates/coffee');

type Catalog = {
  media: { hero: string; interior: string };
  products: Record<string, Array<Record<string, unknown>>>;
  team: Array<{ name: string; role: string }>;
};

const catalog: Catalog = JSON.parse(
  readFileSync(join(TEMPLATE, 'data/catalog.json'), 'utf8'),
);

export function escapeHtml(value: string): string {
  return value
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

export function productMount(product: Record<string, unknown>): string {
  const json = JSON.stringify(product).replace(/'/g, '&#39;');
  return `<div data-vue-product='${json}'></div>`;
}

export function renderProductList(key: string): string {
  return (catalog.products[key] ?? []).map(productMount).join('\n');
}

export function renderImg(url: string, alt: string): string {
  const fallback = catalog.media.hero;
  return `<img src="${escapeHtml(url)}" alt="${escapeHtml(alt)}" loading="lazy" onerror="this.onerror=null;this.src='${escapeHtml(fallback)}'">`;
}

export function renderTeam(): string {
  return catalog.team
    .map(
      (member) => `<article class="coffee-team-card">
  <div class="coffee-team-card__avatar"></div>
  <h3 class="coffee-team-card__name">${escapeHtml(member.name)}</h3>
  <p class="coffee-team-card__role">${escapeHtml(member.role)}</p>
</article>`,
    )
    .join('\n');
}

function stripPhpBlocks(content: string): string {
  return content
    .replace(/<\?php\s+require[^?]*\?>\s*/g, '')
    .replace(/<\?php\s+coffee_render_product_list\('([^']+)'\);\s*\?>/g, (_, key: string) =>
      renderProductList(key),
    )
    .replace(/<\?php\s+coffee_render_team\(\);\s*\?>/g, () => renderTeam())
    .replace(
      /<\?php\s+coffee_img\(\$coffeeMedia\['([^']+)'\],\s*'([^']*)'\);\s*\?>/g,
      (_, key: string, alt: string) => renderImg(catalog.media[key as keyof Catalog['media']], alt),
    )
    .replace(/<\?php[\s\S]*?\?>/g, '')
    .replace(/<\?=[\s\S]*?\?>/g, '');
}

export function renderInclude(relativePath: string): string {
  const file = join(TEMPLATE, 'includes', relativePath);
  return stripPhpBlocks(readFileSync(file, 'utf8'));
}

export function renderHeader(title: string, currentPath: string): string {
  const icons = readFileSync(join(TEMPLATE, 'includes/icons.php'), 'utf8').replace(
    /<\?php[\s\S]*?\?>/g,
    '',
  );

  return `<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${escapeHtml(title)}</title>
    <link rel="stylesheet" href="/local/templates/coffee/assets/dist/main.css">
</head>
<body>
${icons}
<div class="coffee-page">
    <div id="coffee-navigation" data-current="${escapeHtml(currentPath)}"></div>
`;
}

export function renderFooter(): string {
  return `    <footer class="coffee-footer">
        <div class="coffee-footer__glow"></div>
        <div class="coffee-footer__inner">
            <div class="coffee-footer__grid">
                <div>
                    <div class="coffee-header__logo" style="margin-bottom:1.5rem">
                        <div class="coffee-header__logo-icon">
                            <svg width="24" height="24"><use href="#icon-coffee"/></svg>
                        </div>
                        <span class="coffee-header__logo-text">Nord Bean</span>
                    </div>
                    <p class="coffee-footer__brand-text">
                        Привносим скандинавскую кофейную культуру в ваш ежедневный ритуал с 2016 года.
                        Создано с любовью, подается с заботой.
                    </p>
                    <div class="coffee-social" style="margin-top:1.5rem">
                        <a href="#" class="coffee-social__link" aria-label="Instagram"><svg width="20" height="20"><use href="#icon-instagram"/></svg></a>
                        <a href="#" class="coffee-social__link" aria-label="Facebook"><svg width="20" height="20"><use href="#icon-facebook"/></svg></a>
                        <a href="#" class="coffee-social__link" aria-label="Twitter"><svg width="20" height="20"><use href="#icon-twitter"/></svg></a>
                    </div>
                </div>
                <div>
                    <h4 class="coffee-footer__heading">Быстрые ссылки</h4>
                    <ul class="coffee-footer__links">
                        <li><a href="/menu/">Меню</a></li>
                        <li><a href="/about/">О нас</a></li>
                        <li><a href="/about/">Наша история</a></li>
                        <li><a href="/contact/">Вакансии</a></li>
                        <li><a href="/contact/">Контакты</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="coffee-footer__heading">
                        <svg width="20" height="20" style="vertical-align:middle;margin-right:0.5rem"><use href="#icon-clock"/></svg>
                        Часы работы
                    </h4>
                    <div class="coffee-footer__hours-item"><span>Понедельник - Пятница</span><span>7:00 - 20:00</span></div>
                    <div class="coffee-footer__hours-item"><span>Суббота</span><span>8:00 - 21:00</span></div>
                    <div class="coffee-footer__hours-item"><span>Воскресенье</span><span>8:00 - 19:00</span></div>
                </div>
                <div>
                    <h4 class="coffee-footer__heading">Свяжитесь с нами</h4>
                    <div class="coffee-footer__contact-item">
                        <svg width="20" height="20"><use href="#icon-map-pin"/></svg>
                        <span>ул. Северная, 123<br>Москва, Россия</span>
                    </div>
                    <div class="coffee-footer__contact-item">
                        <svg width="20" height="20"><use href="#icon-phone"/></svg>
                        <span>+7 (495) 123-45-67</span>
                    </div>
                    <div class="coffee-footer__contact-item">
                        <svg width="20" height="20"><use href="#icon-mail"/></svg>
                        <span>hello@nordbean.ru</span>
                    </div>
                </div>
            </div>
            <div class="coffee-footer__bottom">
                <p>&copy; ${new Date().getFullYear()} Nord Bean. Все права защищены.</p>
                <div class="coffee-footer__legal">
                    <a href="#">Политика конфиденциальности</a>
                    <a href="#">Условия использования</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<script type="module" src="/local/templates/coffee/assets/dist/main.js"></script>
</body>
</html>
`;
}

export function renderPage(title: string, currentPath: string, includePath: string): string {
  return renderHeader(title, currentPath) + renderInclude(includePath) + renderFooter();
}
