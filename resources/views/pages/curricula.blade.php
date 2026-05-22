@extends('layouts.app')
@section('content')

{{-- curricula.blade.php | prefix: curricula- --}}
@php
$section = request('section', 'all');
$sectionNames = ['all'=>'جميع التخصصات','aqeedah'=>'العقيدة','fiqh'=>'الفقه','hadith'=>'الحديث','tafsir'=>'التفسير','seerah'=>'السيرة','akhlaq'=>'الأخلاق'];
$sectionLabel = $sectionNames[$section] ?? 'جميع التخصصات';
@endphp

<div class="shared-page" x-data="curriculaPage()">

  {{-- Breadcrumb --}}
  <nav class="shared-breadcrumb" aria-label="مسار التنقل">
    <div class="shared-inner">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><span class="shared-breadcrumb__current">{{ $sectionLabel }}</span></li>
      </ol>
    </div>
  </nav>

  {{-- Page header --}}
  <div class="curricula-page-header">
    <div class="shared-inner">
      <h1 class="curricula-page-header__title">{{ $sectionLabel }}</h1>
      <p class="curricula-page-header__meta" x-text="`أنت في قسم ${sectionLabel} — ${filteredCount} مقرراً`"></p>
    </div>
  </div>

  {{-- Filter bar --}}
  <div class="shared-filter-bar">
    <div class="shared-inner shared-filter-bar__inner">

      {{-- Section tabs --}}
      <div class="shared-filter-tabs" role="tablist">
        @foreach($sectionNames as $id => $label)
          <a href="/curricula?section={{ $id }}"
             class="shared-filter-tab {{ $section === $id ? 'shared-filter-tab--active' : '' }}"
             role="tab">{{ $label }}</a>
        @endforeach
      </div>

      {{-- Level filter --}}
      <div class="curricula-filter__select-wrap" x-data="{ open: false }" @click.away="open = false">
        <button class="curricula-filter__select-btn" @click="open = !open"
          :class="{ 'curricula-filter__select-btn--active': activeLevel !== 'all' }">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
          <span x-text="activeLevel === 'all' ? 'المستوى' : levels.find(l=>l.id===activeLevel)?.label"></span>
          <svg width="11" height="11" viewBox="0 0 16 16" fill="currentColor" :style="open?'transform:rotate(180deg)':''"><path d="M4 6l4 4 4-4H4z"/></svg>
        </button>
        <div class="curricula-filter__dropdown" x-show="open" x-transition>
          <template x-for="l in levels" :key="l.id">
            <button class="curricula-filter__option" :class="{'curricula-filter__option--active': activeLevel===l.id}" @click="activeLevel=l.id; open=false; filterCurricula()" x-text="l.label"></button>
          </template>
        </div>
      </div>

      {{-- Sheikh filter --}}
      <div class="curricula-filter__select-wrap" x-data="{ open: false }" @click.away="open = false">
        <button class="curricula-filter__select-btn" @click="open = !open"
          :class="{ 'curricula-filter__select-btn--active': activeSheikh !== 'all' }">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <span x-text="activeSheikh === 'all' ? 'الشيخ' : activeSheikh"></span>
          <svg width="11" height="11" viewBox="0 0 16 16" fill="currentColor" :style="open?'transform:rotate(180deg)':''"><path d="M4 6l4 4 4-4H4z"/></svg>
        </button>
        <div class="curricula-filter__dropdown" x-show="open" x-transition>
          <button class="curricula-filter__option" :class="{'curricula-filter__option--active':activeSheikh==='all'}" @click="activeSheikh='all';open=false;filterCurricula()">كل المشايخ</button>
          @foreach(['الشيخ يحيى الحجوري','الشيخ عبد العزيز','الشيخ محمد الغامدي','الشيخ ابن عثيمين'] as $sh)
            <button class="curricula-filter__option" :class="{'curricula-filter__option--active':activeSheikh==='{{ $sh }}'}" @click="activeSheikh='{{ $sh }}';open=false;filterCurricula()">{{ $sh }}</button>
          @endforeach
        </div>
      </div>

      {{-- Result count --}}
      <span class="shared-result-count" x-show="isFiltering">
        <span class="curricula-skeleton-dots">
          <span></span><span></span><span></span>
        </span>
      </span>
      <span class="shared-result-count" x-show="!isFiltering">
        عُثر على <strong x-text="filteredCount"></strong> مقرراً
      </span>

      {{-- Reset --}}
      <button class="shared-btn-ghost" x-show="activeLevel!=='all' || activeSheikh!=='all'" @click="activeLevel='all';activeSheikh='all';filterCurricula()">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
        إعادة تعيين
      </button>

    </div>
  </div>

  {{-- Curricula Grid --}}
  <div class="curricula-grid-section">
    <div class="shared-inner">
      <div class="curricula-grid">
        @php
        $items = [
          ['الأصول الثلاثة',         'الإمام محمد بن عبد الوهاب','الشيخ يحيى الحجوري','aqeedah','٤٧','مبتدئ', true,  '١٢ ألف','أتم هذا المقرر لتفهم أسس العقيدة الإسلامية من أول المتون.'],
          ['العقيدة الواسطية',        'شيخ الإسلام ابن تيمية',   'الشيخ عبد العزيز',  'aqeedah','٣٢','متوسط', false, '٨ آلاف','شرح موسّع لمتن ابن تيمية في العقيدة السلفية.'],
          ['الأربعون النووية',        'الإمام النووي',            'الشيخ محمد الغامدي','hadith', '٤٢','مبتدئ', true,  '٢١ ألف','اثنان وأربعون حديثاً جامعاً لأصول الإسلام.'],
          ['زاد المستقنع',           'الحجاوي',                  'الشيخ ابن عثيمين',  'fiqh',   '٨٩','متوسط', false, '٦ آلاف','من أهم متون الفقه الحنبلي وأجمعها.'],
          ['بلوغ المرام',             'الحافظ ابن حجر',           'الشيخ عبد العزيز',  'hadith', '٦٠','متقدم', false, '٤ آلاف','أحاديث الأحكام مستخرجة بدقة من الصحاح.'],
          ['تفسير جزء عمّ',          'الإمام ابن كثير',          'الشيخ محمد الغامدي','tafsir', '٣٠','مبتدئ', false, '٩ آلاف','تفسير ميسّر لسور الجزء الثلاثين.'],
          ['الآجرومية',               'ابن آجروم',                'الشيخ يحيى الحجوري','akhlaq', '٢٠','مبتدئ', false, '١١ ألف','أول ما يُبدأ به في تعلّم النحو العربي.'],
          ['كتاب التوحيد',           'الإمام محمد بن عبد الوهاب','الشيخ يحيى الحجوري','aqeedah','٥٢','متوسط', false, '١٤ ألف','الكتاب الذي يُحقق معنى لا إله إلا الله.'],
        ];
        @endphp
        @foreach($items as [$title,$author,$sheikh,$sec,$lessons,$lvl,$popular,$views,$desc])
          <a href="/curriculum/{{ Str::slug($title) }}" class="curricula-card">
            {{-- Spine color --}}
            <div class="curricula-card__spine curricula-card__spine--{{ $sec }}"></div>

            <div class="curricula-card__body">
              <div class="curricula-card__top">
                <span class="shared-tag shared-tag--{{ $sec }}">{{ ['aqeedah'=>'عقيدة','hadith'=>'حديث','fiqh'=>'فقه','tafsir'=>'تفسير','akhlaq'=>'أخلاق'][$sec] }}</span>
                @if($popular)
                  <span class="shared-tag shared-tag--popular">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    الأكثر متابعة
                  </span>
                @endif
              </div>

              <h3 class="curricula-card__title">{{ $title }}</h3>
              <p class="curricula-card__author">{{ $author }}</p>
              <p class="curricula-card__desc">{{ $desc }}</p>

              <div class="shared-sheikh curricula-card__sheikh">
                <div class="shared-sheikh__avatar">{{ mb_substr($sheikh, 7, 1, 'UTF-8') }}</div>
                <div>
                  <div class="shared-sheikh__name">{{ $sheikh }}</div>
                  <div class="shared-sheikh__role">الشارح</div>
                </div>
              </div>

              <div class="curricula-card__footer">
                <div class="curricula-card__stats">
                  <span class="curricula-card__stat">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    {{ $lessons }} درس
                  </span>
                  <span class="curricula-card__stat shared-social-proof">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    {{ $views }}
                  </span>
                </div>
                @php $lvlClass = $lvl==='مبتدئ'?'beginner':($lvl==='متوسط'?'intermediate':'advanced'); @endphp
                <span class="shared-tag shared-tag--level-{{ $lvlClass }}">{{ $lvl }}</span>
              </div>

              <div class="curricula-card__cta">ابدأ المقرر</div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

</div>

<script>
function curriculaPage() {
  return {
    activeLevel: 'all',
    activeSheikh: 'all',
    filteredCount: 8,
    isFiltering: false,
    sectionLabel: '{{ $sectionLabel }}',
    levels: [
      { id: 'all', label: 'كل المستويات' },
      { id: 'beginner', label: 'مبتدئ' },
      { id: 'intermediate', label: 'متوسط' },
      { id: 'advanced', label: 'متقدم' },
    ],
    filterCurricula() {
      this.isFiltering = true;
      setTimeout(() => {
        this.filteredCount = Math.floor(Math.random() * 6) + 3;
        this.isFiltering = false;
      }, 400);
    }
  }
}
</script>
@endsection
