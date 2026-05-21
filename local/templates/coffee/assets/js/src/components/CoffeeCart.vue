<script setup>
import { ref, watch, computed, onMounted, onUnmounted } from 'vue';
import { useCart } from '../composables/cart';
import { useToast } from '../composables/toast';

const {
  items,
  totalCount,
  totalPrice,
  isOpen,
  removeItem,
  changeQuantity,
  clearCart,
  openCart,
  closeCart,
} = useCart();
const { show: showToast } = useToast();

const step = ref('cart');
const deliveryForm = ref({ name: '', phone: '', address: '' });
const pickupForm = ref({ name: '', phone: '', time: '' });

const PICKUP_ADDRESS = 'ул. Северная, 123, Москва';

const headerTitle = computed(() => {
  if (step.value === 'fulfillment') return 'Способ получения';
  if (step.value === 'delivery') return 'Доставка';
  if (step.value === 'pickup') return 'Самовывоз';
  return 'Ваш заказ';
});

const lineTotal = (item) => item.price * item.quantity;

const positionsLabel = (count) => {
  const mod10 = count % 10;
  const mod100 = count % 100;
  if (mod10 === 1 && mod100 !== 11) return 'позиция';
  if (mod10 >= 2 && mod10 <= 4 && (mod100 < 10 || mod100 >= 20)) return 'позиции';
  return 'позиций';
};

const resetStep = () => {
  step.value = 'cart';
  deliveryForm.value = { name: '', phone: '', address: '' };
  pickupForm.value = { name: '', phone: '', time: '' };
};

const handleClose = () => {
  resetStep();
  closeCart();
};

watch(isOpen, (open) => {
  if (!open) {
    resetStep();
  }
});

const startCheckout = () => {
  if (totalCount.value === 0) {
    showToast('Корзина пуста — добавьте напитки из меню');
    return;
  }
  step.value = 'fulfillment';
};

const goBack = () => {
  if (step.value === 'delivery' || step.value === 'pickup') {
    step.value = 'fulfillment';
    return;
  }
  if (step.value === 'fulfillment') {
    step.value = 'cart';
  }
};

const finishOrder = (type) => {
  const sum = totalPrice.value;
  const message =
    type === 'delivery'
      ? `Доставка оформлена на ${sum} ₽. Курьер свяжется с вами.`
      : `Самовывоз оформлен на ${sum} ₽. Ждём вас по адресу: ${PICKUP_ADDRESS}`;
  showToast(message);
  clearCart();
  resetStep();
  closeCart();
};

const submitDelivery = () => {
  finishOrder('delivery');
};

const submitPickup = () => {
  finishOrder('pickup');
};

const onEscape = (event) => {
  if (event.key !== 'Escape' || !isOpen.value) {
    return;
  }
  if (step.value !== 'cart') {
    goBack();
    return;
  }
  handleClose();
};

onMounted(() => {
  document.addEventListener('keydown', onEscape);
});

onUnmounted(() => {
  document.removeEventListener('keydown', onEscape);
});
</script>

