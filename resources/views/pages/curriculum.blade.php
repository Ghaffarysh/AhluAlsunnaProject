@extends('layouts.app')
@section('content')

{{-- curriculum.blade.php | prefix: curriculum- --}}
@php
$curr = [
  'title'    => 'الأصول الثلاثة',
  'fullTitle'=> 'الأصول الثلاثة وأدلتها',
  'author'   => 'الإمام محمد بن عبد الوهاب',
  'sheikh'   => 'الشيخ يحيى بن علي الحجوري',
  'section'  => 'aqeedah',
  'level'    => 'مبتدئ',
  'lessons'  => 47,
  'duration' => '٣٨ ساعة',
  'views'    => '١٢ ألف',
  'popular'  => true,
];
$firstLessons = [
  ['١','مقدمة المقرر — التعريف بالكتاب والمؤلف','٣٥ د'],
  ['٢','باب الفضل في معرفة الأصول الثلاثة','٤٨ د'],
  ['٣','الأصل الأول: معرفة الرب — الدليل والمعنى','٥٢ د'],
  ['٤','الأصل الأول (تابع): الأسماء والصفات','٤٤ د'],
  ['٥','الأصل الثاني: معرفة الدين — الإسلام والإيمان','٤١ د'],
];
$related = [
  ['العقيدة الواسطية',  'الشيخ عبد العزيز','aqeedah','الخطوة التالية في العقيدة','٣٢ درساً'],
  ['الأصول الثلاثة',   'الشيخ ابن عثيمين', 'aqeedah','من نفس الكتاب شرح آخر',   '٢٨ درساً'],
  ['ثلاثة الأصول',     'الشيخ يحيى الحجوري','fiqh',  'من نفس الشيخ',             '١٦ درساً'],
];
@endphp

