@extends('layouts.app')
@section('content')

{{-- lessons.blade.php | prefix: lessons- --}}
@php
$curr = ['title'=>'الأصول الثلاثة','sheikh'=>'الشيخ يحيى الحجوري','section'=>'aqeedah','total'=>47,'completed'=>7];
$progress = round(($curr['completed'] / $curr['total']) * 100);
$lessons = [
  ['num'=>1, 'title'=>'مقدمة المقرر — التعريف بالكتاب والمؤلف',      'dur'=>'٣٥ د','status'=>'done',   'desc'=>'التعريف بكتاب الأصول الثلاثة وأهميته ومكانته في العلم الشرعي'],
  ['num'=>2, 'title'=>'باب الفضل في معرفة الأصول الثلاثة',           'dur'=>'٤٨ د','status'=>'done',   'desc'=>'بيان وجوب معرفة هذه الأصول على كل مسلم ومسلمة'],
  ['num'=>3, 'title'=>'الأصل الأول: معرفة الرب — الدليل والمعنى',    'dur'=>'٥٢ د','status'=>'done',   'desc'=>'شرح قوله: ربنا الله الذي خلقنا ورزقنا ولم يتركنا هملاً'],
  ['num'=>4, 'title'=>'الأصل الأول (تابع): أسماء الله وصفاته',       'dur'=>'٤٤ د','status'=>'done',   'desc'=>'شرح صفات الرب سبحانه وأسمائه الحسنى من الكتاب والسنة'],
  ['num'=>5, 'title'=>'الأصل الثاني: معرفة الدين — الإسلام والإيمان','dur'=>'٤١ د','status'=>'done',   'desc'=>'شرح معنى الإسلام بمراتبه الثلاث: الإسلام والإيمان والإحسان'],
  ['num'=>6, 'title'=>'الأصل الثاني (تابع): أركان الإسلام',          'dur'=>'٣٩ د','status'=>'done',   'desc'=>'شرح أركان الإسلام الخمسة بالأدلة من الكتاب والسنة'],
  ['num'=>7, 'title'=>'الأصل الثاني: أركان الإيمان الستة',            'dur'=>'٤٦ د','status'=>'current','desc'=>'بيان أركان الإيمان من الكتاب والسنة والإجماع'],
  ['num'=>8, 'title'=>'الأصل الثالث: معرفة النبي ﷺ',                 'dur'=>'٥٥ د','status'=>'next',   'desc'=>'التعريف بنسب النبي ﷺ ومولده وبعثته ووفاته'],
  ['num'=>9, 'title'=>'الأصل الثالث (تابع): دلائل النبوة',           'dur'=>'٤٨ د','status'=>'locked', 'desc'=>'شرح الأدلة على صدق النبي ﷺ وصحة رسالته'],
  ['num'=>10,'title'=>'باب ما جاء في البسملة وفضلها',                'dur'=>'٣٦ د','status'=>'locked', 'desc'=>'شرح أحاديث البسملة وما ورد في فضلها'],
  ['num'=>11,'title'=>'باب التعوذ وأحكامه',                           'dur'=>'٣٤ د','status'=>'locked', 'desc'=>'أحكام الاستعاذة ومتى تكون واجبة أو مستحبة'],
  ['num'=>12,'title'=>'تلخيص الأصول الثلاثة ومراجعتها',              'dur'=>'٢٨ د','status'=>'locked', 'desc'=>'مراجعة شاملة لمسائل الأصول الثلاثة'],
];
@endphp

