@extends('layouts.app')
@section('content')

{{-- sermons.blade.php | prefix: sermons- --}}
@php
$featured = [
  ['خطبة التوحيد وأنواعه الثلاثة',       'الشيخ يحيى الحجوري', 'عقيدة', 'aqeedah', '٤٨ د',  '١٢ ألف'],
  ['فتنة المال وكيف يتقيها المسلم',       'الشيخ عبد العزيز',   'أخلاق', 'akhlaq',  '٣٥ د',  '٨ آلاف'],
  ['الاستعداد لرمضان — الأعمال والنيات', 'الشيخ محمد الغامدي', 'فقه',   'fiqh',    '٤١ د',  '٩ آلاف'],
  ['حقوق المسلم على أخيه المسلم',         'الشيخ يحيى الحجوري', 'أخلاق', 'akhlaq',  '٣٨ د',  '٧ آلاف'],
];

$sermons = [
  ['aqeedah','عقيدة','التوحيد وأنواعه الثلاثة',               'الشيخ يحيى الحجوري', '١ جمادى ١٤٤٦',  '٤٨ د', '١٢ ألف', true ],
  ['akhlaq', 'أخلاق','فتنة المال وكيف يتقيها المسلم',          'الشيخ عبد العزيز',   '٢٤ ربيع ١٤٤٦',  '٣٥ د', '٨ آلاف', false],
  ['fiqh',   'فقه',  'الاستعداد لرمضان — الأعمال والنيات',    'الشيخ محمد الغامدي', '١٧ ربيع ١٤٤٦',  '٤١ د', '٩ آلاف', false],
  ['akhlaq', 'أخلاق','حقوق المسلم على أخيه — من السلام للجنازة','الشيخ يحيى الحجوري','١٠ ربيع ١٤٤٦', '٣٨ د', '٧ آلاف', true ],
  ['aqeedah','عقيدة','الإيمان باليوم الآخر وأثره على السلوك',  'الشيخ عبد العزيز',   '٣ ربيع ١٤٤٦',   '٤٤ د', '١١ ألف', false],
  ['akhlaq', 'أخلاق','ثبات المسلم في زمن الفتن',               'الشيخ محمد الغامدي', '٢٥ صفر ١٤٤٦',   '٣٧ د', '٦ آلاف', false],
  ['fiqh',   'فقه',  'أحكام الزكاة المعاصرة',                   'الشيخ يحيى الحجوري', '١٨ صفر ١٤٤٦',   '٤٦ د', '٥ آلاف', false],
  ['aqeedah','عقيدة','شروط لا إله إلا الله',                    'الشيخ عبد العزيز',   '١١ صفر ١٤٤٦',   '٥٢ د', '١٤ ألف', true ],
  ['akhlaq', 'أخلاق','برّ الوالدين في عصر الانشغال',            'الشيخ محمد الغامدي', '٤ صفر ١٤٤٦',    '٣٣ د', '٤ آلاف', false],
  ['aqeedah','عقيدة','الموقف من أخبار الإعلام',                 'الشيخ يحيى الحجوري', '٢٧ محرم ١٤٤٦',  '٤٠ د', '٩ آلاف', false],
  ['fiqh',   'فقه',  'أحكام الصيام والإفطار',                   'الشيخ عبد العزيز',   '٢٠ محرم ١٤٤٦',  '٤٣ د', '٧ آلاف', false],
  ['akhlaq', 'أخلاق','التحذير من الغيبة والنميمة',              'الشيخ محمد الغامدي', '١٣ محرم ١٤٤٦',  '٣٦ د', '٥ آلاف', false],
];
@endphp

