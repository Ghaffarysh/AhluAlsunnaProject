@extends('layouts.app')
@section('content')

{{-- lectures.blade.php | prefix: lectures- --}}
@php
$featured = [
  ['أسباب النصر والهزيمة في ضوء السنة',    'الشيخ يحيى الحجوري', 'aqeedah','عقيدة','١ ساعة ٢٢ د','١٨ ألف'],
  ['الشباب والتحديات المعاصرة',              'الشيخ عبد العزيز',   'akhlaq', 'أخلاق','٥٨ د',        '١١ ألف'],
  ['الإسلام والعلم — لا تعارض بين الوحي',  'الشيخ محمد الغامدي', 'aqeedah','عقيدة','١ ساعة ٥ د',  '٩ آلاف'],
  ['مفهوم التوبة وشروط قبولها',             'الشيخ يحيى الحجوري', 'akhlaq', 'أخلاق','٤٥ د',        '٨ آلاف'],
];

$lectures = [
  ['single','aqeedah','عقيدة','أسباب النصر والهزيمة في ضوء السنة',    'الشيخ يحيى الحجوري','١ ساعة ٢٢ د','١٨ ألف',null, true ],
  ['single','akhlaq', 'أخلاق','الشباب والتحديات المعاصرة — رؤية شرعية','الشيخ عبد العزيز',   '٥٨ د',        '١١ ألف',null, false],
  ['single','aqeedah','عقيدة','الإسلام والعلم — لا تعارض بين الوحي',   'الشيخ محمد الغامدي', '١ ساعة ٥ د',  '٩ آلاف', null, false],
  ['multi', 'fiqh',   'فقه',  'التحذير من فتنة المال',                  'الشيخ يحيى الحجوري', null,          '١٤ ألف', 2,    false],
  ['single','akhlaq', 'أخلاق','الإخلاص وخطر العجب بالنفس',             'الشيخ عبد العزيز',   '٤٧ د',        '٦ آلاف', null, true ],
  ['single','aqeedah','عقيدة','الفرق بين التوسل المشروع والمحرم',       'الشيخ محمد الغامدي', '١ ساعة ١٣ د', '٧ آلاف', null, false],
  ['multi', 'aqeedah','عقيدة','الدفاع عن السنة في مواجهة الطعون',       'الشيخ يحيى الحجوري', null,          '٢١ ألف', 3,    false],
  ['single','fiqh',   'فقه',  'أحكام المعاملات المالية المعاصرة',       'الشيخ عبد العزيز',   '١ ساعة ٣٠ د', '٥ آلاف', null, false],
  ['single','akhlaq', 'أخلاق','مفهوم التوبة وشروط قبولها',              'الشيخ يحيى الحجوري', '٤٥ د',        '٨ آلاف', null, false],
  ['single','hadith', 'حديث', 'منهج المحدثين في قبول الروايات',         'الشيخ محمد الغامدي', '١ ساعة ٨ د',  '٦ آلاف', null, false],
  ['multi', 'fiqh',   'فقه',  'فقه الزكاة المعاصرة',                    'الشيخ عبد العزيز',   null,          '٩ آلاف', 2,    false],
  ['single','aqeedah','عقيدة','أهمية الإخلاص في العبادة',               'الشيخ يحيى الحجوري', '٣٩ د',        '٧ آلاف', null, true ],
];

$sheikhs = [
  ['hajouri',  'الشيخ يحيى الحجوري',  '٦٣ محاضرة'],
  ['aziz',     'الشيخ عبد العزيز',     '٤٩ محاضرة'],
  ['ghamidi',  'الشيخ محمد الغامدي',  '٣٨ محاضرة'],
  ['fawzan',   'الشيخ صالح الفوزان',  '٥٤ محاضرة'],
  ['uthaymin', 'الشيخ ابن عثيمين',    '٧١ محاضرة'],
  ['albani',   'الشيخ الألباني',       '٤٢ محاضرة'],
  ['muqbil',   'الشيخ مقبل الوادعي',  '٢٨ محاضرة'],
];
@endphp

