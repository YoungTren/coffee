<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$templatePath = SITE_TEMPLATE_PATH;
?>
    <footer class="coffee-footer">
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
                <p>&copy; <?= date('Y') ?> Nord Bean. Все права защищены.</p>
                <div class="coffee-footer__legal">
                    <a href="#">Политика конфиденциальности</a>
                    <a href="#">Условия использования</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php if (defined('COFFEE_DEV') && COFFEE_DEV): ?>
<script type="module" src="http://localhost:5173/local/templates/coffee/assets/js/src/main.js"></script>
<?php else: ?>
<script type="module" src="<?= $templatePath ?>/assets/dist/main.js"></script>
<?php endif; ?>
</body>
</html>
