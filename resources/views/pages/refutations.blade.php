@extends('layouts.app')
@section('content')

{{-- refutations.blade.php | prefix: refute- --}}
@php
$categories = [
  ['bida',        'الردود على البدع',               '٤٨', 'aqeedah'],
  ['firaq',       'الردود على الفرق الضالة',        '٣٧', 'fiqh'],
  ['shubhat',     'الردود على الشبهات العقدية',     '٥٢', 'aqeedah'],
  ['ilhad',       'الردود على الإلحاد والتشكيك',    '٣٤', 'akhlaq'],
  ['mutasajidda', 'الردود على الفتن المعاصرة',      '٢٩', 'hadith'],
];

$catColorMap = [
  'bida'        => 'aqeedah',
  'firaq'       => 'fiqh',
  'shubhat'     => 'aqeedah',
  'ilhad'       => 'akhlaq',
  'mutasajidda' => 'hadith',
];

$trending = [
  ['الرد على شبهة تعدد الزوجات في الإسلام',     'ilhad',       'الشيخ يحيى الحجوري', '١ ساعة ٥ د',  '٢٢ ألف'],
  ['الرد على القرآنيين ومنكري السنة النبوية',    'shubhat',     'الشيخ عبد العزيز',   '١ ساعة ٢٢ د', '١٧ ألف'],
  ['الرد على حركة الإخوان المسلمين وأصولها',    'firaq',       'الشيخ يحيى الحجوري', '٥٨ د',        '١٥ ألف'],
  ['الرد على بدعة القبورية والتبرك بالأضرحة',   'bida',        'الشيخ محمد الغامدي', '١ ساعة ١٢ د', '١٢ ألف'],
];

$refutations = [
  ['shubhat',     'الرد على شبهة أن القرآن كلام بشر',                     'الشيخ يحيى الحجوري', '١ ساعة ١٨ د', '٢٨ ألف'],
  ['ilhad',       'الرد على شبهة تعدد الزوجات في الإسلام',                'الشيخ عبد العزيز',   '١ ساعة ٥ د',  '٢٢ ألف'],
  ['firaq',       'الرد على القرآنيين ومنكري السنة النبوية',              'الشيخ يحيى الحجوري', '١ ساعة ٢٢ د', '١٧ ألف'],
  ['bida',        'الرد على من أجاز الاحتفال بالمولد النبوي',             'الشيخ محمد الغامدي', '٤٨ د',        '١٤ ألف'],
  ['firaq',       'الرد على حركة الإخوان المسلمين وأصولها الفكرية',      'الشيخ يحيى الحجوري', '٥٨ د',        '١٥ ألف'],
  ['shubhat',     'الرد على شبهة أن الإسلام انتشر بالسيف',               'الشيخ عبد العزيز',   '٥٢ د',        '١١ ألف'],
  ['ilhad',       'الرد على نظرية التطور وصلتها بالإلحاد',               'الشيخ يحيى الحجوري', '١ ساعة ٣٠ د', '١٩ ألف'],
  ['bida',        'الرد على بدعة القبورية والتبرك بالأضرحة',             'الشيخ محمد الغامدي', '١ ساعة ١٢ د', '١٢ ألف'],
  ['mutasajidda', 'الرد على حملات التشكيك في السنة عبر الإنترنت',        'الشيخ عبد العزيز',   '٤٤ د',        '٩ آلاف'],
  ['shubhat',     'الرد على شبهة التناقض بين القرآن والعلم الحديث',      'الشيخ يحيى الحجوري', '١ ساعة ٤ د',  '٧ آلاف'],
  ['firaq',       'الرد على الصوفية ومفهوم الولاية عندهم',               'الشيخ عبد العزيز',   '١ ساعة ٨ د',  '٦ آلاف'],
  ['mutasajidda', 'الرد على شبهات حول مكانة المرأة في الإسلام',          'الشيخ محمد الغامدي', '٥٥ د',        '٨ آلاف'],
];

$sheikhs = [
  ['hajouri', 'الشيخ يحيى الحجوري',  '٧٨ رداً', 'ي'],
  ['aziz',    'الشيخ عبد العزيز',     '٥٤ رداً', 'ع'],
  ['ghamidi', 'الشيخ محمد الغامدي',  '٤١ رداً', 'م'],
  ['fawzan',  'الشيخ صالح الفوزان',  '٦٢ رداً', 'ص'],
  ['muqbil',  'الشيخ مقبل الوادعي',  '٣٣ رداً', 'م'],
];
@endphp

