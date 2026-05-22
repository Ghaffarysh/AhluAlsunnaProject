{{-- form-card.blade.php
     Usage: <x-dashboard.form-card title="إضافة مقرر" action="/admin/curricula" method="POST">
               ...fields...
             </x-dashboard.form-card>
--}}
<div class="dash-form-card">
  <div class="dash-form-card__header">
    <h2 class="dash-form-card__title">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
      </svg>
      {{ $title }}
    </h2>
    @if(isset($headerActions)){{ $headerActions }}@endif
  </div>
  <form
    method="{{ in_array(strtoupper($method ?? 'POST'), ['GET','POST']) ? strtoupper($method ?? 'POST') : 'POST' }}"
    action="{{ $action ?? '#' }}"
    enctype="multipart/form-data"
    x-data="{{ $alpine ?? '{}' }}"
  >
    @csrf
    @if(!empty($method) && strtoupper($method) !== 'POST' && strtoupper($method) !== 'GET')
      @method(strtoupper($method))
    @endif
    <div class="dash-form-card__body">
      {{ $slot }}
    </div>
    <div class="dash-form-card__footer">
      @if(isset($footer))
        {{ $footer }}
      @else
        <button type="button" class="dash-btn dash-btn--ghost" onclick="history.back()">إلغاء</button>
        <button type="submit" class="dash-btn dash-btn--primary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          {{ $submitLabel ?? 'حفظ' }}
        </button>
      @endif
    </div>
  </form>
</div>