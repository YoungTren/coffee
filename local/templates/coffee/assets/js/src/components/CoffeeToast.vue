<script setup>
import { useToast } from '../composables/toast';

const { message, visible, hide } = useToast();
</script>

<template>
  <Transition name="coffee-toast">
    <div v-if="visible" class="coffee-toast" role="status">
      <p class="coffee-toast__text">{{ message }}</p>
      <button type="button" class="coffee-toast__close" aria-label="Закрыть" @click="hide">×</button>
    </div>
  </Transition>
</template>
