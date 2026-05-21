import { createApp } from 'vue';
import '../../scss/main.scss';
import CoffeeApp from './components/CoffeeApp.vue';
import CoffeeNavigation from './components/CoffeeNavigation.vue';
import CoffeeProductCard from './components/CoffeeProductCard.vue';
import CoffeeSubscription from './components/CoffeeSubscription.vue';
import CoffeeContactForm from './components/CoffeeContactForm.vue';
import { useToast } from './composables/toast';

const navEl = document.getElementById('coffee-navigation');
if (navEl) {
  createApp(CoffeeNavigation, {
    current: navEl.dataset.current || '/',
  }).mount(navEl);
}

document.querySelectorAll('[data-vue-product]').forEach((el) => {
  const raw = el.getAttribute('data-vue-product');
  const product = JSON.parse(raw);
  createApp(CoffeeProductCard, product).mount(el);
});

const subscriptionEl = document.getElementById('coffee-subscription');
if (subscriptionEl) {
  createApp(CoffeeSubscription).mount(subscriptionEl);
}

const contactFormEl = document.getElementById('coffee-contact-form');
if (contactFormEl) {
  createApp(CoffeeContactForm).mount(contactFormEl);
}

const appEl = document.getElementById('coffee-app');
if (appEl) {
  createApp(CoffeeApp).mount(appEl);
}

document.querySelectorAll('[data-scroll-to]').forEach((btn) => {
  btn.addEventListener('click', () => {
    const target = document.getElementById(btn.dataset.scrollTo);
    target?.scrollIntoView({ behavior: 'smooth' });
  });
});

const { show: showToast } = useToast();
document.querySelectorAll('.coffee-social__link, .coffee-footer__legal a').forEach((el) => {
  if (el.getAttribute('href') === '#') {
    el.addEventListener('click', (event) => {
      event.preventDefault();
      showToast('Раздел скоро появится на сайте');
    });
  }
});