<template>
  <Teleport to="body">
    <button
      v-if="totalCount > 0 && !isOpen"
      type="button"
      class="coffee-cart-bar"
      @click="openCart"
    >
      <span class="coffee-cart-bar__label">Корзина</span>
      <span class="coffee-cart-bar__count">{{ totalCount }} {{ positionsLabel(totalCount) }}</span>
      <span class="coffee-cart-bar__sum">{{ totalPrice }} ₽</span>
      <span class="coffee-cart-bar__action">Смотреть</span>
    </button>

    <Transition name="coffee-cart-fade">
      <button
        v-if="isOpen"
        type="button"
        class="coffee-cart__overlay"
        aria-label="Закрыть корзину"
        @click="handleClose"
      />
    </Transition>

    <aside class="coffee-cart" :class="{ 'coffee-cart--open': isOpen }" aria-label="Корзина">
      <div class="coffee-cart__header">
        <div class="coffee-cart__header-start">
          <button
            v-if="step !== 'cart'"
            type="button"
            class="coffee-cart__back"
            aria-label="Назад"
            @click="goBack"
          >
            ←
          </button>
          <div>
            <h2 class="coffee-cart__title">{{ headerTitle }}</h2>
            <p v-if="step === 'cart' && totalCount > 0" class="coffee-cart__subtitle">
              {{ totalCount }} {{ positionsLabel(totalCount) }} в корзине
            </p>
            <p v-else-if="step !== 'cart'" class="coffee-cart__subtitle">Итого: {{ totalPrice }} ₽</p>
          </div>
        </div>
        <button type="button" class="coffee-cart__close" aria-label="Закрыть" @click="handleClose">×</button>
      </div>

      <template v-if="step === 'cart'">
        <div v-if="items.length === 0" class="coffee-cart__empty">
          <p>Корзина пуста</p>
          <p class="coffee-cart__empty-hint">Выберите напитки в меню и нажмите «В корзину»</p>
          <a href="/menu/" class="coffee-header__order" @click="handleClose">Перейти в меню</a>
        </div>

        <ul v-else class="coffee-cart__list">
          <li v-for="item in items" :key="item.id" class="coffee-cart__item">
            <img :src="item.image" :alt="item.name" class="coffee-cart__thumb" />
            <div class="coffee-cart__info">
              <p class="coffee-cart__name">{{ item.name }}</p>
              <p class="coffee-cart__meta">Размер: {{ item.sizeLabel }} · {{ item.price }} ₽</p>
              <div class="coffee-cart__row">
                <div class="coffee-cart__qty">
                  <button type="button" aria-label="Уменьшить" @click="changeQuantity(item.id, -1)">−</button>
                  <span>{{ item.quantity }}</span>
                  <button type="button" aria-label="Добавить" @click="changeQuantity(item.id, 1)">+</button>
                </div>
                <span class="coffee-cart__line-total">{{ lineTotal(item) }} ₽</span>
              </div>
              <button type="button" class="coffee-cart__remove-btn" @click="removeItem(item.id)">
                Удалить
              </button>
            </div>
          </li>
        </ul>

        <div v-if="items.length > 0" class="coffee-cart__footer">
          <div class="coffee-cart__total">
            <span>Итого</span>
            <strong>{{ totalPrice }} ₽</strong>
          </div>
          <button type="button" class="coffee-header__order coffee-cart__checkout" @click="startCheckout">
            Оформить заказ
          </button>
          <button type="button" class="coffee-cart__clear" @click="clearCart">Очистить корзину</button>
        </div>
      </template>

      <div v-else-if="step === 'fulfillment'" class="coffee-cart__step">
        <p class="coffee-cart__step-text">Как хотите получить заказ?</p>
        <button type="button" class="coffee-cart__option" @click="step = 'delivery'">
          <span class="coffee-cart__option-icon">
            <svg width="24" height="24"><use href="#icon-map-pin" /></svg>
          </span>
          <span class="coffee-cart__option-body">
            <span class="coffee-cart__option-title">Доставка</span>
            <span class="coffee-cart__option-desc">Привезём по вашему адресу</span>
          </span>
        </button>
        <button type="button" class="coffee-cart__option" @click="step = 'pickup'">
          <span class="coffee-cart__option-icon">
            <svg width="24" height="24"><use href="#icon-coffee" /></svg>
          </span>
          <span class="coffee-cart__option-body">
            <span class="coffee-cart__option-title">Самовывоз</span>
            <span class="coffee-cart__option-desc">{{ PICKUP_ADDRESS }}</span>
          </span>
        </button>
      </div>

      <form v-else-if="step === 'delivery'" class="coffee-cart__step coffee-cart__form" @submit.prevent="submitDelivery">
        <div class="coffee-form__group">
          <label class="coffee-form__label">Имя</label>
          <input v-model="deliveryForm.name" type="text" class="coffee-form__input" placeholder="Как к вам обращаться" required />
        </div>
        <div class="coffee-form__group">
          <label class="coffee-form__label">Телефон</label>
          <input v-model="deliveryForm.phone" type="tel" class="coffee-form__input" placeholder="+7 (999) 123-45-67" required />
        </div>
        <div class="coffee-form__group">
          <label class="coffee-form__label">Адрес доставки</label>
          <textarea
            v-model="deliveryForm.address"
            class="coffee-form__textarea"
            rows="3"
            placeholder="Улица, дом, подъезд, квартира"
            required
          ></textarea>
        </div>
        <button type="submit" class="coffee-header__order coffee-cart__checkout">Подтвердить доставку</button>
      </form>

      <form v-else-if="step === 'pickup'" class="coffee-cart__step coffee-cart__form" @submit.prevent="submitPickup">
        <div class="coffee-cart__pickup-info">
          <svg width="20" height="20"><use href="#icon-map-pin" /></svg>
          <p>{{ PICKUP_ADDRESS }}</p>
        </div>
        <p class="coffee-cart__step-text">Заберите заказ в кофейне. Обычно готовим за 15–20 минут.</p>
        <div class="coffee-form__group">
          <label class="coffee-form__label">Имя</label>
          <input v-model="pickupForm.name" type="text" class="coffee-form__input" placeholder="Для выдачи заказа" required />
        </div>
        <div class="coffee-form__group">
          <label class="coffee-form__label">Телефон</label>
          <input v-model="pickupForm.phone" type="tel" class="coffee-form__input" placeholder="+7 (999) 123-45-67" required />
        </div>
        <div class="coffee-form__group">
          <label class="coffee-form__label">Желаемое время (необязательно)</label>
          <input v-model="pickupForm.time" type="text" class="coffee-form__input" placeholder="Например, 14:30" />
        </div>
        <button type="submit" class="coffee-header__order coffee-cart__checkout">Подтвердить самовывоз</button>
      </form>
    </aside>
  </Teleport>
</template>
