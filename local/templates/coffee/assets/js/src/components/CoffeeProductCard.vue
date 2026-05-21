<script setup>
import { ref, computed } from 'vue';

const FALLBACK_IMAGE =
  'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1080&q=80';

const props = defineProps({
  name: { type: String, required: true },
  description: { type: String, required: true },
  image: { type: String, required: true },
  basePrice: { type: Number, required: true },
});

const sizes = {
  small: { label: 'S', multiplier: 0.8 },
  medium: { label: 'M', multiplier: 1 },
  large: { label: 'L', multiplier: 1.2 },
};

const selectedSize = ref('medium');
const imgSrc = ref(props.image);

const onImageError = () => {
  imgSrc.value = FALLBACK_IMAGE;
};

const currentPrice = computed(() =>
  Math.round(props.basePrice * sizes[selectedSize.value].multiplier),
);
</script>

<template>
  <article class="coffee-product">
    <div class="coffee-product__card">
      <div class="coffee-product__image-wrap">
        <img :src="imgSrc" :alt="name" class="coffee-product__image" loading="lazy" @error="onImageError" />
        <div class="coffee-product__image-overlay"></div>
        <button type="button" class="coffee-product__add" aria-label="Добавить">
          <svg width="24" height="24"><use href="#icon-plus" /></svg>
        </button>
      </div>
      <div class="coffee-product__body">
        <h3 class="coffee-product__name">{{ name }}</h3>
        <p class="coffee-product__desc">{{ description }}</p>
        <div class="coffee-product__sizes">
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
          <button type="button" class="coffee-product__cart-btn">В корзину</button>
        </div>
      </div>
    </div>
  </article>
</template>
