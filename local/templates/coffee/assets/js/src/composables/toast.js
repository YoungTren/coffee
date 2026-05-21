import { reactive, computed } from 'vue';

const state = reactive({
  message: '',
  visible: false,
});

let hideTimer;

export function useToast() {
  const message = computed(() => state.message);
  const visible = computed(() => state.visible);

  function show(text) {
    state.message = text;
    state.visible = true;
    clearTimeout(hideTimer);
    hideTimer = setTimeout(() => {
      state.visible = false;
    }, 3000);
  }

  function hide() {
    state.visible = false;
    clearTimeout(hideTimer);
  }

  return { message, visible, show, hide };
}
