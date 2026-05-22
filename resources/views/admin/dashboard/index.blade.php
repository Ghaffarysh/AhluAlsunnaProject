{{-- {-- resources/views/admin/dashboard/index.blade.php --} --}}
@extends('layouts.dashboard')

@section('title', 'الرئيسية')

@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">الرئيسية</span>
@endsection

@section('content')

{{-- Fatwa Alert — Von Restorff: most urgent item first --}}
<div class="dash-alert dash-alert--warning" style="margin-bottom:1.25rem">
  <div class="dash-alert__icon">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
    </svg>
  </div>
  <div class="dash-alert__body">
    <p class="dash-alert__title">لديك 7 أسئلة فتاوى جديدة تنتظر المراجعة</p>
    <p class="dash-alert__desc">آخر سؤال وصل منذ ١٢ دقيقة. المراجعة السريعة تُقلل من انتظار الزوار.</p>
    <a href="/admin/fatwas/questions" class="dash-alert__action">
      راجع الأسئلة الآن
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
        <path d="M5 12h14M12 5l7 7-7 7"/>
      </svg>
    </a>
  </div>
</div>

{{-- Page header --}}
<div class="dash-page-header">
  <div class="dash-page-header__text">
    <h1 class="dash-page-header__title">مرحباً، محمد</h1>
    <p class="dash-page-header__sub">نظرة عامة على حالة الموسوعة — {{ now()->format('d M Y') }}</p>
  </div>
</div>

{{-- Stats grid — Miller: 4 cards maximum --}}
<div class="dash-stats-grid">
  <div class="dash-stat-card">
    <div class="dash-stat-card__top">
      <span class="dash-stat-card__label">المقررات المنشورة</span>
      <div class="dash-stat-card__icon dash-stat-card__icon--primary">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
      </div>
    </div>
    <div class="dash-stat-card__value">١٤٧</div>
    <span class="dash-stat-card__delta">
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
      +٣ هذا الأسبوع
    </span>
  </div>

  <div class="dash-stat-card">
    <div class="dash-stat-card__top">
      <span class="dash-stat-card__label">الدروس المنشورة</span>
      <div class="dash-stat-card__icon dash-stat-card__icon--accent">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/>
        </svg>
      </div>
    </div>
    <div class="dash-stat-card__value">٢٠٤٨</div>
    <span class="dash-stat-card__delta">+١٢ هذا الأسبوع</span>
  </div>

  <div class="dash-stat-card">
    <div class="dash-stat-card__top">
      <span class="dash-stat-card__label">الفتاوى المنشورة</span>
      <div class="dash-stat-card__icon dash-stat-card__icon--green">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>
      </div>
    </div>
    <div class="dash-stat-card__value">٥٢٣</div>
    <span class="dash-stat-card__delta">+٧ هذا الشهر</span>
  </div>

  <div class="dash-stat-card">
    <div class="dash-stat-card__top">
      <span class="dash-stat-card__label">كتب المكتبة</span>
      <div class="dash-stat-card__icon dash-stat-card__icon--purple">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
        </svg>
      </div>
    </div>
    <div class="dash-stat-card__value">٨٩</div>
    <span class="dash-stat-card__delta">+٢ هذا الشهر</span>
  </div>
</div>

{{-- Quick Actions --}}
<div class="dash-section-card" style="margin-bottom:1.5rem">
  <div class="dash-section-card__header">
    <span class="dash-section-card__title">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/>
      </svg>
      إجراءات سريعة
    </span>
  </div>
  <div class="dash-section-card__body">
    <div class="dash-quick-actions">
      <a href="/admin/lessons?action=add" class="dash-quick-btn">
        <div class="dash-quick-btn__icon" style="background:rgba(4,95,114,0.1);color:var(--primary)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
        <span class="dash-quick-btn__label">إضافة درس جديد</span>
      </a>
      <a href="/admin/library?action=add" class="dash-quick-btn">
        <div class="dash-quick-btn__icon" style="background:rgba(122,77,140,0.1);color:#7a4d8c">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        </div>
        <span class="dash-quick-btn__label">إضافة كتاب جديد</span>
      </a>
      <a href="/admin/fatwas/questions" class="dash-quick-btn">
        <div class="dash-quick-btn__icon" style="background:rgba(177,147,70,0.1);color:var(--accent)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <span class="dash-quick-btn__label">مراجعة الفتاوى <span style="display:block;font-size:.7rem;font-weight:400;color:var(--accent)">7 جديدة</span></span>
      </a>
      <a href="/admin/curricula?action=add" class="dash-quick-btn">
        <div class="dash-quick-btn__icon" style="background:rgba(61,122,80,0.1);color:#3d7a50">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg>
        </div>
        <span class="dash-quick-btn__label">إضافة مقرر جديد</span>
      </a>
    </div>
  </div>
