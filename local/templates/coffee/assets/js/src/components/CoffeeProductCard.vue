<script setup>
import { ref, computed } from 'vue';
import { useCart } from '../composables/cart';
import { useToast } from '../composables/toast';

const FALLBACK_IMAGE = '/local/templates/coffee/assets/images/media/hero.jpg';

const props = defineProps({
  name: { type: String, required: true },
  description: { type: String, required: true },
  image: { type: String, required: true },
  basePrice: { type: Number, required: true },
  noSizes: { type: Boolean, default: false },
});

const sizes = {
  small: { label: 'S', multiplier: 0.8 },
  medium: { label: 'M', multiplier: 1 },
  large: { label: 'L', multiplier: 1.2 },
};

const selectedSize = ref('medium');
const imgSrc = ref(props.image);
const { addItem } = useCart();
const { show: showToast } = useToast();

const onImageError = () => {
  imgSrc.value = FALLBACK_IMAGE;
};

const currentPrice = computed(() => {
  if (props.noSizes) {
    return props.basePrice;
  }
  return Math.round(props.basePrice * sizes[selectedSize.value].multiplier);
});

const addToCart = () => {
  if (props.noSizes) {
    addItem({
      id: props.name,
      name: props.name,
      image: imgSrc.value,
      price: props.basePrice,
      sizeLabel: '',
    });
    showToast(`${props.name} добавлен в корзину`);
    return;
  }
  const size = sizes[selectedSize.value];
  addItem({
    id: `${props.name}-${selectedSize.value}`,
    name: props.name,
    image: imgSrc.value,
    price: currentPrice.value,
    sizeLabel: size.label,
  });
  showToast(`${props.name} (${size.label}) добавлен в корзину`);
};
</script>

<template>
  <article class="coffee-product">
    <div class="coffee-product__card">
      <div class="coffee-product__image-wrap">
        <img :src="imgSrc" :alt="name" class="coffee-product__image" loading="lazy" @error="onImageError" />
        <div class="coffee-product__image-overlay"></div>
        <button type="button" class="coffee-product__add" aria-label="Добавить" @click="addToCart">
          <svg width="24" height="24"><use href="#icon-plus" /></svg>
        </button>
      </div>
      <div class="coffee-product__body">
        <h3 class="coffee-product__name">{{ name }}</h3>
        <p class="coffee-product__desc">{{ description }}</p>
        <div v-if="!noSizes" class="coffee-product__sizes">
          <button
            v-for="(size, key) in sizes"
            :key="key"
            type="button"
            class="coffee-product__size"
            :class="{ 'coffee-product__size--active': selectedSize === key }"
            @click="selectedSize = key"
          >
            {{ size.label }}
          </button>
        </div>
        <div class="coffee-product__footer">
          <span class="coffee-product__price">{{ currentPrice }} ₽</span>
          <button type="button" class="coffee-product__cart-btn" @click="addToCart">В корзину</button>
        </div>
      </div>
    </div>
  </article>
</template>
