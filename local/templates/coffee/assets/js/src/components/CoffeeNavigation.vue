<script setup>
import { ref } from 'vue';

const props = defineProps({
  current: { type: String, default: '/' },
});

const isMenuOpen = ref(false);

const links = [
  { path: '/', label: 'Главная' },
  { path: '/menu/', label: 'Меню' },
  { path: '/about/', label: 'О нас' },
  { path: '/contact/', label: 'Контакты' },
];

const isActive = (path) => {
  const current = props.current.replace(/\/$/, '') || '/';
  const target = path.replace(/\/$/, '') || '/';
  return current === target;
};

const closeMenu = () => {
  isMenuOpen.value = false;
};
</script>

<template>
  <header class="coffee-header">
    <div class="coffee-container coffee-header__inner">
      <a href="/" class="coffee-header__logo" @click="closeMenu">
        <div class="coffee-header__logo-icon">
          <svg width="24" height="24"><use href="#icon-coffee" /></svg>
        </div>
        <span class="coffee-header__logo-text">Nord Bean</span>
      </a>

      <nav class="coffee-header__nav">
        <a
          v-for="link in links"
          :key="link.path"
          :href="link.path"
          class="coffee-header__link"
          :class="{ 'coffee-header__link--active': isActive(link.path) }"
        >
          {{ link.label }}
        </a>
        <a href="/menu/" class="coffee-header__order">Заказать</a>
      </nav>

      <button type="button" class="coffee-header__burger" aria-label="Меню" @click="isMenuOpen = !isMenuOpen">
        <svg width="24" height="24"><use :href="isMenuOpen ? '#icon-x' : '#icon-menu'" /></svg>
      </button>
    </div>

    <div class="coffee-container coffee-header__mobile" :class="{ 'coffee-header__mobile--open': isMenuOpen }">
      <a
        v-for="link in links"
        :key="'m-' + link.path"
        :href="link.path"
        class="coffee-header__link"
        :class="{ 'coffee-header__link--active': isActive(link.path) }"
        @click="closeMenu"
      >
        {{ link.label }}
      </a>
      <a href="/menu/" class="coffee-header__mobile-order" @click="closeMenu">Заказать</a>
    </div>
  </header>
</template>
