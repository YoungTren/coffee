<script setup>
import { ref } from 'vue';
import { useToast } from '../composables/toast';

const formData = ref({
  name: '',
  email: '',
  phone: '',
  message: '',
});

const { show: showToast } = useToast();

const handleSubmit = () => {
  showToast('Спасибо! Мы свяжемся с вами в ближайшее время.');
  formData.value = { name: '', email: '', phone: '', message: '' };
};
</script>

<template>
  <div class="coffee-form">
    <h3 class="coffee-form__title">Напишите нам</h3>
    <form @submit.prevent="handleSubmit">
      <div class="coffee-form__group">
        <label class="coffee-form__label">Ваше имя</label>
        <input v-model="formData.name" type="text" class="coffee-form__input" placeholder="Иван Петров" required />
      </div>
      <div class="coffee-form__group">
        <label class="coffee-form__label">Email</label>
        <input v-model="formData.email" type="email" class="coffee-form__input" placeholder="ivan@example.com" required />
      </div>
      <div class="coffee-form__group">
        <label class="coffee-form__label">Телефон</label>
        <input v-model="formData.phone" type="tel" class="coffee-form__input" placeholder="+7 (999) 123-45-67" />
      </div>
      <div class="coffee-form__group">
        <label class="coffee-form__label">Сообщение</label>
        <textarea
          v-model="formData.message"
          class="coffee-form__textarea"
          placeholder="Расскажите нам, чем мы можем вам помочь..."
          rows="6"
          required
        ></textarea>
      </div>
      <button type="submit" class="coffee-form__submit">
        Отправить сообщение
        <svg width="20" height="20" style="margin-left:0.5rem"><use href="#icon-send" /></svg>
      </button>
    </form>
  </div>
</template>
