@extends('layouts.app')
@section('content')

{{-- search.blade.php | prefix: search- --}}
@php $q = request('q', ''); @endphp

<div class="shared-page" x-data="searchPage('{{ addslashes($q) }}')">

  {{-- ══ STICKY SEARCH BAR ══════════════════════════════════════ --}}
  <div class="search-hero">
    <div class="shared-inner search-hero__inner">
      <div class="shared-search search-hero__box"
           :class="{ 'search-hero__box--focused': focused }">
        <svg class="shared-search__icon" width="17" height="17" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input
          class="shared-search__input search-hero__input"
          type="text"
          x-model="query"
          @focus="focused = true"
          @blur="focused = false"
          @input.debounce.350ms="doSearch()"
          @keydown.enter="doSearch()"
          placeholder="ابحث في الموسوعة — دروس، كتب، فتاوى..."
        >
        <button x-show="query" @click="query = ''; doSearch()" class="shared-search__clear">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      {{-- Smart suggestions — shown above results to pre-empt frustration --}}
      <div class="search-suggestions" x-show="query && suggestions.length > 0">
        <span class="search-suggestions__label">هل تقصد:</span>
        <template x-for="s in suggestions" :key="s">
          <button class="search-suggestions__item" @click="query = s; doSearch()" x-text="s"></button>
        </template>
      </div>
    </div>
  </div>

  <div class="shared-inner">

    {{-- ══ TABS with result counts — Serial Position: most likely first ══ --}}
    <div class="search-tabs" role="tablist" x-show="query">
      @php
      $tabs = [
        ['all',       'الكل',      null],
        ['curricula', 'المقررات',  '3'],
        ['lessons',   'الدروس',    '23'],
        ['books',     'الكتب',     '4'],
        ['fatwas',    'الفتاوى',   '11'],
      ];
      @endphp
      @foreach($tabs as [$id, $label, $count])
        <button
          class="search-tab"
          :class="{ 'search-tab--active': activeTab === '{{ $id }}' }"
          @click="activeTab = '{{ $id }}'"
          role="tab">
          {{ $label }}
          @if($count)
            <span class="search-tab__count">{{ $count }}</span>
          @endif
        </button>
      @endforeach
    </div>

    {{-- ══ RESULTS ════════════════════════════════════════════════ --}}
    <div x-show="query && !loading" class="search-results">

      {{-- Curricula --}}
      <div x-show="activeTab === 'all' || activeTab === 'curricula'">
        <h3 class="search-results__group-title">المقررات</h3>
        @php
        $curriculaResults = [
          ['الأصول الثلاثة',  'الإمام محمد بن عبد الوهاب — الشيخ يحيى الحجوري', 'aqeedah', '٤٧ درساً'],
          ['الأربعون النووية', 'الإمام النووي — الشيخ محمد الغامدي',              'hadith',  '٤٢ درساً'],
          ['زاد المستقنع',    'الحجاوي — الشيخ ابن عثيمين',                       'fiqh',    '٨٩ درساً'],
        ];
        @endphp
        @foreach($curriculaResults as [$title, $meta, $sec, $count])
          <a href="/curriculum/{{ Str::slug($title) }}" class="search-result-item">
            <div class="search-result-item__icon search-result-item__icon--curriculum">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
              </svg>
            </div>
            <div class="search-result-item__body">
              <h4 class="search-result-item__title" x-html="highlight('{{ addslashes($title) }}')"></h4>
              <p class="search-result-item__meta">{{ $meta }} · {{ $count }}</p>
            </div>
            <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.64rem;flex-shrink:0">
              {{ ['aqeedah'=>'عقيدة','hadith'=>'حديث','fiqh'=>'فقه'][$sec] }}
            </span>
          </a>
        @endforeach
      </div>

      {{-- Lessons --}}
      <div x-show="activeTab === 'all' || activeTab === 'lessons'" style="margin-top:1.75rem">
        <h3 class="search-results__group-title">الدروس</h3>
        @php
        $lessonResults = [
          ['الأصل الأول: معرفة الرب',          'الأصول الثلاثة — الدرس ٣', 'aqeedah', '٥٢ د'],
          ['الإيمان بالقدر خيره وشره',           'الأصول الثلاثة — الدرس ٧', 'aqeedah', '٤٦ د'],
          ['شرح حديث جبريل في الإيمان',         'الأربعون النووية — الدرس ٢','hadith',  '٥٢ د'],
          ['أحكام الطهارة والوضوء وشروطهما',    'زاد المستقنع — الدرس ٥',   'fiqh',    '٤٨ د'],
        ];
        @endphp
        @foreach($lessonResults as [$title, $book, $sec, $dur])
          <a href="/lesson/{{ Str::slug($title) }}" class="search-result-item">
            <div class="search-result-item__icon search-result-item__icon--lesson">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="23 7 16 12 23 17 23 7"/>
                <rect x="1" y="5" width="15" height="14" rx="2"/>
              </svg>
            </div>
            <div class="search-result-item__body">
              <h4 class="search-result-item__title" x-html="highlight('{{ addslashes($title) }}')"></h4>
              <p class="search-result-item__meta">{{ $book }} · {{ $dur }}</p>
            </div>
            <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.64rem;flex-shrink:0">
              {{ ['aqeedah'=>'عقيدة','hadith'=>'حديث','fiqh'=>'فقه'][$sec] }}
            </span>
          </a>
        @endforeach
      </div>

      {{-- Books --}}
      <div x-show="activeTab === 'all' || activeTab === 'books'" style="margin-top:1.75rem">
        <h3 class="search-results__group-title">الكتب</h3>
        @php
        $bookResults = [
          ['الأصول الثلاثة',    'محمد بن عبد الوهاب', 'aqeedah', 'متن'],
          ['العقيدة الواسطية',  'ابن تيمية',           'aqeedah', 'متن'],
        ];
        @endphp
        @foreach($bookResults as [$title, $author, $sec, $type])
          <a href="/book/{{ Str::slug($title) }}" class="search-result-item">
            <div class="search-result-item__icon search-result-item__icon--book">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
              </svg>
            </div>
            <div class="search-result-item__body">
              <h4 class="search-result-item__title" x-html="highlight('{{ addslashes($title) }}')"></h4>
              <p class="search-result-item__meta">{{ $author }} · {{ $type }}</p>
            </div>
            <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.64rem;flex-shrink:0">
              {{ $sec === 'aqeedah' ? 'عقيدة' : 'فقه' }}
            </span>
          </a>
        @endforeach
      </div>

      {{-- Fatwas --}}
      <div x-show="activeTab === 'all' || activeTab === 'fatwas'" style="margin-top:1.75rem">
        <h3 class="search-results__group-title">الفتاوى</h3>
        @php
        $fatwaResults = [
          ['حكم قراءة القرآن من الهاتف بلا وضوء', 'يجوز على الراجح من أقوال أهل العلم', 'fiqh'],
          ['هل تجب الزكاة على مال الأطفال؟',       'تجب في قول أكثر أهل العلم',          'fiqh'],
          ['حكم الاحتفال بالمولد النبوي',           'لا يجوز لأنه بدعة محدثة',            'aqeedah'],
        ];
        @endphp
        @foreach($fatwaResults as [$question, $verdict, $sec])
          <a href="/fatwa/{{ Str::slug($question) }}" class="search-result-item">
            <div class="search-result-item__icon search-result-item__icon--fatwa">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
              </svg>
            </div>
            <div class="search-result-item__body">
              <h4 class="search-result-item__title" x-html="highlight('{{ addslashes($question) }}')"></h4>
              <p class="search-result-item__meta search-result-item__verdict">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ $verdict }}
              </p>
            </div>
            <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.64rem;flex-shrink:0">
              {{ $sec === 'fiqh' ? 'فقه' : 'عقيدة' }}
            </span>
          </a>
        @endforeach
      </div>

    </div>{{-- end .search-results --}}

    {{-- Loading skeleton --}}
    <div x-show="loading" class="search-loading">
      <div class="shared-skeleton" style="height:64px;border-radius:10px"></div>
      <div class="shared-skeleton" style="height:64px;border-radius:10px;opacity:.7"></div>
      <div class="shared-skeleton" style="height:64px;border-radius:10px;opacity:.4"></div>
    </div>

    {{-- Empty state — active, not passive --}}
    <div x-show="query && !loading && isEmpty" class="shared-empty">
      <div class="shared-empty__icon">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
      </div>
      <h3 class="shared-empty__title">
        لم نجد نتائج لـ "<span x-text="query"></span>"
      </h3>
      <p class="shared-empty__desc">جرّب كلمات مختلفة، أو استعرض الأقسام الرئيسية</p>
      <div style="display:flex;gap:10px;margin-top:1.25rem;flex-wrap:wrap;justify-content:center">
        <a href="/curricula" class="shared-btn-outline" style="font-size:.82rem">تصفح المقررات</a>
        <a href="/fatwas"    class="shared-btn-outline" style="font-size:.82rem">تصفح الفتاوى</a>
        <a href="/ask-fatwa" class="shared-btn-primary"  style="font-size:.82rem">اسأل سؤالاً</a>
      </div>
    </div>

    {{-- Initial state (no query yet) --}}
    <div x-show="!query" class="search-initial">
      <p class="search-initial__label">الأكثر بحثاً هذا الأسبوع</p>
      <div class="search-initial__tags">
        @php
        $popularTerms = ['التوحيد','صلاة الجماعة','زكاة الأطفال','الأربعون النووية','حكم المولد','العقيدة الواسطية'];
        @endphp
        @foreach($popularTerms as $term)
          <button class="search-initial__tag"
                  @click="query = '{{ $term }}'; doSearch()">{{ $term }}</button>
        @endforeach
      </div>
    </div>

  </div>{{-- end .shared-inner --}}
</div>

<script>
function searchPage(initialQuery) {
  return {
    query: initialQuery,
    focused: false,
    loading: false,
    isEmpty: false,
    activeTab: 'all',
    suggestions: ['التوحيد وأنواعه', 'توحيد الألوهية'],

    init() {
      if (this.query) this.doSearch();
    },

    doSearch() {
      if (!this.query.trim()) return;
      this.loading = true;
      this.isEmpty = false;
      history.replaceState(null, '', '/search?q=' + encodeURIComponent(this.query));
      setTimeout(() => {
        this.loading = false;
        this.isEmpty = false;
      }, 550);
    },

    highlight(text) {
      if (!this.query) return text;
      const escaped = this.query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
      return text.replace(
        new RegExp(escaped, 'gi'),
        m => `<mark class="search-highlight">${m}</mark>`
      );
    }
  }
}
</script>
@endsection