<div class="shared-page">

  {{-- Breadcrumb --}}
  <nav class="shared-breadcrumb">
    <div class="shared-inner">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/curricula?section={{ $curr['section'] }}" class="shared-breadcrumb__link">العقيدة</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><span class="shared-breadcrumb__current">{{ $curr['title'] }}</span></li>
      </ol>
    </div>
  </nav>

  {{-- ══ CURRICULUM HEADER ══════════════════════════════════════ --}}
  <header class="curriculum-header">
    <div class="shared-inner curriculum-header__inner">

      <div class="curriculum-header__main">

        {{-- Tags row --}}
        <div class="curriculum-header__tags">
          <span class="shared-tag shared-tag--{{ $curr['section'] }}">عقيدة</span>
          @php $lvlClass = $curr['level']==='مبتدئ'?'beginner':($curr['level']==='متوسط'?'intermediate':'advanced'); @endphp
          <span class="shared-tag shared-tag--level-{{ $lvlClass }}">{{ $curr['level'] }}</span>
          @if($curr['popular'])
            <span class="shared-tag shared-tag--popular">
              <svg width="9" height="9" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
              الأكثر متابعة
            </span>
          @endif
        </div>

        <h1 class="curriculum-header__title">{{ $curr['fullTitle'] }}</h1>
        <p class="curriculum-header__author">{{ $curr['author'] }}</p>

        {{-- Cliffhanger description --}}
        <div class="shared-cliffhanger">
          <p class="shared-cliffhanger__question">هل تعرف ما الذي يُحقق معنى لا إله إلا الله في حياتك؟</p>
          <p class="shared-cliffhanger__body">
            هذا المقرر يجيب على الأسئلة الثلاثة التي يُسأل عنها كل مسلم في قبره:
            من ربّك؟ ما دينك؟ من نبيّك؟ — تعلّمها بأدلتها لتثبت قدمك.
          </p>
        </div>

        {{-- Sheikh --}}
        <div class="shared-sheikh curriculum-header__sheikh">
          <div class="shared-sheikh__avatar shared-sheikh__avatar--lg">ي</div>
          <div>
            <div class="shared-sheikh__name" style="font-size:.95rem">{{ $curr['sheikh'] }}</div>
            <div class="shared-sheikh__role">الشيخ الشارح — محقق وعالم أثري</div>
          </div>
        </div>

        {{-- Stats row --}}
        <div class="curriculum-header__stats">
          <span class="curriculum-header__stat">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            {{ $curr['lessons'] }} درساً
          </span>
          <span class="curriculum-header__stat">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            {{ $curr['duration'] }} إجمالاً
          </span>
          <span class="curriculum-header__stat shared-social-proof">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            {{ $curr['views'] }} مستمع
          </span>
        </div>

        {{-- CTAs --}}
        <div class="curriculum-header__cta-row">
          <a href="/lessons?curriculum={{ Str::slug($curr['title']) }}" class="shared-btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            ابدأ الدرس الأول
          </a>
          <a href="/curriculum/{{ Str::slug($curr['title']) }}/download" class="shared-download-btn">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            تحميل الكتاب PDF
          </a>
        </div>

      </div>

      {{-- Motivational aside --}}
      <div class="curriculum-header__aside">
        <div class="shared-motivate">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          أتمم هذا المقرر لتفهم أسس العقيدة الإسلامية من أجمع مصنّفاتها
        </div>
        <div class="curriculum-aside__info-card">
          <div class="curriculum-aside__row">
            <span class="curriculum-aside__label">المستوى</span>
            <span class="shared-tag shared-tag--level-beginner">مبتدئ</span>
          </div>
          <div class="curriculum-aside__row">
            <span class="curriculum-aside__label">عدد الدروس</span>
            <span class="curriculum-aside__val">{{ $curr['lessons'] }}</span>
          </div>
          <div class="curriculum-aside__row">
            <span class="curriculum-aside__label">المدة الإجمالية</span>
            <span class="curriculum-aside__val">{{ $curr['duration'] }}</span>
          </div>
          <div class="curriculum-aside__row">
            <span class="curriculum-aside__label">التخصص</span>
            <span class="curriculum-aside__val">العقيدة</span>
          </div>
        </div>
      </div>

    </div>
  </header>

  {{-- ══ PREVIEW LESSONS ════════════════════════════════════════ --}}
  <section class="curriculum-lessons-preview">
    <div class="shared-inner">
      <div class="curriculum-lessons-preview__header">
        <h2 class="curriculum-lessons-preview__title">الدروس</h2>
        <a href="/lessons?curriculum={{ Str::slug($curr['title']) }}" class="shared-section-header__link">
          عرض جميع الدروس الـ {{ $curr['lessons'] }}
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      <ul class="curriculum-lessons-preview__list">
        @foreach($firstLessons as [$num,$title,$dur])
          <li class="curriculum-preview-row">
            <a href="/lesson/{{ (int)$num }}" class="curriculum-preview-row__link">
              <span class="curriculum-preview-row__num">{{ $num }}</span>
              <span class="curriculum-preview-row__title">{{ $title }}</span>
              <span class="curriculum-preview-row__dur">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                {{ $dur }}
              </span>
              <svg class="curriculum-preview-row__arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M15 18l-6-6 6-6"/></svg>
            </a>
          </li>
        @endforeach
      </ul>
      <a href="/lessons?curriculum={{ Str::slug($curr['title']) }}" class="curriculum-lessons-preview__see-all shared-btn-outline" style="width:100%;justify-content:center;margin-top:1rem">
        عرض جميع الدروس الـ {{ $curr['lessons'] }}
      </a>
    </div>
  </section>

  {{-- ══ RELATED CURRICULA ══════════════════════════════════════ --}}
  <section class="shared-related">
    <div class="shared-inner">
      <h3 class="shared-related__title">مقررات ذات صلة</h3>
      <div class="curriculum-related-grid">
        @foreach($related as [$title,$sheikh,$sec,$reason,$count])
          <a href="/curriculum/{{ Str::slug($title) }}" class="shared-related-card">
            <span class="shared-related-card__reason">{{ $reason }}</span>
            <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.66rem;align-self:flex-start">{{ ['aqeedah'=>'عقيدة','fiqh'=>'فقه'][$sec] }}</span>
            <h4 class="shared-related-card__title">{{ $title }}</h4>
            <div class="shared-related-card__meta">
              <span>{{ $sheikh }}</span>
              <span>·</span>
              <span>{{ $count }}</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

</div>
@endsection
