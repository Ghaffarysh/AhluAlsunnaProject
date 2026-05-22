@extends('layouts.app')
@section('content')

{{-- fatwas.blade.php | prefix: fatwas- --}}
<div class="shared-page" x-data="fatwasPage()">

  {{-- ══ HERO: Search + Ask CTA ══════════════════════════════ --}}
  <div class="fatwas-hero">
    <div class="shared-inner fatwas-hero__inner">

      <div class="fatwas-hero__title-row">
        <div>
          <h1 class="fatwas-hero__title">الفتاوى الشرعية</h1>
          <p class="fatwas-hero__sub">إجابات موثّقة من علماء معتمدين</p>
        </div>
        {{-- Ask CTA — always beside title (peak frustration moment fix) --}}
        <a href="/ask-fatwa" class="shared-btn-primary fatwas-hero__ask-btn">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          اسأل سؤالاً
        </a>
      </div>

      {{-- Unified search row --}}
      <div class="fatwas-hero__search-row">
        <div class="shared-search fatwas-hero__search-box">
          <svg class="shared-search__icon" width="16" height="16" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
          </svg>
          <input class="shared-search__input" type="text" x-model="query"
                 placeholder="ابحث في الفتاوى بالكلمات أو الموضوع..." style="font-size:.9rem">
          <button x-show="query" @click="query=''" class="shared-search__clear">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.5" stroke-linecap="round">
              <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
          </button>
          {{-- Progressive Disclosure: advanced toggle inside search box --}}
          <button class="fatwas-hero__advanced-toggle"
                  @click="showAdvanced = !showAdvanced"
                  :class="{ 'fatwas-hero__advanced-toggle--active': showAdvanced }">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="4" y1="6" x2="20" y2="6"/>
              <line x1="8" y1="12" x2="16" y2="12"/>
              <line x1="11" y1="18" x2="13" y2="18"/>
            </svg>
            <span x-text="showAdvanced ? 'إخفاء' : 'بحث متقدم'"></span>
          </button>
        </div>
      </div>

      {{-- Advanced filters — Hick's Law: hidden until needed --}}
      <div class="fatwas-hero__advanced" x-show="showAdvanced" x-transition>
        <div class="fatwas-hero__advanced-row">
          <span class="fatwas-filter__label">الشيخ:</span>
          <div class="shared-filter-tabs">
            @php $sheikhs = ['الكل','الشيخ يحيى الحجوري','الشيخ عبد العزيز','الشيخ محمد الغامدي']; @endphp
            @foreach($sheikhs as $sh)
              <button class="shared-filter-tab"
                      :class="{ 'shared-filter-tab--active': activeSheikh === '{{ $sh }}' }"
                      @click="activeSheikh = '{{ $sh }}'">{{ $sh }}</button>
            @endforeach
          </div>
        </div>
        <div class="fatwas-hero__advanced-row" style="margin-top:8px">
          <span class="fatwas-filter__label">التصنيف:</span>
          <div class="shared-filter-tabs">
            @php $cats = ['الكل','عقيدة','فقه','أخلاق','معاملات','أسرة']; @endphp
            @foreach($cats as $cat)
              <button class="shared-filter-tab"
                      :class="{ 'shared-filter-tab--active': activeCategory === '{{ $cat }}' }"
                      @click="activeCategory = '{{ $cat }}'">{{ $cat }}</button>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- ══ TRENDING STRIP — separated from list, editorial feel ══ --}}
  <div class="fatwas-trending">
    <div class="shared-inner">
      <div class="shared-section-header">
        <div>
          <p class="shared-section-header__eyebrow">هذا الأسبوع</p>
          <h2 class="shared-section-header__title">الأكثر بحثاً</h2>
        </div>
        <a href="/fatwas?sort=trending" class="shared-section-header__link">
          عرض الكل
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      <div class="fatwas-trending__row">
        @php
        $trending = [
          ['حكم قراءة القرآن من الهاتف بلا وضوء', 'يجوز على الراجح', 'fiqh'],
          ['هل تجب الزكاة على مال الأطفال؟',       'تجب في قول الجمهور', 'fiqh'],
          ['حكم الصلاة خلف الإمام الفاسق',         'صحيحة مع الكراهة', 'fiqh'],
          ['حكم الاحتفال بالمولد النبوي',           'لا يجوز لأنه بدعة', 'aqeedah'],
        ];
        @endphp
        @foreach($trending as [$q, $verdict, $sec])
          <a href="/fatwa/{{ Str::slug($q) }}" class="fatwas-trending-card">
            <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.64rem">
              {{ $sec === 'fiqh' ? 'فقه' : 'عقيدة' }}
            </span>
            <h3 class="fatwas-trending-card__q">{{ $q }}</h3>
            <p class="fatwas-trending-card__verdict">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2.5" stroke-linecap="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              {{ $verdict }}
            </p>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  {{-- ══ FILTER BAR ════════════════════════════════════════════ --}}
  <div class="shared-filter-bar">
    <div class="shared-inner shared-filter-bar__inner">
      <div class="shared-filter-tabs">
        @php $mainCats = ['الكل', 'عقيدة', 'فقه', 'أخلاق', 'معاملات', 'أسرة']; @endphp
        @foreach($mainCats as $cat)
          <button class="shared-filter-tab"
                  :class="{ 'shared-filter-tab--active': activeCategory === '{{ $cat }}' }"
                  @click="activeCategory = '{{ $cat }}'">{{ $cat }}</button>
        @endforeach
      </div>
      <span class="shared-result-count">
        عُثر على <strong x-text="resultCount">٤٢</strong> فتوى
      </span>
    </div>
  </div>

  {{-- ══ FATWAS LIST ════════════════════════════════════════════ --}}
  <div class="fatwas-list-section">
    <div class="shared-inner--mid">
      <ul class="fatwas-list">
        @php
        $fatwas = [
          [
            'q'      => 'حكم قراءة القرآن من الهاتف دون وضوء',
            'answer' => 'يجوز على الراجح من أقوال أهل العلم؛ لأن المصحف الرقمي ليس مصحفاً في الحكم الشرعي.',
            'sec'    => 'fiqh',
            'sheikh' => 'الشيخ يحيى',
            'ago'    => 'منذ يومين',
          ],
          [
            'q'      => 'هل تجب الزكاة على مال الأطفال الذين لم يبلغوا؟',
            'answer' => 'تجب الزكاة في مال الأطفال إذا بلغ النصاب وحال عليه الحول وهو قول الجمهور.',
            'sec'    => 'fiqh',
            'sheikh' => 'الشيخ عبد العزيز',
            'ago'    => 'منذ أسبوع',
          ],
          [
            'q'      => 'حكم الصلاة خلف الإمام الفاسق',
            'answer' => 'الصلاة خلفه صحيحة وإن كان ذلك مكروهاً على قول جمهور الفقهاء رحمهم الله.',
            'sec'    => 'fiqh',
            'sheikh' => 'الشيخ محمد',
            'ago'    => 'منذ أسبوع',
          ],
          [
            'q'      => 'ما حكم الاحتفال بالمولد النبوي الشريف؟',
            'answer' => 'لا يجوز لأنه بدعة محدثة لم تكن على عهد النبي ﷺ ولا صحابته الكرام رضوان الله عليهم.',
            'sec'    => 'aqeedah',
            'sheikh' => 'الشيخ يحيى',
            'ago'    => 'منذ شهر',
          ],
          [
            'q'      => 'حكم رفع اليدين في الدعاء بعد الصلاة المكتوبة',
            'answer' => 'لا يثبت فيه حديث صحيح مرفوع، والراجح أنه غير مشروع وهو فعل مبتدع.',
            'sec'    => 'fiqh',
            'sheikh' => 'الشيخ عبد العزيز',
            'ago'    => 'منذ شهر',
          ],
          [
            'q'      => 'حكم التأمين الصحي التجاري',
            'answer' => 'لا يجوز لما فيه من الغرر والجهالة والربا في بعض صوره عند التحقيق.',
            'sec'    => 'fiqh',
            'sheikh' => 'الشيخ يحيى',
            'ago'    => 'منذ شهرين',
          ],
        ];
        @endphp

        @foreach($fatwas as $fatwa)
          <li class="fatwas-item">
            <a href="/fatwa/{{ Str::slug($fatwa['q']) }}" class="fatwas-item__link">
              <div class="fatwas-item__meta-top">
                <span class="shared-tag shared-tag--{{ $fatwa['sec'] }}" style="font-size:.66rem">
                  {{ $fatwa['sec'] === 'fiqh' ? 'فقه' : 'عقيدة' }}
                </span>
                <span class="fatwas-item__ago">{{ $fatwa['ago'] }}</span>
              </div>
              <h3 class="fatwas-item__question">{{ $fatwa['q'] }}</h3>
              <p class="fatwas-item__verdict">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ Str::limit($fatwa['answer'], 85) }}
              </p>
              <div class="fatwas-item__footer">
                <div class="shared-sheikh" style="gap:6px">
                  <div class="shared-sheikh__avatar"
                       style="width:24px;height:24px;font-size:.65rem;border-radius:50%">
                    {{ mb_substr($fatwa['sheikh'], 7, 1, 'UTF-8') }}
                  </div>
                  <span style="font-size:.76rem;color:var(--text-muted-day)">{{ $fatwa['sheikh'] }}</span>
                </div>
                <svg class="fatwas-item__arrow" width="14" height="14" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                  <path d="M15 18l-6-6 6-6"/>
                </svg>
              </div>
            </a>
          </li>
        @endforeach
      </ul>

      {{-- Empty state — active, not passive --}}
      <div x-show="query && resultCount === 0" class="shared-empty">
        <div class="shared-empty__icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
          </svg>
        </div>
        <h3 class="shared-empty__title">لم نجد فتاوى مطابقة</h3>
        <p class="shared-empty__desc">جرّب كلمات مختلفة، أو اسأل سؤالاً جديداً وسيُجاب عليه</p>
        <a href="/ask-fatwa" class="shared-btn-primary" style="margin-top:.75rem">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
          اسأل سؤالاً
        </a>
      </div>

    </div>
  </div>

</div>

<script>
function fatwasPage() {
  return {
    query: '',
    showAdvanced: false,
    activeSheikh: 'الكل',
    activeCategory: 'الكل',
    resultCount: 42,
  }
}
</script>
@endsection