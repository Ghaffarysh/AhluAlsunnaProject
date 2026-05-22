{{-- resources/views/components/dashboard/toast.blade.php --}}
{{-- يُفعَّل بـ: $dispatch('dash-toast', { type: 'success'|'error'|'warning'|'info', message }) --}}
{{-- يختفي بعد 3 ثوانٍ، وفيه زر X لإزالته فوراً --}}

<div
  x-data="toastManager()"
  @dash-toast.window="addToast($event.detail)"
  class="dash-toast-container"
  aria-live="polite"
  aria-label="إشعارات النظام"
>
  <template x-for="toast in toasts" :key="toast.id">
    <div
      class="dash-toast"
      :class="`dash-toast--${toast.type}`"
      x-show="toast.visible"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 translate-y-3 scale-95"
      x-transition:enter-end="opacity-100 translate-y-0 scale-100"
      x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100 translate-y-0 scale-100"
      x-transition:leave-end="opacity-0 translate-y-2 scale-95"
      role="alert"
    >
      {{-- Icon --}}
      <div class="dash-toast__icon">
        {{-- success --}}
        <template x-if="toast.type === 'success'">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </template>
        {{-- error --}}
        <template x-if="toast.type === 'error'">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="15" y1="9" x2="9" y2="15"/>
            <line x1="9" y1="9" x2="15" y2="15"/>
          </svg>
        </template>
        {{-- warning --}}
        <template x-if="toast.type === 'warning'">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
        </template>
        {{-- info --}}
        <template x-if="toast.type === 'info'">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
        </template>
      </div>

      {{-- Message --}}
      <span class="dash-toast__message" x-text="toast.message"></span>

      {{-- Progress bar --}}
      <div class="dash-toast__progress">
        <div class="dash-toast__progress-bar"
             :class="`dash-toast__progress-bar--${toast.type}`"
             :style="`animation-duration: ${toast.duration}ms`">
        </div>
      </div>

      {{-- Close button --}}
      <button
        class="dash-toast__close"
        @click="removeToast(toast.id)"
        aria-label="إغلاق"
      >
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2.5" stroke-linecap="round">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>

    </div>
  </template>
</div>

<script>
function toastManager() {
  return {
    toasts: [],
    counter: 0,

    addToast({ type = 'info', message = '', duration = 3000 }) {
      const id = ++this.counter;
      this.toasts.push({ id, type, message, duration, visible: true });

      setTimeout(() => this.removeToast(id), duration);
    },

    removeToast(id) {
      const toast = this.toasts.find(t => t.id === id);
      if (toast) {
        toast.visible = false;
        setTimeout(() => {
          this.toasts = this.toasts.filter(t => t.id !== id);
        }, 250);
      }
    }
  }
}
</script>