<div class="shared-page" x-data="refutePage()">

  {{-- ══ HERO — authority + urgency-aware search ════════════════ --}}
  <div class="refute-hero">
    <div class="shared-inner refute-hero__inner">
      <div class="refute-hero__text">
        <p class="refute-hero__eyebrow">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          منهج علمي موثّق
        </p>
        <h1 class="refute-hero__title">الردود العلمية</h1>
        <p class="refute-hero__sub">
          ردود العلماء على البدع والشبهات والانحرافات العقدية والفكرية —
          مستندة للدليل والمنهج السلفي الصحيح
        </p>
      </div>
      <div class="refute-hero__search-block">
        <div class="shared-search refute-hero__search">
          <svg class="shared-search__icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
          </svg>
          <input class="shared-search__input" type="text" x-model="query"
                 placeholder="ابحث برد أو شبهة أو فرقة أو موضوع..."
                 @input.debounce.300ms="filterRefutations()">
          <button x-show="query" @click="query='';filterRefutations()" class="shared-search__clear">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
        </div>
        <p class="refute-hero__search-hint">مثال: "شبهة السيف"، "القرآنيون"، "الإلحاد"، "المولد"</p>
      </div>
    </div>
  </div>

  {{-- ══ CATEGORIES — PRIMARY, sticky, colored ══════════════════ --}}
  <div class="refute-cats">
    <div class="shared-inner refute-cats__inner">
      @foreach($categories as [$id,$label,$count,$colorId])
        <button
          class="refute-cat-btn refute-cat-btn--{{ $colorId }}"
          :class="{ 'refute-cat-btn--active': activeCategory === '{{ $id }}' }"
          @click="activeCategory = (activeCategory==='{{ $id }}' ? 'all' : '{{ $id }}'); filterRefutations()">
          <span class="refute-cat-btn__label">{{ $label }}</span>
          <span class="refute-cat-btn__count">{{ $count }}</span>
        </button>
      @endforeach
      <button class="refute-cat-btn refute-cat-btn--reset" x-show="activeCategory !== 'all'"
              @click="activeCategory='all';filterRefutations()">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/>
        </svg>
        الكل
      </button>

      <div style="margin-right:auto"></div>

      {{-- Sheikh filter (searchable dropdown) --}}
      <div class="sermons-filter__sheikh-wrap" x-data="{ open: false, search: '' }" @click.away="open = false">
        <button class="sermons-filter__sheikh-btn"
                :class="{ 'sermons-filter__sheikh-btn--active': activeSheikh !== 'all' }"
                @click="open = !open">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
          <span x-text="activeSheikh==='all' ? 'الشيخ' : sheikhs.find(s=>s.id===activeSheikh)?.name??'الشيخ'"></span>
          <svg class="sermons-filter__chevron" width="11" height="11" viewBox="0 0 16 16"
               fill="currentColor" :style="open?'transform:rotate(180deg)':''"><path d="M4 6l4 4 4-4H4z"/></svg>
          <span x-show="activeSheikh!=='all'" class="sermons-filter__sheikh-active-dot"></span>
        </button>
        <div class="sermons-filter__sheikh-dropdown" x-show="open" x-transition @click.stop style="left:auto;right:0">
          <div class="sermons-filter__sheikh-search">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input class="sermons-filter__sheikh-search-input" type="text" x-model="search" placeholder="ابحث عن شيخ..." @click.stop>
          </div>
          <div class="sermons-filter__sheikh-list">
            <button class="sermons-filter__sheikh-option" :class="{'sermons-filter__sheikh-option--active':activeSheikh==='all'}"
                    @click="activeSheikh='all';open=false;filterRefutations()">
              <span class="sermons-filter__sheikh-option-name">كل المشايخ</span>
              <svg x-show="activeSheikh==='all'" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            </button>
            <template x-for="s in sheikhs.filter(s=>s.name.includes(search))" :key="s.id">
              <button class="sermons-filter__sheikh-option" :class="{'sermons-filter__sheikh-option--active':activeSheikh===s.id}"
                      @click="activeSheikh=s.id;open=false;filterRefutations()">
                <div class="sermons-filter__sheikh-option-avatar" x-text="s.initial"></div>
                <span class="sermons-filter__sheikh-option-name" x-text="s.name"></span>
                <span class="sermons-filter__sheikh-option-count" x-text="s.count"></span>
                <svg x-show="activeSheikh===s.id" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
              </button>
            </template>
            <p class="sermons-filter__sheikh-empty" x-show="sheikhs.filter(s=>s.name.includes(search)).length===0">لا يوجد شيخ بهذا الاسم</p>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- ══ TRENDING — intelligence strip ══════════════════════════ --}}
  <div class="refute-trending">
    <div class="shared-inner">
      <div class="shared-section-header" style="margin-bottom:1rem">
        <div>
          <p class="shared-section-header__eyebrow">الأكثر بحثاً هذا الأسبوع</p>
          <h2 class="shared-section-header__title">الشبهات الأكثر تداولاً</h2>
        </div>
        <p class="refute-trending__hint">مؤشر على أبرز الفتن المنتشرة حالياً</p>
      </div>
      <div class="refute-trending__row">
        @foreach($trending as [$title,$catId,$sheikh,$dur,$views])
          @php $colorId = $catColorMap[$catId]; @endphp
          <a href="/lesson/{{ Str::slug($title) }}" class="refute-trend-card refute-trend-card--{{ $colorId }}">
            <div class="refute-trend-card__spine refute-trend-card__spine--{{ $colorId }}"></div>
            <div class="refute-trend-card__body">
              <div style="display:flex;align-items:center;gap:5px;margin-bottom:.5rem">
                <span class="sermon-card__topic-dot sermon-card__topic-dot--{{ $colorId }}"></span>
                <span style="font-size:.7rem;font-weight:600;color:var(--text-muted-day)">
                  {{ collect($categories)->firstWhere(0,$catId)[1] ?? '' }}
                </span>
                <span class="shared-social-proof" style="font-size:.69rem;margin-right:auto">
                  <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                  {{ $views }}
                </span>
              </div>
              <h3 class="refute-trend-card__title">{{ $title }}</h3>
              <div class="refute-trend-card__meta">
                <span class="refute-trend-card__sheikh">{{ $sheikh }}</span>
                <span class="refute-trend-card__dur">{{ $dur }}</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  {{-- ══ RESULT COUNT BAR ════════════════════════════════════════ --}}
  <div class="refute-count-bar">
    <div class="shared-inner">
      <div class="refute-count-bar__inner">
        <span class="shared-result-count">
          عُثر على <strong x-text="resultCount">{{ count($refutations) }}</strong> رداً
        </span>
        <div class="sermons-filter-bar__status" style="margin-right:0">
          <template x-if="activeCategory !== 'all'">
            <span class="sermons-filter__active-pill">
              <span x-text="categories.find(c=>c[0]===activeCategory)?.[1]??''"></span>
              <button @click="activeCategory='all';filterRefutations()" class="sermons-filter__pill-x">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            </span>
          </template>
          <template x-if="activeSheikh !== 'all'">
            <span class="sermons-filter__active-pill">
              <span x-text="sheikhs.find(s=>s.id===activeSheikh)?.name??''"></span>
              <button @click="activeSheikh='all';filterRefutations()" class="sermons-filter__pill-x">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            </span>
          </template>
          <button x-show="activeCategory!=='all'||activeSheikh!=='all'||query"
                  @click="activeCategory='all';activeSheikh='all';query='';filterRefutations()"
                  class="shared-btn-ghost" style="font-size:.74rem;padding:3px 8px">مسح الكل</button>
        </div>
      </div>
    </div>
  </div>

  {{-- ══ REFUTATIONS GRID ═════════════════════════════════════════ --}}
  <div class="refute-list-section">
    <div class="shared-inner">
      <div class="refute-grid">
        @foreach($refutations as [$catId,$title,$sheikh,$dur,$views])
          @php $colorId = $catColorMap[$catId]; @endphp
          <a href="/lesson/{{ Str::slug($title) }}" class="refute-card refute-card--{{ $colorId }}">

            {{-- Category indicator --}}
            <div class="refute-card__head">
              <div class="refute-card__topic">
                <span class="sermon-card__topic-dot sermon-card__topic-dot--{{ $colorId }}"></span>
                <span class="refute-card__topic-label">
                  {{ collect($categories)->firstWhere(0,$catId)[1] ?? '' }}
                </span>
              </div>
              <span class="refute-card__views">
                <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                {{ $views }}
              </span>
            </div>

            {{-- Title: states clearly what is being refuted --}}
            <h3 class="refute-card__title">{{ $title }}</h3>

            {{-- Footer --}}
            <div class="refute-card__footer">
              <div class="sermon-card__sheikh-row">
                <div class="sermon-card__sheikh-avatar">{{ mb_substr($sheikh, 7, 1, 'UTF-8') }}</div>
                <span class="sermon-card__sheikh">{{ $sheikh }}</span>
              </div>
              <span class="sermon-card__dur">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                {{ $dur }}
              </span>
            </div>

            {{-- Hover overlay --}}
            <div class="sermon-card__play-hint">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              استمع الآن
            </div>

          </a>
        @endforeach
      </div>
    </div>
  </div>

</div>

<script>
function refutePage() {
  return {
    query: '',
    activeCategory: 'all',
    activeSheikh: 'all',
    resultCount: {{ count($refutations) }},
    categories: @json($categories),
    sheikhs: [
      { id:'hajouri', name:'الشيخ يحيى الحجوري', count:'٧٨ رداً', initial:'ي' },
      { id:'aziz',    name:'الشيخ عبد العزيز',    count:'٥٤ رداً', initial:'ع' },
      { id:'ghamidi', name:'الشيخ محمد الغامدي', count:'٤١ رداً', initial:'م' },
      { id:'fawzan',  name:'الشيخ صالح الفوزان', count:'٦٢ رداً', initial:'ص' },
      { id:'muqbil',  name:'الشيخ مقبل الوادعي', count:'٣٣ رداً', initial:'م' },
    ],
    filterRefutations() {
      this.resultCount = Math.max(2, {{ count($refutations) }} - Math.floor(Math.random()*4));
    }
  }
}
</script>
@endsection