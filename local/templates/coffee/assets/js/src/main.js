import { createApp } from 'vue';
import '../../scss/main.scss';
import CoffeeNavigation from './components/CoffeeNavigation.vue';
import CoffeeProductCard from './components/CoffeeProductCard.vue';
import CoffeeSubscription from './components/CoffeeSubscription.vue';
import CoffeeContactForm from './components/CoffeeContactForm.vue';

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

document.querySelectorAll('[data-scroll-to]').forEach((btn) => {
  btn.addEventListener('click', () => {
    const target = document.getElementById(btn.dataset.scrollTo);
    target?.scrollIntoView({ behavior: 'smooth' });
  });
});
