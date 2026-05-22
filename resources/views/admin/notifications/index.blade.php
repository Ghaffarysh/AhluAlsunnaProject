{-- resources/views/admin/notifications/index.blade.php --}
@extends('layouts.dashboard')
@section('title', 'الإشعارات الداخلية')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">الإشعارات</span>
@endsection
@section('content')
<div x-data="{ showForm: false, tableQuery: '' }">
  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">الإشعارات الداخلية</h1>
      <p class="dash-page-header__sub">إرسال تنبيهات ومعلومات لفريق العمل — تظهر في الهيدر وفي الصفحة الرئيسية</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span x-text="showForm ? 'إخفاء' : 'إرسال إشعار'"></span>
      </button>
    </div>
  </div>
  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header"><h2 class="dash-form-card__title">إرسال إشعار جديد</h2></div>
      <form method="POST" action="#">
        @csrf
        <div class="dash-form-card__body"><div class="dash-field"><label class="dash-label">نص الإشعار <span style="color:#c0392b;font-size:.72rem">*</span></label><textarea class="dash-textarea" rows="3" placeholder="نص الإشعار الذي سيصله الفريق..."></textarea></div>
<div class="dash-field__row"><div class="dash-field"><label class="dash-label">المستهدف </label><select class="dash-select"><option value="">اختر...</option><option>جميع الإداريين</option><option>Admin فقط</option><option>شخص محدد</option></select></div><div class="dash-field"><label class="dash-label">مستوى الأهمية </label><select class="dash-select"><option value="">اختر...</option><option>معلومة</option><option>تنبيه</option><option>عاجل</option></select></div></div>
<div class="dash-field"><label class="dash-label">تاريخ انتهاء الإشعار <span class="dash-label__optional">(اختياري)</span></label><input type="date" class="dash-input" placeholder=""></div></div>
        <div class="dash-form-card__footer">
          <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
          <button type="submit" class="dash-btn dash-btn--primary">إرسال</button>
        </div>
      </form>
    </div>
  </div>
  <div class="dash-table-wrap">
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery" placeholder="ابحث في الإشعارات...">
      </div>
      <span class="dash-table-count">إجمالي: <strong>١١</strong> إشعار</span>
    </div>
    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead><tr><th>نص الإشعار</th><th>المستهدف</th><th>المستوى</th><th>تاريخ الإرسال</th><th>قرأه</th><th></th></tr></thead>
        <tbody>
          <tr data-row-id="{{ $loop->iteration }}">
            <td class="dash-table__cell--title">لديك 7 أسئلة فتاوى تنتظر المراجعة</td>
            <td style="font-size:.82rem">جميع الإداريين</td>
            <td><span class="dash-badge dash-badge--pending"><span class="dash-badge__dot"></span>تنبيه</span></td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">منذ ساعة</td>
            <td style="font-size:.84rem;font-weight:600">٣ / ٥</td>
            <td><button type="button" class="dash-btn--delete" @click="$dispatch('open-delete', {id:1, name:'العنصر'})" title="حذف">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                </button></div></div></div>
  </div>
  <x-dashboard.edit-panel formAction="/admin/notifications" />
  <x-dashboard.edit-panel formAction="/admin/notifications" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />
</div>
@endsection