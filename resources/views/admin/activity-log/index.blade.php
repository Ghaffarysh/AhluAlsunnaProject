{{-- {-- resources/views/admin/activity-log/index.blade.php --} --}}
@extends('layouts.dashboard')
@section('title', 'سجل النشاط')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">سجل النشاط</span>
@endsection
@section('content')
<div x-data="{ tableQuery: '', activeUser: 'الكل', activeType: 'الكل', dateFrom: '', dateTo: '' }">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">سجل النشاط</h1>
      <p class="dash-page-header__sub">كل العمليات المُنفَّذة في لوحة التحكم — للمراجعة والمساءلة. للقراءة فقط.</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--outline dash-btn--sm">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="7 10 12 15 17 10"/>
          <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        تصدير CSV
      </button>
    </div>
  </div>

  {{-- Filter bar --}}
  <div class="dash-section-card" style="margin-bottom:1.25rem">
    <div class="dash-section-card__body" style="padding:.875rem 1.125rem">
      <div style="display:flex;align-items:center;gap:.875rem;flex-wrap:wrap">

        {{-- User filter --}}
        <div class="dash-field" style="margin:0;min-width:180px;flex:1;max-width:220px">
          <select class="dash-select" style="min-height:38px" x-model="activeUser">
            <option>الكل</option>
            <option>محمد العدني</option>
            <option>أحمد المنصوري</option>
            <option>خالد السالم</option>
          </select>
        </div>

        {{-- Type filter --}}
        <div class="dash-field" style="margin:0;min-width:160px;flex:1;max-width:200px">
          <select class="dash-select" style="min-height:38px" x-model="activeType">
            <option>الكل</option>
            <option>إضافة</option>
            <option>تعديل</option>
            <option>حذف</option>
            <option>نشر</option>
            <option>تعطيل</option>
          </select>
        </div>

        {{-- Date range --}}
        <div style="display:flex;align-items:center;gap:6px;flex-shrink:0">
          <input type="date" class="dash-input" style="min-height:38px;width:150px;padding:7px 10px" x-model="dateFrom">
          <span style="font-size:.78rem;color:var(--text-muted-day)">إلى</span>
          <input type="date" class="dash-input" style="min-height:38px;width:150px;padding:7px 10px" x-model="dateTo">
        </div>

        <span class="dash-table-count" style="margin-right:auto">
          يُعرض: <strong>١٢٠</strong> سجل
        </span>

      </div>
    </div>
  </div>

  {{-- Table --}}
  <div class="dash-table-wrap">
    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr>
            <th>المستخدم</th>
            <th>الدور</th>
            <th>العملية</th>
            <th>المحتوى المتأثر</th>
            <th>الوقت</th>
          </tr>
        </thead>
        <tbody>
          @php $logs = [
            ['محمد العدني',    'Super Admin',   'add',     'أضاف درساً:',    'شرح الأصول — الدرس ٣',                   'الآن'],
            ['أحمد المنصوري', 'General Admin', 'publish', 'نشر فتوى:',       'حكم قراءة القرآن من الهاتف',             'منذ ٢٠ دقيقة'],
            ['خالد السالم',   'Admin',         'edit',    'عدّل مقرراً:',    'العقيدة الواسطية',                       'منذ ساعة'],
            ['خالد السالم',   'Admin',         'add',     'أضاف خطبة:',      'التوحيد وأنواعه الثلاثة',               'منذ ٣ ساعات'],
            ['فاطمة الزهراء', 'Admin',         'add',     'أضافت كتاباً:',   'الأربعون النووية — طبعة جديدة',          'أمس ١٠:٢٢'],
            ['محمد العدني',   'Super Admin',   'delete',  'حذف مستخدم:',    'حساب عبد الله الحربي',                   'أمس ٩:١٥'],
            ['أحمد المنصوري', 'General Admin', 'reject',  'رفض رداً:',       'رد غير موثّق على شبهة الإرث',           'أمس ٨:٠٠'],
          ]; @endphp

          @foreach($logs as [$user,$role,$type,$action,$target,$time])
            @php
              $typeConfig = [
                'add'     => ['icon'=>'<line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>',         'bg'=>'rgba(61,122,80,0.1)',   'color'=>'#3d7a50',  'label'=>'إضافة'],
                'edit'    => ['icon'=>'<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>',
                              'bg'=>'rgba(4,95,114,0.1)',    'color'=>'var(--primary)', 'label'=>'تعديل'],
                'delete'  => ['icon'=>'<polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>',  'bg'=>'rgba(192,57,43,0.1)',  'color'=>'#c0392b',  'label'=>'حذف'],
                'publish' => ['icon'=>'<polyline points="20 6 9 17 4 12"/>',                                                      'bg'=>'rgba(177,147,70,0.1)', 'color'=>'#8a6a28',  'label'=>'نشر'],
                'reject'  => ['icon'=>'<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',            'bg'=>'rgba(192,57,43,0.08)', 'color'=>'#c0392b',  'label'=>'رفض'],
              ][$type] ?? ['icon'=>'','bg'=>'','color'=>'','label'=>$type];
            @endphp
            <tr>
              <td>
                <div style="display:flex;align-items:center;gap:9px">
                  <div style="width:30px;height:30px;border-radius:8px;background:rgba(4,95,114,0.1);color:var(--primary);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.78rem;flex-shrink:0">
                    {{ mb_substr($user,0,1,'UTF-8') }}
                  </div>
                  <span style="font-size:.85rem;font-weight:500;color:var(--text-day)">{{ $user }}</span>
                </div>
              </td>
              <td style="font-size:.78rem;color:var(--text-muted-day)">{{ $role }}</td>
              <td>
                <div style="display:inline-flex;align-items:center;gap:6px;padding:3px 9px;border-radius:100px;background:{{ $typeConfig['bg'] }};color:{{ $typeConfig['color'] }}">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                       stroke-linecap="round">{!! $typeConfig['icon'] !!}</svg>
                  <span style="font-size:.72rem;font-weight:700">{{ $typeConfig['label'] }}</span>
                </div>
              </td>
              <td>
                <span style="font-size:.79rem;color:var(--text-muted-day)">{{ $action }}</span>
                <span style="font-size:.84rem;font-weight:500;color:var(--text-day)"> {{ $target }}</span>
              </td>
              <td style="font-size:.78rem;color:var(--text-muted-day);white-space:nowrap">{{ $time }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Mobile: activity list style --}}
    <div class="dash-table-mobile" style="padding:.5rem 0">
      <ul class="dash-activity-list" style="padding:0 1rem">
        @foreach([['محمد العدني','أضاف درساً: شرح الأصول — الدرس ٣','add','الآن'],['أحمد المنصوري','نشر فتوى: حكم قراءة القرآن','publish','منذ ٢٠ دقيقة'],['خالد السالم','عدّل مقرر: العقيدة الواسطية','edit','منذ ساعة']] as [$u,$t,$type,$time])
          <li class="dash-activity-item">
            <div class="dash-activity-item__icon dash-activity-item__icon--{{ $type }}">
              @if($type==='add')
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              @elseif($type==='edit')
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              @else
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
              @endif
            </div>
            <div class="dash-activity-item__body">
              <p class="dash-activity-item__text"><strong>{{ $u }}</strong> — {{ $t }}</p>
              <p class="dash-activity-item__time">{{ $time }}</p>
            </div>
          </li>
        @endforeach
      </ul>
    </div>

    {{-- Pagination --}}
    <div style="display:flex;align-items:center;justify-content:space-between;padding:.875rem 1.125rem;border-top:1px solid var(--border-day)">
      <button class="dash-btn dash-btn--ghost dash-btn--sm">السابق</button>
      <span style="font-size:.78rem;color:var(--text-muted-day)">صفحة ١ من ١٢</span>
      <button class="dash-btn dash-btn--ghost dash-btn--sm">التالي</button>
    </div>
  </div>

</div>
@endsection