<div class="shared-page" x-data="lessonsPage()">

  {{-- Breadcrumb --}}
  <nav class="shared-breadcrumb">
    <div class="shared-inner">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/curricula?section={{ $curr['section'] }}" class="shared-breadcrumb__link">العقيدة</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/curriculum/{{ Str::slug($curr['title']) }}" class="shared-breadcrumb__link">{{ $curr['title'] }}</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><span class="shared-breadcrumb__current">الدروس</span></li>
      </ol>
    </div>
  </nav>

  {{-- ══ COMPRESSED HEADER STRIP ════════════════════════════════ --}}
  <div class="lessons-header-strip">
    <div class="shared-inner lessons-header-strip__inner">
      <div class="lessons-header-strip__info">
        <h1 class="lessons-header-strip__title">{{ $curr['title'] }}</h1>
        <div class="shared-sheikh" style="margin-top:4px">
          <div class="shared-sheikh__avatar" style="width:24px;height:24px;font-size:.7rem">ي</div>
          <span class="shared-sheikh__name" style="font-size:.78rem">{{ $curr['sheikh'] }}</span>
        </div>
      </div>

      <div class="lessons-header-strip__progress-block">
        <div class="lessons-header-strip__progress-meta">
          <span class="lessons-header-strip__completed">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            أتممتَ {{ $curr['completed'] }} من {{ $curr['total'] }} درساً
          </span>
          <span class="lessons-header-strip__percent">{{ $progress }}%</span>
        </div>
        <div class="shared-progress__track" style="margin-top:6px">
          <div class="shared-progress__fill" style="width:{{ $progress }}%"></div>
        </div>
      </div>

      <div class="lessons-header-strip__actions">
        <a href="/lesson/{{ $curr['completed'] + 1 }}" class="shared-btn-primary" style="font-size:.82rem;padding:8px 16px">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          متابعة الدرس {{ $curr['completed'] + 1 }}
        </a>
        <a href="/curriculum/{{ Str::slug($curr['title']) }}/download" class="shared-download-btn" style="font-size:.78rem;padding:7px 12px">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          الكتاب PDF
        </a>
      </div>
    </div>
  </div>

  {{-- ══ SEARCH + FILTER BAR ════════════════════════════════════ --}}
  <div class="shared-filter-bar">
    <div class="shared-inner shared-filter-bar__inner">

      {{-- Unified search --}}
      <div class="shared-search" style="flex:1;max-width:320px" x-data="{ focused: false }">
        <svg class="shared-search__icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input class="shared-search__input" type="text" x-model="searchQuery" placeholder="ابحث في عناوين الدروس..." @input="filterLessons()">
        <button x-show="searchQuery" @click="searchQuery='';filterLessons()" class="shared-search__clear">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>

      {{-- Part buttons (quick filter — أزرار أفقية سريعة) --}}
      <div class="shared-filter-tabs">
        @foreach(['الكل','الجزء الأول','الجزء الثاني','الجزء الثالث'] as $i => $label)
          <button class="shared-filter-tab {{ $i===0?'shared-filter-tab--active':'' }}"
                  @click="activePart='{{ $label }}'; filterLessons()">{{ $label }}</button>
        @endforeach
      </div>

      {{-- Quick jump --}}
      <div class="lessons-quick-jump">
        <label class="lessons-quick-jump__label">اذهب إلى:</label>
        <div class="lessons-quick-jump__wrap">
          <input class="lessons-quick-jump__input" type="number" min="1" max="{{ $curr['total'] }}"
                 x-model="jumpTo" placeholder="{{ $curr['total'] }}"
                 @keydown.enter="jumpToLesson()">
          <button class="lessons-quick-jump__btn" @click="jumpToLesson()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
        </div>
      </div>

      {{-- Location indicator --}}
      <span class="shared-result-count">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        الدرس الحالي: <strong>{{ $curr['completed'] }}</strong> من {{ $curr['total'] }}
      </span>

    </div>
  </div>

  {{-- ══ LESSONS LIST ════════════════════════════════════════════ --}}
  <section class="lessons-list-section">
    <div class="shared-inner--mid">

      {{-- Global progress strip --}}
      <div class="lessons-list__progress-strip">
        <div class="lessons-list__progress-fill" style="width:{{ $progress }}%"></div>
      </div>

      <ul class="lessons-list" role="list">
        @foreach($lessons as $lesson)
          <li class="lessons-item lessons-item--{{ $lesson['status'] }}" id="lesson-{{ $lesson['num'] }}">
            <a href="/lesson/{{ $lesson['num'] }}" class="lessons-item__link">

              {{-- Von Restorff: colored status bar --}}
              <div class="lessons-item__status-bar"></div>

              {{-- Number / Status icon --}}
              <div class="lessons-item__num-wrap">
                @if($lesson['status'] === 'done')
                  <div class="lessons-item__check">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                  </div>
                @elseif($lesson['status'] === 'current')
                  <div class="lessons-item__play">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                  </div>
                @else
                  <span class="lessons-item__num">{{ $lesson['num'] }}</span>
                @endif
              </div>

              {{-- Content: title dominant --}}
              <div class="lessons-item__content">
                <h3 class="lessons-item__title">{{ $lesson['title'] }}</h3>
                <p class="lessons-item__desc">{{ $lesson['desc'] }}</p>
              </div>

              {{-- Meta: secondary, surfaces on hover --}}
              <div class="lessons-item__meta">
                <span class="lessons-item__duration">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  {{ $lesson['dur'] }}
                </span>
                @if($lesson['status'] === 'current')
                  <span class="lessons-item__badge lessons-item__badge--current">متابعة</span>
                @elseif($lesson['status'] === 'done')
                  <span class="lessons-item__badge lessons-item__badge--done">مكتمل</span>
                @elseif($lesson['status'] === 'next')
                  <span class="lessons-item__badge lessons-item__badge--next">التالي</span>
                @endif
                <svg class="lessons-item__arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M15 18l-6-6 6-6"/></svg>
              </div>

            </a>
          </li>
        @endforeach
      </ul>

    </div>
  </section>

</div>

<script>
function lessonsPage() {
  return {
    searchQuery: '',
    activePart: 'الكل',
    jumpTo: '',
    filterLessons() { /* backend filtering in real app */ },
    jumpToLesson() {
      const n = parseInt(this.jumpTo);
      if (n > 0) {
        const el = document.getElementById('lesson-' + n);
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }
  }
}
</script>
@endsection
