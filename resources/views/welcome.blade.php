@extends('layouts.app')
@section('content')

{{-- welcome.blade.php | prefix: welcome- --}}
<div class="shared-page" x-data="{ query: '' }">

  {{-- ══ HERO ══════════════════════════════════════════════════ --}}
  <section class="welcome-hero">
    <div class="shared-inner welcome-hero__inner">

      <p class="welcome-hero__eyebrow">
        <span class="welcome-hero__eyebrow-dot"></span>
        موسوعة علمية شرعية موثّقة
      </p>

      <h1 class="welcome-hero__title">
        تعلّم دينك من<br>
        <em class="welcome-hero__title-em">المصادر الصحيحة</em>
      </h1>

      <p class="welcome-hero__subtitle">
        مرجعك الشامل للدروس الشرعية والكتب الإسلامية وفتاوى العلماء المعتمدين —
        مُرتّبة ومُفهرسة لتيسير الوصول إلى المعرفة.
      </p>

      {{-- Unified Search --}}
      <div class="welcome-hero__search-wrap" x-data="{ focused: false }">
        <div class="welcome-hero__search-box" :class="{ 'welcome-hero__search-box--active': focused }">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="welcome-hero__search-icon">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
          </svg>
          <input
            class="welcome-hero__search-input"
            type="text"
            x-model="query"
            placeholder="ابحث في الدروس والكتب والفتاوى..."
            @focus="focused = true"
            @blur="focused = false"
            @keydown.enter="window.location = '/search?q=' + encodeURIComponent(query)"
          >
          <button x-show="query.length > 0" @click="query = ''" class="welcome-hero__search-clear">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
          <a :href="'/search?q=' + encodeURIComponent(query)" class="welcome-hero__search-btn">بحث</a>
        </div>
        <div class="welcome-hero__hints">
          <span>بحث سريع:</span>
          @foreach(['التوحيد','الصلاة','الزكاة','الحديث'] as $hint)
            <a href="/search?q={{ $hint }}" class="welcome-hero__hint">{{ $hint }}</a>
          @endforeach
        </div>
      </div>

      {{-- Stats --}}
      <div class="welcome-hero__stats">
        @foreach([['+٢٠٠٠','درس علمي'],['+٣٨٠','كتاب وشرح'],['+٥٠٠','فتوى معتمدة'],['+١٢','شيخ وعالم']] as [$n,$l])
          <div class="welcome-hero__stat">
            <span class="welcome-hero__stat-num">{{ $n }}</span>
            <span class="welcome-hero__stat-label">{{ $l }}</span>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  {{-- ══ SPECIALIZATIONS ════════════════════════════════════════ --}}
  <section class="welcome-specs">
    <div class="shared-inner">
      <header class="shared-section-header">
        <div>
          <p class="shared-section-header__eyebrow">التخصصات</p>
          <h2 class="shared-section-header__title">ابدأ من تخصصك</h2>
        </div>
      </header>
      <div class="welcome-specs__grid">
        @php
        $specs = [
          ['aqeedah','العقيدة',  '١٤ مقرراً','M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'],
          ['fiqh',  'الفقه',    '٢٢ مقرراً','M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z M14 2v6h6'],
          ['hadith','الحديث',   '١١ مقرراً','M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z'],
          ['tafsir','التفسير',  '٩ مقررات', 'M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z'],
          ['seerah','السيرة',   '٦ مقررات', 'M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.501 5.501 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z'],
          ['akhlaq','الأخلاق', '٥ مقررات', 'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5'],
        ];
        @endphp
        @foreach($specs as [$id,$name,$count,$path])
          <a href="/curricula?section={{ $id }}" class="welcome-spec-card welcome-spec-card--{{ $id }}">
            <div class="welcome-spec-card__icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="{{ $path }}"/>
              </svg>
            </div>
            <h3 class="welcome-spec-card__name">{{ $name }}</h3>
            <p class="welcome-spec-card__count">{{ $count }}</p>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ══ FEATURED CURRICULA ══════════════════════════════════════ --}}
  <section class="welcome-featured">
    <div class="shared-inner">
      <header class="shared-section-header">
        <div>
          <p class="shared-section-header__eyebrow">الأكثر متابعة</p>
          <h2 class="shared-section-header__title">مقررات مميزة</h2>
        </div>
        <a href="/curricula" class="shared-section-header__link">
          عرض الكل
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </header>
      <div class="welcome-curr__row">
        @php
        $curricula = [
          ['الأصول الثلاثة',        'الإمام محمد بن عبد الوهاب','الشيخ يحيى الحجوري','aqeedah','٤٧','مبتدئ', true,  '١٢ ألف'],
          ['العقيدة الواسطية',       'شيخ الإسلام ابن تيمية',   'الشيخ عبد العزيز',  'aqeedah','٣٢','متوسط', false, '٨ آلاف'],
          ['الأربعون النووية',       'الإمام النووي',            'الشيخ محمد الغامدي','hadith', '٤٢','مبتدئ', false, '٢١ ألف'],
          ['زاد المستقنع',          'الحجاوي',                  'الشيخ ابن عثيمين',  'fiqh',   '٨٩','متوسط', false, '٦ آلاف'],
        ];
        $sectionNames = ['aqeedah'=>'عقيدة','hadith'=>'حديث','fiqh'=>'فقه','tafsir'=>'تفسير'];
        @endphp
        @foreach($curricula as [$title,$author,$sheikh,$sec,$lessons,$lvl,$popular,$views])
          <a href="/curriculum/{{ Str::slug($title) }}" class="welcome-curr-card">
            <div class="welcome-curr-card__top">
              <span class="shared-tag shared-tag--{{ $sec }}">{{ $sectionNames[$sec] ?? $sec }}</span>
              @if($popular)
                <span class="shared-tag shared-tag--popular">
                  <svg width="9" height="9" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  الأكثر متابعة
                </span>
              @endif
            </div>
            <h3 class="welcome-curr-card__title">{{ $title }}</h3>
            <p class="welcome-curr-card__author">{{ $author }}</p>
            <div class="shared-sheikh">
              <div class="shared-sheikh__avatar">{{ mb_substr($sheikh, 7, 1, 'UTF-8') }}</div>
              <span class="shared-sheikh__name" style="font-size:.78rem">{{ $sheikh }}</span>
            </div>
            <div class="welcome-curr-card__footer">
              <span class="shared-social-proof">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                {{ $views }}
              </span>
              <div style="display:flex;align-items:center;gap:6px">
                <span style="font-size:.75rem;color:var(--text-muted-day)">{{ $lessons }} درس</span>
                @php $lvlClass = $lvl==='مبتدئ'?'beginner':($lvl==='متوسط'?'intermediate':'advanced'); @endphp
                <span class="shared-tag shared-tag--level-{{ $lvlClass }}">{{ $lvl }}</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ══ QUICK NAVIGATION ════════════════════════════════════════ --}}
  <section class="welcome-quicknav">
    <div class="shared-inner">
      <div class="welcome-quicknav__grid">

        {{-- Latest lessons --}}
        <div class="welcome-qpanel">
          <div class="welcome-qpanel__head">
            <div class="welcome-qpanel__icon welcome-qpanel__icon--lessons">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
            </div>
            <div>
              <h3 class="welcome-qpanel__title">آخر الدروس</h3>
              <p class="welcome-qpanel__sub">أحدث ما أُضيف</p>
            </div>
            <a href="/lessons" class="welcome-qpanel__more">الكل</a>
          </div>
          <ul class="welcome-qpanel__list">
            @foreach([
              ['شرح كتاب التوحيد — الدرس ٣','aqeedah','عقيدة','منذ يوم',   '١٢٠'],
              ['أحكام صلاة الجماعة ومسائلها','fiqh',   'فقه',  'منذ يومين','٨٧' ],
              ['مصطلح الحديث — المقدمة',      'hadith', 'حديث', 'منذ ٣ أيام','٢١٤'],
              ['تفسير البقرة الآيات ١-٥',     'tafsir', 'تفسير','منذ أسبوع','٣٤١'],
            ] as [$t,$secId,$secLabel,$ago,$v])
              <li>
                <a href="#" class="welcome-qpanel__item">
                  <div class="welcome-qpanel__item-dot"></div>
                  <div class="welcome-qpanel__item-body">
                    <span class="welcome-qpanel__item-title">{{ $t }}</span>
                    <div class="welcome-qpanel__item-meta">
                      <span class="shared-tag shared-tag--{{ $secId }}" style="font-size:.62rem;padding:1px 6px">{{ $secLabel }}</span>
                      <span>{{ $ago }}</span>
                      <span class="shared-social-proof" style="font-size:.68rem">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        {{ $v }}
                      </span>
                    </div>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- Trending fatwas --}}
        <div class="welcome-qpanel">
          <div class="welcome-qpanel__head">
            <div class="welcome-qpanel__icon welcome-qpanel__icon--fatawa">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div>
              <h3 class="welcome-qpanel__title">الفتاوى الأكثر بحثاً</h3>
              <p class="welcome-qpanel__sub">هذا الأسبوع</p>
            </div>
            <a href="/fatwas" class="welcome-qpanel__more">الكل</a>
          </div>
          <ul class="welcome-qpanel__list">
            @foreach([
              ['حكم قراءة القرآن من الهاتف بلا وضوء','fiqh',  'فقه'  ],
              ['هل تجب الزكاة على مال الأطفال؟',       'fiqh',  'فقه'  ],
              ['حكم الصلاة خلف الإمام الفاسق',         'fiqh',  'فقه'  ],
              ['حكم الاحتفال بالمولد النبوي الشريف',   'aqeedah','عقيدة'],
            ] as [$t,$secId,$secLabel])
              <li>
                <a href="#" class="welcome-qpanel__item">
                  <div class="welcome-qpanel__item-dot welcome-qpanel__item-dot--fatwa"></div>
                  <div class="welcome-qpanel__item-body">
                    <span class="welcome-qpanel__item-title">{{ $t }}</span>
                    <span class="shared-tag shared-tag--{{ $secId }}" style="font-size:.62rem;padding:1px 6px">{{ $secLabel }}</span>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>

      </div>
    </div>
  </section>

</div>
@endsection
