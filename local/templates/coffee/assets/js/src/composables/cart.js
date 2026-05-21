import { reactive, computed, watch } from 'vue';

const STORAGE_KEY = 'coffee-cart';

function loadItems() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    return raw ? JSON.parse(raw) : [];
  } catch {
    return [];
  }
}

const state = reactive({
  items: loadItems(),
  isOpen: false,
});

watch(
  () => state.items,
  (items) => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
  },
  { deep: true },
);

watch(
  () => state.isOpen,
  (open) => {
    document.body.style.overflow = open ? 'hidden' : '';
  },
);

export function useCart() {
  const items = computed(() => state.items);
  const totalCount = computed(() =>
    state.items.reduce((sum, item) => sum + item.quantity, 0),
  );
  const totalPrice = computed(() =>
    state.items.reduce((sum, item) => sum + item.price * item.quantity, 0),
  );
  const isOpen = computed({
    get: () => state.isOpen,
    set: (value) => {
      state.isOpen = value;
    },
  });

  function addItem(product) {
    const existing = state.items.find((item) => item.id === product.id);
    if (existing) {
      existing.quantity += 1;
      return;
    }
    state.items.push({ ...product, quantity: 1 });
  }

  function removeItem(id) {
    const index = state.items.findIndex((item) => item.id === id);
    if (index >= 0) {
      state.items.splice(index, 1);
    }
  }

  function changeQuantity(id, delta) {
    const item = state.items.find((entry) => entry.id === id);
    if (!item) {
      return;
    }
    item.quantity += delta;
    if (item.quantity <= 0) {
      removeItem(id);
    }
  }

  function clearCart() {
    state.items.length = 0;
  }

  function openCart() {
    state.isOpen = true;
  }

  function closeCart() {
    state.isOpen = false;
  }

  return {
    items,
    totalCount,
    totalPrice,
    isOpen,
    addItem,
    removeItem,
    changeQuantity,
    clearCart,
    openCart,
    closeCart,
  };
}
