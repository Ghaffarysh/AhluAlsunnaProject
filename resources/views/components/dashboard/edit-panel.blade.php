{{-- resources/views/components/dashboard/edit-panel.blade.php --}}
{{-- Edit Slide Panel — ينزلق من اليمين عند النقر على تعديل --}}
{{-- يُفعَّل بـ: $dispatch('open-edit', { id, title, fields: [...] }) --}}

<div
  x-data="editPanelData()"
  @open-edit.window="openPanel($event.detail)"
  @keydown.escape.window="closePanel()"
>

  {{-- Backdrop --}}
  <div
    x-show="isOpen"
    class="dash-edit-backdrop"
    @click="closePanel()"
    x-transition:enter="transition-opacity ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display:none"
  ></div>

  {{-- Panel --}}
  <div
    class="dash-edit-panel"
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-250"
    x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full"
    style="display:none"
  >

    {{-- Header --}}
    <div class="dash-edit-panel__header">
      <div>
        <p class="dash-edit-panel__eyebrow">تعديل العنصر</p>
        <h2 class="dash-edit-panel__title" x-text="record.title || 'العنصر'"></h2>
      </div>
      <button class="dash-edit-panel__close" @click="closePanel()" aria-label="إغلاق">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    {{-- Info bar --}}
    <div class="dash-edit-panel__body" style="padding-top:.875rem;padding-bottom:.5rem;border-bottom:1px solid var(--border-day);flex:none">
      <div class="dash-edit-panel__info-row" style="margin-bottom:0">
        <div class="dash-edit-panel__info-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 20h9"/>
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
          </svg>
        </div>
        <div class="dash-edit-panel__info-text">
          <p class="dash-edit-panel__info-label">المعرّف</p>
          <p class="dash-edit-panel__info-value" x-text="'#' + (record.id || '—')"></p>
        </div>
        <div class="dash-edit-panel__info-text" x-show="record.createdAt">
          <p class="dash-edit-panel__info-label">تاريخ الإضافة</p>
          <p class="dash-edit-panel__info-value" x-text="record.createdAt || '—'"></p>
        </div>
      </div>
    </div>

    {{-- Scrollable fields --}}
    <div class="dash-edit-panel__body" id="editPanelBody">

      <template x-for="(f, i) in record.fields || []" :key="i">
        <div class="dash-field">
          <label class="dash-label" x-text="f.label"></label>

          {{-- text / email / number / date / url --}}
          <template x-if="!f.type || ['text','email','number','date','url'].includes(f.type)">
            <input
              :type="f.type || 'text'"
              class="dash-input"
              :name="f.name"
              :value="f.value || ''"
              :placeholder="f.placeholder || ''"
            >
          </template>

          {{-- textarea --}}
          <template x-if="f.type === 'textarea'">
            <textarea
              class="dash-textarea"
              :name="f.name"
              :rows="f.rows || 4"
              :placeholder="f.placeholder || ''"
              x-text="f.value || ''"
            ></textarea>
          </template>

          {{-- select --}}
          <template x-if="f.type === 'select'">
            <select class="dash-select" :name="f.name">
              <template x-for="opt in f.options || []" :key="opt.value">
                <option
                  :value="opt.value"
                  :selected="String(opt.value) === String(f.value)"
                  x-text="opt.label"
                ></option>
              </template>
            </select>
          </template>

          {{-- file --}}
          <template x-if="f.type === 'file'">
            <label class="dash-file-upload">
              <div class="dash-file-upload__icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                  <polyline points="17 8 12 3 7 8"/>
                  <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
              </div>
              <span class="dash-file-upload__label"
                    x-text="f.value ? 'الحالي: ' + f.value : 'اختر ملفاً...'">
              </span>
              <input type="file" :name="f.name" style="display:none" :accept="f.accept || '*'">
            </label>
          </template>

        </div>
      </template>

    </div>{{-- end scrollable --}}

    {{-- Footer --}}
    <div class="dash-edit-panel__footer">
      <div class="dash-edit-panel__footer-left">
        <button
          type="button"
          class="dash-btn dash-btn--danger dash-btn--sm"
          @click="closePanel(); $dispatch('open-delete', {id: record.id, name: record.title})"
        >
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
          </svg>
          حذف
        </button>
      </div>
      <div class="dash-edit-panel__footer-right">
        <button type="button" class="dash-btn dash-btn--ghost" @click="closePanel()">إلغاء</button>
        <button
          type="button"
          class="dash-btn dash-btn--primary"
          @click="submitEdit()"
          :disabled="saving"
        >
          <svg x-show="!saving" width="13" height="13" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          {{-- Spinner --}}
          <svg x-show="saving" width="13" height="13" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2"
               style="animation:dash-spin .7s linear infinite">
            <circle cx="12" cy="12" r="10" stroke-dasharray="60" stroke-dashoffset="20"/>
          </svg>
          <span x-text="saving ? 'جارٍ الحفظ...' : 'حفظ التغييرات'"></span>
        </button>
      </div>
    </div>

  </div>{{-- end panel --}}
</div>

<style>
@keyframes dash-spin { to { transform: rotate(360deg); } }
</style>

<script>
function editPanelData() {
  return {
    isOpen: false,
    saving: false,
    record: {},

    openPanel(detail) {
      this.record  = detail;
      this.saving  = false;
      this.isOpen  = true;
      document.body.style.overflow = 'hidden';
    },

    closePanel() {
      this.isOpen = false;
      document.body.style.overflow = '';
      setTimeout(() => { this.record = {}; }, 250);
    },

    submitEdit() {
      this.saving = true;
      // Simulate async save — replace with fetch('/admin/...', { method:'PUT', ... })
      setTimeout(() => {
        this.saving = false;
        this.closePanel();
        window.dispatchEvent(new CustomEvent('dash-toast', {
          detail: { type: 'success', message: 'تم حفظ التغييرات بنجاح' }
        }));
      }, 800);
    }
  }
}
</script>