@extends('layouts.app')
@section('content')

{{-- library.blade.php | prefix: library- --}}
@php
$books = [
  ['الأصول الثلاثة',        'الإمام محمد بن عبد الوهاب',        'aqeedah','عقيدة','متن',  'مبتدئ', 'beginner',    '٤٢ ألف', true,  'أجمع متن في معرفة أصول الإسلام: من ربّك؟ ما دينك؟ من نبيّك؟'],
  ['العقيدة الواسطية',       'شيخ الإسلام ابن تيمية',           'aqeedah','عقيدة','متن',  'متوسط', 'intermediate','٢٨ ألف', false, 'موسوعة في العقيدة السلفية من الكتاب والسنة بأسلوب مركّز جامع.'],
  ['الأربعون النووية',       'الإمام يحيى بن شرف النووي',       'hadith', 'حديث', 'متن',  'مبتدئ', 'beginner',    '٣٨ ألف', true,  'اثنان وأربعون حديثاً تجمع مقاصد الدين أصلاً وفرعاً وأدباً.'],
  ['بلوغ المرام',            'الحافظ ابن حجر العسقلاني',        'hadith', 'حديث', 'مرجع', 'متقدم', 'advanced',    '١٥ ألف', false, 'أحاديث الأحكام مستخرجة بدقة مع الحكم على كل حديث.'],
  ['زاد المستقنع',           'الحجاوي',                         'fiqh',   'فقه',  'متن',  'متوسط', 'intermediate','٢١ ألف', false, 'من أجمع متون الفقه الحنبلي وأكثرها نفعاً للطالب.'],
  ['الرسالة',                'الإمام محمد بن إدريس الشافعي',    'fiqh',   'فقه',  'مرجع', 'متقدم', 'advanced',    '١٢ ألف', false, 'أول كتاب صُنِّف في أصول الفقه، وضع قواعد الاستنباط الشرعي.'],
  ['تفسير جزء عمّ',          'الشيخ محمد الشعراوي',             'tafsir', 'تفسير','شرح',  'مبتدئ', 'beginner',    '٩ آلاف', false, 'تفسير ميسّر لسور الجزء الثلاثين مع أسباب النزول.'],
  ['الآجرومية',              'ابن آجروم الصنهاجي',              'lugha',  'لغة',  'متن',  'مبتدئ', 'beginner',    '١١ ألف', true,  'أول ما يُبدأ به في تعلّم النحو العربي، مختصر وجامع.'],
  ['كشف الشبهات',            'الإمام محمد بن عبد الوهاب',       'aqeedah','عقيدة','شرح',  'متوسط', 'intermediate','١٧ ألف', false, 'ردٌّ على شبهات المعترضين على التوحيد بأسلوب واضح محكم.'],
  ['مختصر خليل',             'خليل بن إسحاق الجندي',            'fiqh',   'فقه',  'متن',  'متقدم', 'advanced',    '٨ آلاف', false, 'مختصر بالغ الدقة في الفقه المالكي يُعدّ مرجعاً أساسياً.'],
  ['تيسير الكريم الرحمن',    'الشيخ عبد الرحمن السعدي',        'tafsir', 'تفسير','شرح',  'متوسط', 'intermediate','٢٢ ألف', true,  'تفسير عصري واضح بعيد عن التعقيد، شامل للقرآن كاملاً.'],
  ['ألفية ابن مالك',         'ابن مالك الأندلسي',               'lugha',  'لغة',  'متن',  'متقدم', 'advanced',    '٦ آلاف', false, 'ألف بيت تضمّ قواعد النحو والصرف كاملة، عمدة الطلاب.'],
];
$lvlLabels = ['beginner'=>'مبتدئ','intermediate'=>'متوسط','advanced'=>'متقدم'];
$secNames  = ['aqeedah'=>'عقيدة','hadith'=>'حديث','fiqh'=>'فقه','tafsir'=>'تفسير','lugha'=>'لغة'];
$featured  = array_values(array_filter($books, fn($b) => $b[8]));
@endphp

