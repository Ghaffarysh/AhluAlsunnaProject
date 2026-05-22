{{-- resources/views/components/dashboard/confirm-delete-modal.blade.php --}}
{{-- يُفعَّل بـ: $dispatch('open-delete', { id, name }) --}}
{{-- عند التأكيد يحذف الصف بدون reload ويظهر toast --}}

<div
  x-data="confirmDeleteData()"
  @open-delete.window="openModal($event.detail)"
  @keydown.escape.window="closeModal()"
>

  {{-- Backdrop --}}
  <div
    x-show="isOpen"
    class="dash-modal-backdrop"
    @click.self="closeModal()"
    x-transition:enter="transition-opacity ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display:none"
  >

    {{-- Modal card --}}
    <div
      class="dash-modal dash-modal--delete"
      @click.stop
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 scale-95 translate-y-2"
      x-transition:enter-end="opacity-100 scale-100 translate-y-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 scale-100"
      x-transition:leave-end="opacity-0 scale-95"
    >

      {{-- Header --}}
      <div class="dash-modal__header">
        <h3 class="dash-modal__title">تأكيد الحذف</h3>
        <button class="dash-modal__close" @click="closeModal()" aria-label="إغلاق">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      {{-- Body --}}
      <div class="dash-modal__body">
        <div style="display:flex;gap:14px;align-items:flex-start">
          <div style="width:44px;height:44px;border-radius:12px;background:rgba(192,57,43,0.1);
                       color:#c0392b;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="3 6 5 6 21 6"/>
              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
            </svg>
          </div>
          <div>
            <p style="font-size:.9rem;font-weight:600;color:var(--text-day);margin-bottom:6px">
              هل تريد حذف
              "<span x-text="itemName" style="color:#c0392b"></span>"؟
            </p>
            <p style="font-size:.82rem;color:var(--text-muted-day);line-height:1.6">
              لا يمكن التراجع عن هذه العملية. سيتم حذف هذا العنصر وجميع البيانات المرتبطة به نهائياً.
            </p>
          </div>
        </div>
      </div>

      {{-- Footer --}}
      <div class="dash-modal__footer">
        <button type="button" class="dash-btn dash-btn--ghost" @click="closeModal()" :disabled="deleting">
          إلغاء
        </button>
        <button
          type="button"
          class="dash-btn dash-btn--danger"
          @click="confirmDelete()"
          :disabled="deleting"
        >
          {{-- Spinner --}}
          <svg x-show="deleting" width="13" height="13" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2"
               style="animation:dash-spin .7s linear infinite">
            <circle cx="12" cy="12" r="10" stroke-dasharray="60" stroke-dashoffset="20"/>
          </svg>
          <svg x-show="!deleting" width="13" height="13" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
          </svg>
          <span x-text="deleting ? 'جارٍ الحذف...' : 'نعم، احذف'"></span>
        </button>
      </div>

    </div>{{-- end modal card --}}
  </div>{{-- end backdrop --}}
</div>

<script>
function confirmDeleteData() {
  return {
    isOpen:   false,
    deleting: false,
    itemId:   null,
    itemName: '',

    openModal(detail) {
      this.itemId   = detail.id;
      this.itemName = detail.name || 'العنصر';
      this.deleting = false;
      this.isOpen   = true;
      document.body.style.overflow = 'hidden';
    },

    closeModal() {
      if (this.deleting) return;
      this.isOpen = false;
      document.body.style.overflow = '';
    },

    confirmDelete() {
      this.deleting = true;

      // ── محاكاة طلب الحذف ──────────────────────────────────────
      // استبدل هذا بـ:
      // fetch(`/admin/resource/${this.itemId}`, { method:'DELETE',
      //   headers:{'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content}
      // }).then(r => r.ok ? this.onSuccess() : this.onError())
      //   .catch(() => this.onError());

      setTimeout(() => {
        const success = Math.random() > 0.15; // 85% success في الـ demo
        this.isOpen   = false;
        this.deleting = false;
        document.body.style.overflow = '';

        if (success) {
          // إخفاء الصف من الـ DOM
          const row = document.querySelector(`[data-row-id="${this.itemId}"]`);
          if (row) {
            row.style.transition = 'opacity .3s ease, transform .3s ease, max-height .4s ease';
            row.style.opacity    = '0';
            row.style.transform  = 'translateX(20px)';
            setTimeout(() => row.remove(), 350);
          }
          window.dispatchEvent(new CustomEvent('dash-toast', {
            detail: { type: 'success', message: `تم حذف "${this.itemName}" بنجاح` }
          }));
        } else {
          window.dispatchEvent(new CustomEvent('dash-toast', {
            detail: { type: 'error', message: 'حدث خطأ أثناء الحذف — يرجى المحاولة مجدداً' }
          }));
        }
      }, 900);
    }
  }
}
</script>