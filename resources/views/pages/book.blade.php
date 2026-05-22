@extends('layouts.app')
@section('content')

{{-- book.blade.php | prefix: book- --}}
@php
$book = [
  'title'     => 'كتاب التوحيد الذي هو حق الله على العباد',
  'author'    => 'الإمام محمد بن عبد الوهاب',
  'section'   => 'aqeedah',
  'type'      => 'متن',
  'level'     => 'متوسط',
  'chapters'  => 12,
  'completed' => 3,
  'downloads' => '٤٢ ألف',
];
$chapters = [
  ['١','باب فضل التوحيد وما يكفر من الذنوب','مكتمل'],
  ['٢','باب من حقق التوحيد دخل الجنة بغير حساب','مكتمل'],
  ['٣','باب الخوف من الشرك','مكتمل'],
  ['٤','باب الدعاء إلى شهادة أن لا إله إلا الله','لم يُقرأ'],
  ['٥','باب تفسير التوحيد وشهادة أن لا إله إلا الله','لم يُقرأ'],
  ['٦','باب من الشرك لبس الحلقة والخيط ونحوهما','لم يُقرأ'],
  ['٧','باب ما جاء في الرقى والتمائم','لم يُقرأ'],
];
$progress = round(($book['completed'] / $book['chapters']) * 100);
$related = [
  ['كشف الشبهات','محمد بن عبد الوهاب','ماذا تقرأ بعد هذا الكتاب؟','aqeedah'],
  ['الأصول الثلاثة','محمد بن عبد الوهاب','من نفس المؤلف','aqeedah'],
];
@endphp

<div class="shared-page">

  {{-- Breadcrumb --}}
  <nav class="shared-breadcrumb">
    <div class="shared-inner">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/library" class="shared-breadcrumb__link">المكتبة</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><span class="shared-breadcrumb__current">{{ $book['title'] }}</span></li>
      </ol>
    </div>
  </nav>

  <div class="shared-inner--mid">

    {{-- ══ BOOK HEADER ════════════════════════════════════════ --}}
    <header class="book-header">
      <div class="book-header__layout">
        <div class="book-header__info">
          <div class="book-header__tags">
            <span class="shared-tag shared-tag--{{ $book['section'] }}">عقيدة</span>
            <span class="shared-tag shared-tag--neutral">{{ $book['type'] }}</span>
            @php $lvlClass = $book['level']==='مبتدئ'?'beginner':($book['level']==='متوسط'?'intermediate':'advanced'); @endphp
            <span class="shared-tag shared-tag--level-{{ $lvlClass }}">{{ $book['level'] }}</span>
            <span class="shared-social-proof" style="font-size:.72rem">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              {{ $book['downloads'] }} تحميل
            </span>
          </div>

          <h1 class="book-header__title">{{ $book['title'] }}</h1>
          <p class="book-header__author">{{ $book['author'] }}</p>

          {{-- Cliffhanger --}}
          <div class="shared-cliffhanger">
            <p class="shared-cliffhanger__question">ما الذي يُحقق معنى لا إله إلا الله في حياتك فعلاً؟</p>
            <p class="shared-cliffhanger__body">
              هذا الكتاب يجيب على هذا السؤال بأدلة من الكتاب والسنة في {{ $book['chapters'] }} باباً — كل باب يكشف بُعداً من أبعاد التوحيد في الحياة اليومية.
            </p>
          </div>

          {{-- Reading options — clear hierarchy --}}
          <div class="book-header__cta-row">
            <a href="/book/{{ Str::slug($book['title']) }}/read" class="shared-btn-primary">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
              اقرأ داخل الموقع
            </a>
            <a href="/book/{{ Str::slug($book['title']) }}/download" class="shared-download-btn">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              تحميل PDF
            </a>
          </div>
        </div>

        {{-- Progress card --}}
        <div class="book-header__progress-card">
          <div class="book-header__progress-label">تقدّمك في الكتاب</div>
          <div class="book-header__progress-fraction">{{ $book['completed'] }} / {{ $book['chapters'] }} فصل</div>
          <div class="shared-progress__track" style="margin:10px 0 12px">
            <div class="shared-progress__fill" style="width:{{ $progress }}%"></div>
          </div>
          <div class="book-header__progress-note">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            أتممتَ {{ $book['completed'] }} من {{ $book['chapters'] }} فصلاً ({{ $progress }}%)
          </div>
        </div>
      </div>
    </header>

    {{-- ══ CHAPTERS -- with progress indicators ══════════════ --}}
    <section class="book-chapters">
      <h2 class="book-chapters__title">الفهرس</h2>
      <ul class="book-chapters__list">
        @foreach($chapters as [$num,$title,$status])
          <li class="book-chapter-row book-chapter-row--{{ $status==='مكتمل'?'done':'locked' }}">
            <a href="/book/{{ Str::slug($book['title']) }}/chapter/{{ $num }}" class="book-chapter-row__link">
              <div class="book-chapter-row__indicator">
                @if($status === 'مكتمل')
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                @else
                  <span>{{ $num }}</span>
                @endif
              </div>
              <span class="book-chapter-row__title">{{ $title }}</span>
              @if($status === 'مكتمل')
                <span class="book-chapter-row__done">مقروء</span>
              @endif
              <svg class="book-chapter-row__arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M15 18l-6-6 6-6"/></svg>
            </a>
          </li>
        @endforeach
      </ul>
    </section>

    {{-- Related --}}
    <section class="shared-related">
      <h3 class="shared-related__title">ماذا تقرأ بعد هذا الكتاب؟</h3>
      <div class="book-related-grid">
        @foreach($related as [$title,$author,$reason,$sec])
          <a href="/book/{{ Str::slug($title) }}" class="shared-related-card">
            <span class="shared-related-card__reason">{{ $reason }}</span>
            <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.62rem;align-self:flex-start">عقيدة</span>
            <h4 class="shared-related-card__title">{{ $title }}</h4>
            <div class="shared-related-card__meta">{{ $author }}</div>
          </a>
        @endforeach
      </div>
    </section>

  </div>
</div>
@endsection