<div class="shared-page" x-data="lecturesPage()">

  {{-- ══ HERO ════════════════════════════════════════════════════ --}}
  <div class="lectures-hero">
    <div class="shared-inner lectures-hero__inner">
      <div>
        <p class="lectures-hero__eyebrow">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/>
          </svg>
          مستقلة عن المقررات
        </p>
        <h1 class="lectures-hero__title">المحاضرات العامة</h1>
        <p class="lectures-hero__sub">محاضرات علمية مستقلة لكبار علماء أهل السنة — مرتبة بالأحدث والأكثر متابعة</p>
      </div>
      <div class="shared-search lectures-hero__search">
        <svg class="shared-search__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input class="shared-search__input" type="text" x-model="query"
               placeholder="ابحث بعنوان المحاضرة أو الشيخ أو الموضوع...">
        <button x-show="query" @click="query=''" class="shared-search__clear">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- ══ FEATURED ════════════════════════════════════════════════ --}}
  <div class="lectures-featured">
    <div class="shared-inner">
      <div class="shared-section-header">
        <div>
          <p class="shared-section-header__eyebrow">الأكثر متابعة</p>
          <h2 class="shared-section-header__title">محاضرات مميزة</h2>
        </div>
      </div>
      <div class="lectures-featured__row">
        @foreach($featured as [$title,$sheikh,$topicId,$topicLabel,$dur,$views])
          <a href="/lesson/{{ Str::slug($title) }}" class="lectures-feat-card lectures-feat-card--{{ $topicId }}">
            <div class="lectures-feat-card__color-bar lectures-feat-card__color-bar--{{ $topicId }}"></div>
            <div class="lectures-feat-card__body">
              <div class="lectures-feat-card__top-row">
                <span class="lectures-feat-card__topic-dot lectures-feat-card__topic-dot--{{ $topicId }}"></span>
                <span class="lectures-feat-card__topic-label">{{ $topicLabel }}</span>
                <span class="lectures-feat-card__views">
                  <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                  {{ $views }}
                </span>
              </div>
              <h3 class="lectures-feat-card__title">{{ $title }}</h3>
              <div class="lectures-feat-card__footer">
                <span class="lectures-feat-card__sheikh">{{ $sheikh }}</span>
                <span class="lectures-feat-card__dur">
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  {{ $dur }}
                </span>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  {{-- ══ SMART FILTER BAR ════════════════════════════════════════ --}}
  <div class="sermons-filter-bar">
    <div class="shared-inner sermons-filter-bar__inner">
      <div class="sermons-filter-bar__row">

        {{-- Topic tabs --}}
        <div class="sermons-filter__topic-group">
          @foreach(['all'=>'الكل','aqeedah'=>'عقيدة','fiqh'=>'فقه','akhlaq'=>'أخلاق','hadith'=>'حديث'] as $id => $label)
            <button
              class="sermons-filter__topic-btn sermons-filter__topic-btn--{{ $id }}"
              :class="{ 'sermons-filter__topic-btn--active': activeTopic === '{{ $id }}' }"
              @click="activeTopic = '{{ $id }}'">
              @if($id !== 'all')<span class="sermons-filter__topic-dot sermons-filter__topic-dot--{{ $id }}"></span>@endif
              {{ $label }}
            </button>
          @endforeach
        </div>

        <div class="sermons-filter-bar__sep"></div>

        {{-- Sheikh searchable dropdown --}}
        <div class="sermons-filter__sheikh-wrap" x-data="{ open: false, search: '' }" @click.away="open = false">
          <button
            class="sermons-filter__sheikh-btn"
            :class="{ 'sermons-filter__sheikh-btn--active': activeSheikh !== 'all' }"
            @click="open = !open">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>
            <span x-text="activeSheikh === 'all' ? 'الشيخ' : sheikhs.find(s=>s.id===activeSheikh)?.name ?? 'الشيخ'"></span>
            <svg class="sermons-filter__chevron" width="11" height="11" viewBox="0 0 16 16" fill="currentColor"
                 :style="open ? 'transform:rotate(180deg)' : ''"><path d="M4 6l4 4 4-4H4z"/></svg>
            <span x-show="activeSheikh !== 'all'" class="sermons-filter__sheikh-active-dot"></span>
          </button>
          <div class="sermons-filter__sheikh-dropdown" x-show="open" x-transition @click.stop>
            <div class="sermons-filter__sheikh-search">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
              <input class="sermons-filter__sheikh-search-input" type="text" x-model="search" placeholder="ابحث عن شيخ..." @click.stop>
            </div>
            <div class="sermons-filter__sheikh-list">
              <button class="sermons-filter__sheikh-option" :class="{'sermons-filter__sheikh-option--active':activeSheikh==='all'}"
                      @click="activeSheikh='all';open=false">
                <span class="sermons-filter__sheikh-option-name">كل المشايخ</span>
                <svg x-show="activeSheikh==='all'" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
              </button>
              <template x-for="s in sheikhs.filter(s=>s.name.includes(search))" :key="s.id">
                <button class="sermons-filter__sheikh-option"
                        :class="{'sermons-filter__sheikh-option--active':activeSheikh===s.id}"
                        @click="activeSheikh=s.id;open=false">
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

        {{-- Type filter: single / multi-part --}}
        <div class="sermons-filter__sort" style="margin-right:auto">
          <button class="sermons-filter__sort-btn" :class="{'sermons-filter__sort-btn--active':activeType==='all'}"   @click="activeType='all'">الكل</button>
          <button class="sermons-filter__sort-btn" :class="{'sermons-filter__sort-btn--active':activeType==='single'}" @click="activeType='single'">مستقلة</button>
          <button class="sermons-filter__sort-btn" :class="{'sermons-filter__sort-btn--active':activeType==='multi'}"  @click="activeType='multi'">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            متعددة الأجزاء
          </button>
        </div>

        {{-- Status --}}
        <div class="sermons-filter-bar__status">
          <template x-if="activeTopic !== 'all'">
            <span class="sermons-filter__active-pill">
              <span x-text="topicLabels[activeTopic]"></span>
              <button @click="activeTopic='all'" class="sermons-filter__pill-x">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            </span>
          </template>
          <template x-if="activeSheikh !== 'all'">
            <span class="sermons-filter__active-pill">
              <span x-text="sheikhs.find(s=>s.id===activeSheikh)?.name??''"></span>
              <button @click="activeSheikh='all'" class="sermons-filter__pill-x">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            </span>
          </template>
          <span class="sermons-filter__count"><strong>{{ count($lectures) }}</strong> محاضرة</span>
        </div>

      </div>
    </div>
  </div>

  {{-- ══ LECTURES — Grid + multi-part collapsible ════════════════ --}}
  <div class="lectures-list-section">
    <div class="shared-inner">
      <div class="lectures-grid">
        @foreach($lectures as $lecture)
          @php [$type,$topicId,$topicLabel,$title,$sheikh,$dur,$views,$parts,$listened] = $lecture; @endphp

          @if($type === 'single')
            {{-- Single-part: full card identical to sermon-card but for lectures --}}
            <a href="/lesson/{{ Str::slug($title) }}"
               class="sermon-card lecture-card lecture-card--{{ $topicId }} {{ $listened ? 'sermon-card--listened' : '' }}">

              <div class="sermon-card__head">
                <div class="sermon-card__topic">
                  <span class="sermon-card__topic-dot sermon-card__topic-dot--{{ $topicId }}"></span>
                  <span class="sermon-card__topic-label">{{ $topicLabel }}</span>
                </div>
                <div class="sermon-card__head-right">
                  @if($listened)
                    <span class="sermon-card__listened">
                      <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                  @endif
                  <span class="sermon-card__views">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    {{ $views }}
                  </span>
                </div>
              </div>

              <h3 class="sermon-card__title">{{ $title }}</h3>

              <div class="sermon-card__footer">
                <div class="sermon-card__sheikh-row">
                  <div class="sermon-card__sheikh-avatar">{{ mb_substr($sheikh, 7, 1, 'UTF-8') }}</div>
                  <span class="sermon-card__sheikh">{{ $sheikh }}</span>
                </div>
                <div class="sermon-card__meta-row">
                  <span class="sermon-card__date">{{ $dur }}</span>
                  <span class="sermon-card__dur">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ $dur }}
                  </span>
                </div>
              </div>

              <div class="sermon-card__play-hint">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                استمع الآن
              </div>
            </a>

          @else
            {{-- Multi-part: spans full row, collapsible --}}
            <div class="lecture-multipart lecture-multipart--{{ $topicId }}" x-data="{ open: false }">
              <button class="lecture-multipart__header" @click="open = !open">
                <div class="lecture-multipart__topic">
                  <span class="sermon-card__topic-dot sermon-card__topic-dot--{{ $topicId }}"></span>
                  <span class="sermon-card__topic-label">{{ $topicLabel }}</span>
                  <span class="lecture-multipart__badge">{{ $parts }} أجزاء</span>
                </div>
                <h3 class="lecture-multipart__title">{{ $title }}</h3>
                <div class="lecture-multipart__foot">
                  <div class="sermon-card__sheikh-row" style="gap:6px">
                    <div class="sermon-card__sheikh-avatar" style="width:20px;height:20px;font-size:.6rem">{{ mb_substr($sheikh, 7, 1, 'UTF-8') }}</div>
                    <span style="font-size:.77rem;color:var(--text-muted-day)">{{ $sheikh }}</span>
                  </div>
                  <div style="display:flex;align-items:center;gap:8px">
                    <span class="shared-social-proof" style="font-size:.71rem">
                      <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                      {{ $views }}
                    </span>
                    <div class="lecture-multipart__toggle" :class="{ 'lecture-multipart__toggle--open': open }">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M6 9l6 6 6-6"/>
                      </svg>
                    </div>
                  </div>
                </div>
              </button>
              <div class="lecture-multipart__parts" x-show="open" x-transition>
                @for($p = 1; $p <= $parts; $p++)
                  <a href="/lesson/{{ Str::slug($title) }}-{{ $p }}" class="lectures-part-row">
                    <div class="lectures-part-row__num">{{ $p }}</div>
                    <span class="lectures-part-row__label">الجزء {{ $p }} — {{ $title }}</span>
                    <span class="lectures-part-row__dur">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                      ~٥٠ د
                    </span>
                    <svg class="lectures-part-row__arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M15 18l-6-6 6-6"/></svg>
                  </a>
                @endfor
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>

</div>

<script>
function lecturesPage() {
  return {
    query: '',
    activeTopic: 'all',
    activeSheikh: 'all',
    activeType: 'all',
    topicLabels: { aqeedah:'عقيدة', fiqh:'فقه', akhlaq:'أخلاق', hadith:'حديث' },
    sheikhs: [
      { id:'hajouri',  name:'الشيخ يحيى الحجوري',  count:'٦٣ محاضرة', initial:'ي' },
      { id:'aziz',     name:'الشيخ عبد العزيز',     count:'٤٩ محاضرة', initial:'ع' },
      { id:'ghamidi',  name:'الشيخ محمد الغامدي',  count:'٣٨ محاضرة', initial:'م' },
      { id:'fawzan',   name:'الشيخ صالح الفوزان',  count:'٥٤ محاضرة', initial:'ص' },
      { id:'uthaymin', name:'الشيخ ابن عثيمين',    count:'٧١ محاضرة', initial:'م' },
      { id:'albani',   name:'الشيخ الألباني',       count:'٤٢ محاضرة', initial:'م' },
      { id:'muqbil',   name:'الشيخ مقبل الوادعي',  count:'٢٨ محاضرة', initial:'م' },
    ],
  }
}
</script>
@endsection