<div class="shared-page" x-data="libraryPage()">

  {{-- Breadcrumb --}}
  <nav class="shared-breadcrumb">
    <div class="shared-inner">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </li>
        <li><span class="shared-breadcrumb__current">المكتبة</span></li>
      </ol>
    </div>
  </nav>

  {{-- ══ HERO ════════════════════════════════════════════════════ --}}
  <div class="library-hero">
    <div class="shared-inner library-hero__inner">
      <div>
        <h1 class="library-hero__title">المكتبة الإسلامية</h1>
        <p class="library-hero__sub">كتب ومتون ومراجع شرعية — مُرتّبة، مُفهرسة، جاهزة للقراءة أو التحميل</p>
      </div>
      {{-- Fitts: wide search target --}}
      <div class="shared-search library-hero__search">
        <svg class="shared-search__icon" width="16" height="16" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input
          class="shared-search__input"
          type="text"
          x-model="query"
          placeholder="ابحث باسم الكتاب أو المؤلف..."
        >
        <button x-show="query" @click="query = ''" class="shared-search__clear">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- ══ FEATURED STRIP ═════════════════════════════════════════
       Social Proof + Serial Position: popular books first
  ═══════════════════════════════════════════════════════════════ --}}
  <div class="library-featured-strip">
    <div class="shared-inner">
      <div class="shared-section-header">
        <div>
          <p class="shared-section-header__eyebrow">الأكثر تحميلاً</p>
          <h2 class="shared-section-header__title">كتب مميزة</h2>
        </div>
      </div>
      <div class="library-featured__row">
        @foreach($featured as $b)
          <a href="/book/{{ Str::slug($b[0]) }}" class="library-feat-card">
            <div class="library-feat-card__spine library-feat-card__spine--{{ $b[2] }}"></div>
            <div class="library-feat-card__body">
              <div style="display:flex;align-items:center;gap:5px;flex-wrap:wrap;margin-bottom:.5rem">
                <span class="shared-tag shared-tag--{{ $b[2] }}" style="font-size:.62rem">{{ $b[3] }}</span>
                <span class="shared-tag shared-tag--neutral"      style="font-size:.62rem">{{ $b[4] }}</span>
                <span class="shared-tag shared-tag--popular"      style="font-size:.62rem">
                  <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                  </svg>
                  {{ $b[7] }}
                </span>
              </div>
              <h3 class="library-feat-card__title">{{ $b[0] }}</h3>
              <p class="library-feat-card__author">{{ $b[1] }}</p>
              <p class="library-feat-card__desc">{{ Str::limit($b[9], 65) }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  {{-- ══ FILTER BAR — Hick's Law: minimal visible choices ════════
       One primary filter (section) always visible.
       Type filter collapsed as a dropdown — not competing tabs.
       Result count gives instant feedback (Doherty Threshold).
  ═══════════════════════════════════════════════════════════════ --}}
  <div class="shared-filter-bar library-filter-bar">
    <div class="shared-inner library-filter-bar__inner">

      {{-- Primary filter: section tabs — most-used, always visible --}}
      <div class="shared-filter-tabs library-filter__sections">
        @php $sections = ['all'=>'الكل','aqeedah'=>'عقيدة','hadith'=>'حديث','fiqh'=>'فقه','tafsir'=>'تفسير','lugha'=>'لغة']; @endphp
        @foreach($sections as $id => $label)
          <button
            class="shared-filter-tab"
            :class="{ 'shared-filter-tab--active': activeSection === '{{ $id }}' }"
            @click="activeSection = '{{ $id }}'">{{ $label }}</button>
        @endforeach
      </div>

      {{-- Divider --}}
      <div class="library-filter__divider"></div>

      {{-- Secondary filter: type — as a compact dropdown (Progressive Disclosure) --}}
      <div class="library-filter__type-wrap" x-data="{ open: false }" @click.away="open = false">
        <button
          class="library-filter__type-btn"
          :class="{ 'library-filter__type-btn--active': activeType !== 'الكل' }"
          @click="open = !open">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 6h16M7 12h10M10 18h4"/>
          </svg>
          <span x-text="activeType === 'الكل' ? 'النوع' : activeType"></span>
          <svg width="11" height="11" viewBox="0 0 16 16" fill="currentColor"
               :style="open ? 'transform:rotate(180deg)' : ''"
               style="transition:.15s;margin-right:auto">
            <path d="M4 6l4 4 4-4H4z"/>
          </svg>
        </button>
        <div class="library-filter__type-dropdown" x-show="open" x-transition>
          @foreach(['الكل','متن','شرح','مرجع'] as $type)
            <button
              class="library-filter__type-option"
              :class="{ 'library-filter__type-option--active': activeType === '{{ $type }}' }"
              @click="activeType = '{{ $type }}'; open = false">
              {{ $type }}
            </button>
          @endforeach
        </div>
      </div>

      {{-- Active filter pill (only shown when type is filtered) --}}
      <div x-show="activeType !== 'الكل'" class="library-filter__active-pill">
        <span x-text="activeType"></span>
        <button @click="activeType = 'الكل'" class="library-filter__pill-remove">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      {{-- Doherty: result count updates instantly --}}
      <span class="shared-result-count" style="margin-right:auto">
        <strong>{{ count($books) }}</strong> كتاباً
      </span>

    </div>
  </div>

  {{-- ══ BOOKS GRID ══════════════════════════════════════════════
       Von Restorff: hover card expands — single focal point.
       Fitts: CTA fills full width for easy tap.
       Cognitive Load: desc & CTAs hidden in rest state.
       The CARD itself expands on hover — not a separate overlay.
  ═══════════════════════════════════════════════════════════════ --}}
  <div class="library-grid-section">
    <div class="shared-inner">
      <div class="library-grid">
        @foreach($books as $b)
          @php
          [$title,$author,$secId,$secLabel,$type,$lvlLabel,$lvlClass,$downloads,$popular,$desc] = $b;
          @endphp
          <a href="/book/{{ Str::slug($title) }}" class="library-book-card">

            {{-- Colored spine — cognitive anchor --}}
            <div class="library-book-card__spine library-book-card__spine--{{ $secId }}"></div>

            <div class="library-book-card__inner">

              {{-- Static layer: always visible --}}
              <div class="library-book-card__static">
                <div class="library-book-card__tags">
                  <span class="shared-tag shared-tag--{{ $secId }}" style="font-size:.63rem">{{ $secLabel }}</span>
                  <span class="shared-tag shared-tag--neutral"       style="font-size:.63rem">{{ $type }}</span>
                  @if($popular)
                    <span class="shared-tag shared-tag--popular" style="font-size:.62rem">الأكثر</span>
                  @endif
                </div>
                <h3 class="library-book-card__title">{{ $title }}</h3>
                <p class="library-book-card__author">{{ $author }}</p>
                <div class="library-book-card__bottom-static">
                  <span class="shared-tag shared-tag--level-{{ $lvlClass }}" style="font-size:.62rem">{{ $lvlLabel }}</span>
                  <span class="shared-social-proof" style="font-size:.71rem">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                      <polyline points="7 10 12 15 17 10"/>
                      <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    {{ $downloads }}
                  </span>
                </div>
              </div>

              {{-- Expandable layer: desc + CTAs — shown on hover --}}
              <div class="library-book-card__expand">
                <p class="library-book-card__desc">{{ $desc }}</p>
                <div class="library-book-card__actions">
                  <span class="library-book-card__action-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                      <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                    اقرأ داخل الموقع
                  </span>
                  <span class="library-book-card__action-secondary">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                      <polyline points="7 10 12 15 17 10"/>
                      <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    تحميل PDF
                  </span>
                </div>
              </div>

            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

</div>

<script>
function libraryPage() {
  return {
    query: '',
    activeSection: 'all',
    activeType: 'الكل',
  }
}
</script>
@endsection