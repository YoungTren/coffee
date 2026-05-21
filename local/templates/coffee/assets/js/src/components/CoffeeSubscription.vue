<script setup>
import { ref } from 'vue';
import { useToast } from '../composables/toast';

const email = ref('');
const { show: showToast } = useToast();

const handleSubmit = () => {
  showToast('Вы подписаны! Скидка 10% на первый заказ уже ждёт вас.');
  email.value = '';
};
</script>

<template>
  <div class="coffee-subscription">
    <div class="coffee-subscription__card">
      <div class="coffee-subscription__orb coffee-subscription__orb--tr"></div>
      <div class="coffee-subscription__orb coffee-subscription__orb--bl"></div>
      <div class="coffee-subscription__content">
        <div class="coffee-subscription__icon">
          <svg width="32" height="32"><use href="#icon-sparkles" /></svg>
        </div>
        <h2 class="coffee-subscription__title">Получите скидку 10% на первый заказ</h2>
        <p class="coffee-subscription__text">
          Присоединяйтесь к нашему сообществу и получайте эксклюзивные предложения,
          советы по кофе и ранний доступ к новинкам.
        </p>
        <form class="coffee-subscription__form" @submit.prevent="handleSubmit">
          <div class="coffee-subscription__fields">
            <div class="coffee-subscription__input-wrap">
              <span class="coffee-subscription__input-icon">
                <svg width="20" height="20"><use href="#icon-mail" /></svg>
              </span>
              <input
                v-model="email"
                type="email"
                class="coffee-form__input coffee-form__input--with-icon"
                placeholder="Введите ваш email"
                required
              />
            </div>
            <button type="submit" class="coffee-subscription__submit coffee-header__order">Подписаться</button>
          </div>
        </form>
        <p class="coffee-subscription__note">
          К нам уже присоединились 5000+ любителей кофе. Отписаться можно в любой момент.
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.coffee-subscription__submit {
  white-space: nowrap;
}
</style>
