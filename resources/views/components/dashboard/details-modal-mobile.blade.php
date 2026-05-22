{{-- details-modal-mobile.blade.php — shown on mobile only when user taps eye icon
     Usage: <x-dashboard.details-modal-mobile />
     Triggered via: $dispatch('open-details', { rows: [...] })
--}}
<div
  x-data="{ open: false, rows: [] }"
  @open-details.window="open = true; rows = $event.detail.rows"
  @keydown.escape.window="open = false"
  class="md:hidden"
>
  <div x-show="open" class="dash-modal-backdrop" @click.self="open = false" x-transition>
    <div class="dash-modal" @click.stop style="max-height:85vh;overflow-y:auto">
      <div class="dash-modal__header" style="position:sticky;top:0;background:var(--surface-day);z-index:1">
        <h3 class="dash-modal__title">تفاصيل العنصر</h3>
        <button class="dash-modal__close" @click="open = false">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>
      <div class="dash-modal__body">
        <template x-for="row in rows" :key="row.label">
          <div class="dash-details-modal__row">
            <span class="dash-details-modal__label" x-text="row.label"></span>
            <span class="dash-details-modal__value" x-html="row.value"></span>
          </div>
        </template>
      </div>
    </div>
  </div>
</div>