</div>

{{-- Bottom grid: Activity + Mini chart --}}
<div class="dash-grid-2">

  {{-- Recent Activity --}}
  <div class="dash-section-card" style="margin-bottom:0">
    <div class="dash-section-card__header">
      <span class="dash-section-card__title">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
        </svg>
        آخر النشاطات
      </span>
      <a href="/admin/activity-log" style="font-size:.78rem;font-weight:500;color:var(--primary);text-decoration:none">عرض الكل</a>
    </div>
    <div class="dash-section-card__body" style="padding:0">
      <ul class="dash-activity-list" style="padding:0 1.25rem">
        @php $activities = [
          ['add',    'أضاف محمد العدني',    'درس جديد: شرح الأصول الثلاثة — الدرس ٣',  'منذ ٢٠ دقيقة'],
          ['edit',   'عدّل أحمد المنصوري',  'مقرر: العقيدة الواسطية',                    'منذ ساعة'],
          ['publish','نشر عبد الله السالم', 'فتوى: حكم قراءة القرآن من الهاتف',         'منذ ٣ ساعات'],
          ['add',    'أضاف محمد العدني',    'كتاب: الأربعون النووية — طبعة جديدة',       'أمس'],
          ['delete', 'حذف أحمد المنصوري',  'تعليق مسيء من الأسئلة',                     'أمس'],
        ]; @endphp

        @foreach($activities as [$type,$who,$what,$when])
          <li class="dash-activity-item">
            <div class="dash-activity-item__icon dash-activity-item__icon--{{ $type }}">
              @if($type==='add')
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              @elseif($type==='edit')
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              @elseif($type==='publish')
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
              @else
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
              @endif
            </div>
            <div class="dash-activity-item__body">
              <p class="dash-activity-item__text"><strong>{{ $who }}</strong> — {{ $what }}</p>
              <p class="dash-activity-item__time">{{ $when }}</p>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>

  {{-- Content summary --}}
  <div class="dash-section-card" style="margin-bottom:0">
    <div class="dash-section-card__header">
      <span class="dash-section-card__title">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
        </svg>
        ملخص المحتوى
      </span>
    </div>
    <div class="dash-section-card__body" style="padding:0">
      @php $summary = [
        ['المقررات العلمية', '١٤٧', '/admin/curricula',    'rgba(4,95,114,0.1)',   'var(--primary)'],
        ['الدروس',           '٢٠٤٨','/admin/lessons',      'rgba(177,147,70,0.1)', 'var(--accent)'],
        ['خطب الجمعة',       '٣٤١', '/admin/sermons',      'rgba(122,77,140,0.1)', '#7a4d8c'],
        ['المحاضرات',        '٢١٩', '/admin/lectures',     'rgba(61,122,80,0.1)',  '#3d7a50'],
        ['الردود العلمية',   '٢٠٠', '/admin/refutations',  'rgba(138,106,40,0.1)', '#8a6a28'],
        ['الكتب',            '٨٩',  '/admin/library',      'rgba(60,100,140,0.1)', '#3c648c'],
      ]; @endphp
      @foreach($summary as [$label,$count,$link,$bg,$color])
        <a href="{{ $link }}" style="display:flex;align-items:center;gap:12px;padding:.875rem 1.25rem;border-bottom:1px solid var(--border-day);text-decoration:none;transition:background .15s">
          <span style="width:8px;height:8px;border-radius:50%;background:{{ $color }};flex-shrink:0"></span>
          <span style="flex:1;font-size:.84rem;color:var(--text-day)">{{ $label }}</span>
          <span style="font-family:'ThmanyahSerifDisplay',serif;font-size:.95rem;font-weight:700;color:{{ $color }}">{{ $count }}</span>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--border-day)"><path d="M15 18l-6-6 6-6"/></svg>
        </a>
      @endforeach
    </div>
  </div>

</div>

@endsection