<div class="shared-page" x-data="sermonsPage()">

  {{-- ══ HERO ════════════════════════════════════════════════════ --}}
  <div class="sermons-hero">
    <div class="shared-inner sermons-hero__inner">
      <div class="sermons-hero__text">
        <p class="sermons-hero__eyebrow">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
          </svg>
          أرشيف شامل ومصنّف
        </p>
        <h1 class="sermons-hero__title">خُطَب الجمعة</h1>
        <p class="sermons-hero__sub">خطب الجمعة المختارة من علماء أهل السنة — مرتبة، مصنّفة، قابلة للبحث</p>
      </div>
      <div class="shared-search sermons-hero__search">
        <svg class="shared-search__icon" width="16" height="16" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input class="shared-search__input" type="text" x-model="query"
               placeholder="ابحث بعنوان الخطبة أو موضوعها..." @input="applyFilters()">
        <button x-show="query" @click="query=''; applyFilters()" class="shared-search__clear">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.5" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- ══ FEATURED STRIP ══════════════════════════════════════════ --}}
  <div class="sermons-featured">
    <div class="shared-inner">
      <div class="shared-section-header">
        <div>
          <p class="shared-section-header__eyebrow">الأكثر استماعاً هذا الأسبوع</p>
          <h2 class="shared-section-header__title">خطب مميزة</h2>
        </div>
      </div>
      <div class="sermons-featured__row">
        @foreach($featured as [$title, $sheikh, $topic, $topicId, $dur, $views])
          <a href="/lesson/{{ Str::slug($title) }}" class="sermons-feat-card">
            <div class="sermons-feat-card__color-bar sermons-feat-card__color-bar--{{ $topicId }}"></div>
            <div class="sermons-feat-card__body">
              <div class="sermons-feat-card__top-row">
                <span class="sermons-feat-card__topic-dot sermons-feat-card__topic-dot--{{ $topicId }}"></span>
                <span class="sermons-feat-card__topic-label">{{ $topic }}</span>
                <span class="sermons-feat-card__views">
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  {{ $views }}
                </span>
              </div>
              <h3 class="sermons-feat-card__title">{{ $title }}</h3>
              <div class="sermons-feat-card__footer">
                <span class="sermons-feat-card__sheikh">{{ $sheikh }}</span>
                <span class="sermons-feat-card__dur">
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                  </svg>
                  {{ $dur }}
                </span>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  {{-- ══ SMART FILTER BAR ════════════════════════════════════════
       Hick's Law: Topic tabs always visible (primary, 4 choices max)
       Sheikh: Searchable dropdown — scales to 100+ without clutter
       Sort: Single toggle, rightmost, always available
  ═══════════════════════════════════════════════════════════════ --}}
  <div class="sermons-filter-bar">
    <div class="shared-inner sermons-filter-bar__inner">

      {{-- Row 1: Topic tabs + Sheikh dropdown + Sort --}}
      <div class="sermons-filter-bar__row">

        {{-- Primary: Topic — pill tabs, always visible, ≤5 choices --}}
        <div class="sermons-filter__topic-group">
          @foreach(['all'=>'الكل','aqeedah'=>'عقيدة','fiqh'=>'فقه','akhlaq'=>'أخلاق','ahdath'=>'أحداث'] as $id => $label)
            <button
              class="sermons-filter__topic-btn sermons-filter__topic-btn--{{ $id }}"
              :class="{ 'sermons-filter__topic-btn--active': activeTopic === '{{ $id }}' }"
              @click="activeTopic = '{{ $id }}'; applyFilters()">
              @if($id !== 'all')
                <span class="sermons-filter__topic-dot sermons-filter__topic-dot--{{ $id }}"></span>
              @endif
              {{ $label }}
            </button>
          @endforeach
        </div>

        {{-- Separator --}}
        <div class="sermons-filter-bar__sep"></div>

        {{-- Secondary: Sheikh — searchable dropdown, scales to hundreds --}}
        <div class="sermons-filter__sheikh-wrap" x-data="{ open: false, search: '' }" @click.away="open = false">
          <button
            class="sermons-filter__sheikh-btn"
            :class="{ 'sermons-filter__sheikh-btn--active': activeSheikh !== 'all' }"
            @click="open = !open">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            <span x-text="activeSheikh === 'all' ? 'الشيخ' : sheikhs.find(s=>s.id===activeSheikh)?.name ?? 'الشيخ'"></span>
            <svg class="sermons-filter__chevron" width="11" height="11" viewBox="0 0 16 16"
                 fill="currentColor" :style="open ? 'transform:rotate(180deg)' : ''">
              <path d="M4 6l4 4 4-4H4z"/>
            </svg>
            {{-- Active indicator dot --}}
            <span x-show="activeSheikh !== 'all'" class="sermons-filter__sheikh-active-dot"></span>
          </button>

          {{-- Dropdown: searchable list — solves 100+ sheikhs problem --}}
          <div class="sermons-filter__sheikh-dropdown" x-show="open" x-transition
               @click.stop>
            {{-- Search inside dropdown --}}
            <div class="sermons-filter__sheikh-search">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
              </svg>
              <input
                class="sermons-filter__sheikh-search-input"
                type="text"
                x-model="search"
                placeholder="ابحث عن شيخ..."
                @click.stop
              >
            </div>

            {{-- Options list --}}
            <div class="sermons-filter__sheikh-list">
              {{-- "All" option --}}
              <button
                class="sermons-filter__sheikh-option"
                :class="{ 'sermons-filter__sheikh-option--active': activeSheikh === 'all' }"
                @click="activeSheikh = 'all'; open = false; applyFilters()">
                <span class="sermons-filter__sheikh-option-name">كل المشايخ</span>
                <svg x-show="activeSheikh === 'all'" width="13" height="13" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
              </button>
              {{-- Sheikh options filtered by search --}}
              <template x-for="s in sheikhs.filter(s => s.name.includes(search))" :key="s.id">
                <button
                  class="sermons-filter__sheikh-option"
                  :class="{ 'sermons-filter__sheikh-option--active': activeSheikh === s.id }"
                  @click="activeSheikh = s.id; open = false; applyFilters()">
                  <div class="sermons-filter__sheikh-option-avatar" x-text="s.name.charAt(7) || s.name.charAt(0)"></div>
                  <span class="sermons-filter__sheikh-option-name" x-text="s.name"></span>
                  <span class="sermons-filter__sheikh-option-count" x-text="s.count + ' خطبة'"></span>
                  <svg x-show="activeSheikh === s.id" width="13" height="13" viewBox="0 0 24 24"
                       fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                </button>
              </template>
              {{-- Empty search state --}}
              <p class="sermons-filter__sheikh-empty"
                 x-show="sheikhs.filter(s => s.name.includes(search)).length === 0">
                لا يوجد شيخ بهذا الاسم
              </p>
            </div>
          </div>
        </div>

        {{-- Tertiary: Sort — simple 2-state toggle, rightmost --}}
        <div class="sermons-filter__sort" style="margin-right:auto">
          <button class="sermons-filter__sort-btn"
                  :class="{ 'sermons-filter__sort-btn--active': activeSort === 'newest' }"
                  @click="activeSort = 'newest'">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>
            </svg>
            الأحدث
          </button>
          <button class="sermons-filter__sort-btn"
                  :class="{ 'sermons-filter__sort-btn--active': activeSort === 'popular' }"
                  @click="activeSort = 'popular'">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
            </svg>
            الأكثر استماعاً
          </button>
        </div>

        {{-- Doherty: live result count + active filter pills --}}
        <div class="sermons-filter-bar__status">
          {{-- Active pills (Shneiderman #3) --}}
          <template x-if="activeTopic !== 'all'">
            <span class="sermons-filter__active-pill">
              <span x-text="topicLabels[activeTopic]"></span>
              <button @click="activeTopic='all'; applyFilters()" class="sermons-filter__pill-x">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="3" stroke-linecap="round">
                  <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
              </button>
            </span>
          </template>
          <template x-if="activeSheikh !== 'all'">
            <span class="sermons-filter__active-pill">
              <span x-text="sheikhs.find(s=>s.id===activeSheikh)?.name ?? ''"></span>
              <button @click="activeSheikh='all'; applyFilters()" class="sermons-filter__pill-x">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="3" stroke-linecap="round">
                  <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
              </button>
            </span>
          </template>
          <span class="sermons-filter__count">
            <strong x-text="resultCount"></strong> خطبة
          </span>
        </div>

      </div>
    </div>
  </div>

  {{-- ══ SERMONS GRID ════════════════════════════════════════════
       Grid layout: 3 cols on large, 2 on medium, 1 on mobile
       Each card is a self-contained unit — scannable, balanced
  ═══════════════════════════════════════════════════════════════ --}}
  <div class="sermons-list-section">
    <div class="shared-inner">
      <div class="sermons-grid">
        @foreach($sermons as [$topicId, $topicLabel, $title, $sheikh, $date, $dur, $views, $listened])
          <a href="/lesson/{{ Str::slug($title) }}"
             class="sermon-card {{ $listened ? 'sermon-card--listened' : '' }}">

            {{-- Top: topic indicator + listened badge + views --}}
            <div class="sermon-card__head">
              <div class="sermon-card__topic">
                <span class="sermon-card__topic-dot sermon-card__topic-dot--{{ $topicId }}"></span>
                <span class="sermon-card__topic-label">{{ $topicLabel }}</span>
              </div>
              <div class="sermon-card__head-right">
                @if($listened)
                  <span class="sermon-card__listened">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </span>
                @endif
                <span class="sermon-card__views">
                  <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  {{ $views }}
                </span>
              </div>
            </div>

            {{-- Title — dominant, 2-line clamp --}}
            <h3 class="sermon-card__title">{{ $title }}</h3>

            {{-- Footer: sheikh + date + duration --}}
            <div class="sermon-card__footer">
              <div class="sermon-card__sheikh-row">
                <div class="sermon-card__sheikh-avatar">{{ mb_substr($sheikh, 7, 1, 'UTF-8') }}</div>
                <span class="sermon-card__sheikh">{{ $sheikh }}</span>
              </div>
              <div class="sermon-card__meta-row">
                <span class="sermon-card__date">{{ $date }}</span>
                <span class="sermon-card__dur">
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                  </svg>
                  {{ $dur }}
                </span>
              </div>
            </div>

            {{-- Hover play indicator --}}
            <div class="sermon-card__play-hint">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
              استمع الآن
            </div>

          </a>
        @endforeach
      </div>

      {{-- Empty state --}}
      <div x-show="resultCount === 0" class="shared-empty" style="margin-top:2rem">
        <div class="shared-empty__icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
          </svg>
        </div>
        <h3 class="shared-empty__title">لم نجد خطبة مطابقة</h3>
        <p class="shared-empty__desc">جرّب البحث بكلمات مختلفة أو غيّر الفلاتر</p>
        <button @click="activeTopic='all'; activeSheikh='all'; query=''; applyFilters()"
                class="shared-btn-outline" style="margin-top:.75rem;font-size:.82rem">
          إعادة ضبط الفلاتر
        </button>
      </div>
    </div>
  </div>

</div>

<script>
function sermonsPage() {
  return {
    query: '',
    activeTopic: 'all',
    activeSheikh: 'all',
    activeSort: 'newest',
    resultCount: 12,
    topicLabels: {
      aqeedah: 'عقيدة', fiqh: 'فقه', akhlaq: 'أخلاق', ahdath: 'أحداث'
    },
    sheikhs: [
      { id: 'hajouri',  name: 'الشيخ يحيى الحجوري',  count: 47 },
      { id: 'aziz',     name: 'الشيخ عبد العزيز',     count: 38 },
      { id: 'ghamidi',  name: 'الشيخ محمد الغامدي',  count: 29 },
      { id: 'fawzan',   name: 'الشيخ صالح الفوزان',  count: 52 },
      { id: 'uthaymin', name: 'الشيخ ابن عثيمين',    count: 64 },
      { id: 'albani',   name: 'الشيخ الألباني',       count: 31 },
      { id: 'muqbil',   name: 'الشيخ مقبل الوادعي',  count: 22 },
      { id: 'rabiee',   name: 'الشيخ ربيع المدخلي',  count: 18 },
    ],
    applyFilters() {
      this.resultCount = Math.max(0, 12 - Math.floor(Math.random() * 3));
    }
  }
}
</script>
@endsection