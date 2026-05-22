@extends('layouts.app')
@section('content')

{{-- lesson.blade.php | prefix: lesson- --}}
@php
$lesson = [
  'num'        => 7,
  'title'      => 'الأصل الثاني: أركان الإيمان الستة',
  'duration'   => '٤٦ د',
  'book'       => 'الأصول الثلاثة',
  'section'    => 'aqeedah',
  'sheikh'     => 'الشيخ يحيى بن علي الحجوري',
  'total'      => 47,
  'prev_num'   => 6,
  'prev_title' => 'أركان الإسلام الخمسة بالأدلة',
  'next_num'   => 8,
  'next_title' => 'الأصل الثالث: معرفة النبي ﷺ',
];
$progress = round(($lesson['num'] / $lesson['total']) * 100);
$related = [
  ['الأصل الثالث: معرفة النبي','من نفس الكتاب — الدرس التالي','٥٥ د','aqeedah'],
  ['أركان الإيمان — ابن عثيمين','الأكثر استماعاً في هذا الباب','٤٨ د','aqeedah'],
  ['شرح كتاب التوحيد — ٣',       'تكملة لموضوع التوحيد',        '٥٢ د','aqeedah'],
];
@endphp

<div class="shared-page"
     x-data="lessonPage()"
     :class="{ 'lesson-focus-mode': focusMode }"
     @keydown.escape.window="focusMode = false">

  {{-- Breadcrumb --}}
  <nav class="shared-breadcrumb lesson-breadcrumb-hide-focus">
    <div class="shared-inner--narrow">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/curricula?section={{ $lesson['section'] }}" class="shared-breadcrumb__link">العقيدة</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/lessons?curriculum={{ Str::slug($lesson['book']) }}" class="shared-breadcrumb__link">{{ $lesson['book'] }}</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><span class="shared-breadcrumb__current">الدرس {{ $lesson['num'] }}</span></li>
      </ol>
    </div>
  </nav>

  <div class="shared-inner--narrow">

    {{-- ══ LESSON HEADER ════════════════════════════════════════ --}}
    <header class="lesson-header">

      {{-- Path indicator (Shneiderman #7) --}}
      <div class="lesson-header__path">
        <span class="lesson-header__path-book">{{ $lesson['book'] }}</span>
        <span class="lesson-header__path-sep">·</span>
        <span class="lesson-header__path-pos">الدرس {{ $lesson['num'] }} من {{ $lesson['total'] }}</span>
      </div>

      <h1 class="lesson-header__title">{{ $lesson['title'] }}</h1>

      {{-- Inline progress bar --}}
      <div class="lesson-header__progress-track">
        <div class="lesson-header__progress-fill" style="width:{{ $progress }}%"></div>
      </div>
      <p class="lesson-header__progress-label">{{ $progress }}% من المسار مكتمل</p>

      <div class="lesson-header__meta">
        <div class="shared-sheikh">
          <div class="shared-sheikh__avatar" style="width:26px;height:26px;font-size:.7rem">ي</div>
          <span class="shared-sheikh__name" style="font-size:.8rem">{{ $lesson['sheikh'] }}</span>
        </div>
        <span class="lesson-header__meta-sep"></span>
        <span class="lesson-header__meta-item">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          {{ $lesson['duration'] }}
        </span>
        <span class="shared-tag shared-tag--{{ $lesson['section'] }}" style="font-size:.66rem">عقيدة</span>
      </div>
    </header>

    {{-- ══ TOOLBAR ══════════════════════════════════════════════ --}}
    <div class="lesson-toolbar">

      {{-- Mode toggle --}}
      <div class="lesson-mode-toggle" role="tablist">
        <button class="lesson-mode-btn" :class="{ 'lesson-mode-btn--active': mode==='listen' }"
                @click="mode='listen'" role="tab">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
          استماع
        </button>
        <button class="lesson-mode-btn" :class="{ 'lesson-mode-btn--active': mode==='read' }"
                @click="mode='read'" role="tab">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          قراءة
        </button>
      </div>

      {{-- Tools --}}
      <div class="lesson-tools">
        {{-- Font size — always visible (most used) --}}
        <button class="lesson-tool-btn lesson-tool-btn--font" @click="cycleFontSize()" :title="'حجم الخط'">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 7 4 4 20 4 20 7"/><line x1="9" y1="20" x2="15" y2="20"/><line x1="12" y1="4" x2="12" y2="20"/></svg>
          <span x-text="fontLabels[fontSize]"></span>
        </button>

        {{-- Settings popup (Progressive Disclosure + Hick's Law) --}}
        <div style="position:relative" x-data="{ open: false }" @click.away="open=false">
          <button class="lesson-tool-btn" @click="open=!open" :class="{ 'lesson-tool-btn--active': open }" title="إعدادات">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 19.07a10 10 0 0 1 0-14.14"/></svg>
          </button>
          <div class="lesson-settings-popup" x-show="open" x-transition>
            <p class="lesson-settings-popup__title">إعدادات العرض</p>
            <label class="lesson-settings-popup__row">
              <span>وضع التركيز</span>
              <button class="lesson-settings-popup__toggle-btn" @click="focusMode=!focusMode;open=false"
                      :class="{ 'lesson-settings-popup__toggle-btn--on': focusMode }">
                <span x-text="focusMode ? 'مفعّل' : 'معطّل'"></span>
              </button>
            </label>
            <label class="lesson-settings-popup__row">
              <span>خلفية قراءة داكنة</span>
              <button class="lesson-settings-popup__toggle-btn" @click="darkRead=!darkRead"
                      :class="{ 'lesson-settings-popup__toggle-btn--on': darkRead }">
                <span x-text="darkRead ? 'مفعّل' : 'معطّل'"></span>
              </button>
            </label>
          </div>
        </div>
      </div>
    </div>

    {{-- ══ LISTEN MODE ══════════════════════════════════════════ --}}
    <div x-show="mode === 'listen'">

      {{-- ── AUDIO PLAYER (exceptional design) ─────────────── --}}
      <div class="player-wrap" :class="{ 'player--playing': playing }">
        <div class="player" :class="{ 'player--playing': playing }">

          {{-- Gold accent top line built into CSS --}}

          {{-- Header: info + download --}}
          <div class="player__header">
            <div class="player__icon-wrap">
              <div class="player__icon-pulse"></div>
              {{-- Waveform visualizer --}}
              <div class="player__vis">
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
                <span class="player__vis-bar"></span>
              </div>
            </div>
            <div class="player__info">
              <p class="player__title">{{ $lesson['title'] }}</p>
              <div class="player__subtitle">
                <span>{{ $lesson['sheikh'] }}</span>
                <span class="player__subtitle-sep"></span>
                <span>{{ $lesson['book'] }}</span>
                <span class="player__subtitle-sep"></span>
                <span>{{ $lesson['duration'] }}</span>
              </div>
            </div>
            <a href="/lesson/{{ $lesson['num'] }}/download" class="player__download">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              تحميل MP3
            </a>
          </div>

          {{-- Progress track --}}
          <div class="player__progress-section">
            <div class="player__time-row">
              <span class="player__time player__time--current" x-text="formatTime(currentTime)"></span>
              <span class="player__time">{{ $lesson['duration'] }}</span>
            </div>
            <div class="player__track"
                 @click="seekTo($event)"
                 x-ref="track">
              <div class="player__fill" :style="`width:${(currentTime/totalTime)*100}%`"></div>
            </div>
          </div>

          {{-- Controls --}}
          <div class="player__controls">

            {{-- Volume (left side) --}}
            <div class="player__volume-wrap">
              <button class="player__volume-btn" @click="muted=!muted" :title="muted?'رفع الصوت':'كتم الصوت'">
                <svg x-show="!muted" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/></svg>
                <svg x-show="muted" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><line x1="23" y1="9" x2="17" y2="15"/><line x1="17" y1="9" x2="23" y2="15"/></svg>
              </button>
              <input class="player__volume-slider" type="range" min="0" max="100" x-model="volume">
            </div>

            {{-- Skip back 15s --}}
            <button class="player__skip" @click="skip(-15)" title="تأخير ١٥ ث">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 5V2L8 6l4 4V7a7 7 0 1 1-7 7H3a9 9 0 1 0 9-9z"/></svg>
              <span class="player__skip-label">١٥</span>
            </button>

            {{-- Prev chapter --}}
            <button class="player__chapter-btn" @click="window.location='/lesson/{{ $lesson['prev_num'] }}'" title="الدرس السابق">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="19 20 9 12 19 4 19 20"/><line x1="5" y1="19" x2="5" y2="5" stroke="currentColor" stroke-width="2"/></svg>
            </button>

            {{-- PLAY BUTTON --}}
            <button class="player__play" @click="togglePlay()" :title="playing ? 'إيقاف' : 'تشغيل'">
              <svg x-show="!playing" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              <svg x-show="playing" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
            </button>

            {{-- Next chapter --}}
            <button class="player__chapter-btn" @click="window.location='/lesson/{{ $lesson['next_num'] }}'" title="الدرس التالي">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 4 15 12 5 20 5 4"/><line x1="19" y1="5" x2="19" y2="19" stroke="currentColor" stroke-width="2"/></svg>
            </button>

            {{-- Skip fwd 15s --}}
            <button class="player__skip" @click="skip(15)" title="تقديم ١٥ ث">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 5V2l4 4-4 4V7a7 7 0 1 0 7 7h2a9 9 0 1 1-9-9z"/></svg>
              <span class="player__skip-label">١٥</span>
            </button>

            {{-- Speed (right side) --}}
            <div class="player__speed">
              @foreach(['0.75','1','1.25','1.5','2'] as $sp)
                <button class="player__speed-btn" :class="{ 'player__speed-btn--active': speed=='{{ $sp }}' }"
                        @click="speed='{{ $sp }}'">{{ $sp }}x</button>
              @endforeach
            </div>

          </div>
        </div>
      </div>

      {{-- Companion text (faint in listen mode) --}}
      <div class="lesson-companion" :class="'lesson-text--' + fontSize">
        <p class="lesson-companion__label">النص المرافق</p>
        <div class="lesson-companion__body">
          <p>أركان الإيمان الستة: الإيمان بالله وملائكته وكتبه ورسله واليوم الآخر والقدر خيره وشره.</p>
          <p>قال الله تعالى: ﴿آمَنَ الرَّسُولُ بِمَا أُنزِلَ إِلَيْهِ مِن رَّبِّهِ وَالْمُؤْمِنُونَ كُلٌّ آمَنَ بِاللَّهِ وَمَلَائِكَتِهِ وَكُتُبِهِ وَرُسُلِهِ﴾</p>
          <p>وقال ﷺ: «الإيمان أن تؤمن بالله وملائكته وكتبه ورسله واليوم الآخر وتؤمن بالقدر خيره وشره»</p>
        </div>
      </div>
    </div>

    {{-- ══ READ MODE ════════════════════════════════════════════ --}}
    <div x-show="mode === 'read'"
         class="lesson-read-area"
         :class="[darkRead ? 'lesson-read-area--dark' : '', 'lesson-text--' + fontSize]">

      <div class="lesson-read-content">

        {{-- Hadith / main text in styled block --}}
        <p class="lesson-read-content__main-text">
          قال الله تعالى: ﴿آمَنَ الرَّسُولُ بِمَا أُنزِلَ إِلَيْهِ مِن رَّبِّهِ وَالْمُؤْمِنُونَ كُلٌّ آمَنَ بِاللَّهِ وَمَلَائِكَتِهِ وَكُتُبِهِ وَرُسُلِهِ﴾
          <span class="lesson-read-content__source">[البقرة: ٢٨٥]</span>
        </p>

        <h2 class="lesson-read-content__h2">الركن الأول: الإيمان بالله</h2>
        <p>الإيمان بالله هو أصل الأصول، ويشمل الإيمان بوجوده وربوبيته وألوهيته وأسمائه وصفاته. وهذا الإيمان هو الذي يُحقق معنى لا إله إلا الله في قلب العبد وحياته.</p>

        <h2 class="lesson-read-content__h2">الركن الثاني: الإيمان بالملائكة</h2>
        <p>الإيمان بالملائكة إيمان إجمالي بوجودهم وأنهم عباد مكرمون، وتفصيلي بمن ورد ذكره منهم كجبريل وميكائيل وإسرافيل وعزرائيل.</p>

        {{-- Smart link example --}}
        <h2 class="lesson-read-content__h2">الركن الثالث: الإيمان بالكتب</h2>
        <p>
          الإيمان بأن الله أنزل كتبًا على أنبيائه، منها:
          <span class="shared-smart-link" x-data="{ show: false }" @mouseenter="show=true" @mouseleave="show=false">
            القرآن الكريم
            <span class="shared-smart-link__tooltip" x-show="show" x-transition>
              <span class="shared-smart-link__tooltip-title">القرآن الكريم</span>
              <span>كلام الله المنزّل على النبي ﷺ المتعبَّد بتلاوته</span>
              <a href="/search?q=القرآن" class="shared-smart-link__more">اقرأ أكثر ←</a>
            </span>
          </span>
          المنزَّل على محمد ﷺ، وإنجيل عيسى، وتوراة موسى، وزبور داود — عليهم الصلاة والسلام.
        </p>

        <h2 class="lesson-read-content__h2">الأركان الرابع والخامس: الرسل واليوم الآخر</h2>
        <p>الإيمان بأن الله أرسل رسلًا للهداية، أولهم نوح وآخرهم محمد ﷺ خاتم النبيين. والإيمان باليوم الآخر يشمل الموت والبعث والحساب والجنة والنار.</p>

        <h2 class="lesson-read-content__h2">الركن السادس: الإيمان بالقدر</h2>
        <ul class="lesson-read-content__list">
          <li>الإيمان بعلم الله الأزلي بكل شيء</li>
          <li>الإيمان بأن الله كتب مقادير الخلائق</li>
          <li>الإيمان بأن كل ما في الكون بمشيئة الله وإرادته</li>
          <li>الإيمان بأن الله خالق كل شيء</li>
        </ul>

      </div>

      {{-- Floating mini player in read mode --}}
      <div class="player-mini" :class="{ 'player-mini--playing': playing }">
        <button class="player-mini__play" @click="togglePlay()">
          <svg x-show="!playing" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          <svg x-show="playing" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
        </button>
        <div class="player-mini__info">
          <span class="player-mini__title">{{ $lesson['title'] }}</span>
          <div class="player-mini__progress-row">
            <div class="player-mini__track" @click="seekTo($event)" x-ref="miniTrack">
              <div class="player-mini__fill" :style="`width:${(currentTime/totalTime)*100}%`"></div>
            </div>
            <span class="player-mini__time" x-text="formatTime(currentTime)"></span>
          </div>
        </div>
        <div class="player-mini__vis">
          <span class="player-mini__vis-bar"></span>
          <span class="player-mini__vis-bar"></span>
          <span class="player-mini__vis-bar"></span>
          <span class="player-mini__vis-bar"></span>
          <span class="player-mini__vis-bar"></span>
        </div>
      </div>
    </div>

    {{-- ══ PERSONAL NOTES (Shneiderman #5) ════════════════════ --}}
    <div class="shared-notes" style="margin-bottom:2rem">
      <div class="shared-notes__header">
        <h3 class="shared-notes__title">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
          ملاحظاتي
        </h3>
        <div style="display:flex;align-items:center;gap:8px">
          <span x-show="noteSaved" class="shared-notes__saved" x-transition>
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            تم الحفظ
          </span>
          <button class="shared-btn-ghost" @click="exportNotes()" :disabled="!noteText.trim()" style="font-size:.75rem;padding:5px 10px">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            تصدير
          </button>
        </div>
      </div>
      <textarea class="shared-notes__textarea" x-model="noteText"
                placeholder="سجّل ما استفدته من هذا الدرس..." rows="4"></textarea>
      <div class="shared-notes__footer">
        <p class="shared-notes__privacy">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          ملاحظاتك محفوظة على هذا الجهاز فقط
        </p>
        <button class="shared-btn-primary" @click="saveNote()" style="font-size:.8rem;padding:7px 16px">حفظ</button>
      </div>
    </div>

    {{-- ══ PREV / NEXT NAVIGATION (Zeigarnik Effect) ══════════ --}}
    <nav class="shared-prev-next" style="margin-bottom:3rem" aria-label="التنقل بين الدروس">
      <a href="/lesson/{{ $lesson['prev_num'] }}" class="shared-nav-btn shared-nav-btn--prev">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 18l6-6-6-6"/></svg>
        <div class="shared-nav-btn__text">
          <span class="shared-nav-btn__label">السابق</span>
          <span class="shared-nav-btn__title">{{ $lesson['prev_title'] }}</span>
        </div>
      </a>

      <a href="/lessons?curriculum={{ Str::slug($lesson['book']) }}" class="shared-nav-btn--index">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
        القائمة
      </a>

      <a href="/lesson/{{ $lesson['next_num'] }}" class="shared-nav-btn shared-nav-btn--next">
        <div class="shared-nav-btn__text">
          <span class="shared-nav-btn__label">التالي</span>
          <span class="shared-nav-btn__title">{{ $lesson['next_title'] }}</span>
        </div>
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M15 18l-6-6 6-6"/></svg>
      </a>
    </nav>

    {{-- ══ RELATED LESSONS (Framing Effect) ═══════════════════ --}}
    <section class="shared-related lesson-breadcrumb-hide-focus">
      <h3 class="shared-related__title">دروس ذات صلة</h3>
      <div class="lesson-related-grid">
        @foreach($related as [$title,$reason,$dur,$sec])
          <a href="/lesson/{{ Str::slug($title) }}" class="shared-related-card">
            <span class="shared-related-card__reason">{{ $reason }}</span>
            <h4 class="shared-related-card__title">{{ $title }}</h4>
            <div class="shared-related-card__meta">
              <span class="shared-tag shared-tag--{{ $sec }}" style="font-size:.62rem;padding:1px 6px">عقيدة</span>
              <span>{{ $dur }}</span>
            </div>
          </a>
        @endforeach
      </div>
    </section>

  </div>
</div>

<script>
function lessonPage() {
  return {
    mode: 'listen',
    playing: false,
    currentTime: 0,
    totalTime: 2460,
    volume: 80,
    muted: false,
    speed: '1',
    fontSize: 1,
    fontSizes: ['sm','md','lg','xl'],
    fontLabels: {0:'ص',1:'م',2:'ك',3:'ع'},
    focusMode: false,
    darkRead: false,
    noteText: '',
    noteSaved: false,
    _interval: null,

    get fontSize() { return this.fontSizes[this._fsIdx ?? 1]; },

    init() {
      this._fsIdx = 1;
      const saved = localStorage.getItem('lesson-note-{{ $lesson['num'] }}');
      if (saved) this.noteText = saved;
    },

    cycleFontSize() {
      this._fsIdx = ((this._fsIdx ?? 1) + 1) % this.fontSizes.length;
      this.fontSize = this.fontSizes[this._fsIdx];
    },

    togglePlay() {
      this.playing = !this.playing;
      if (this.playing) {
        this._interval = setInterval(() => {
          if (this.currentTime < this.totalTime) this.currentTime++;
          else { this.playing = false; clearInterval(this._interval); }
        }, 1000);
      } else {
        clearInterval(this._interval);
      }
    },

    skip(seconds) {
      this.currentTime = Math.max(0, Math.min(this.totalTime, this.currentTime + seconds));
    },

    seekTo(e) {
      const track = e.currentTarget;
      const rect = track.getBoundingClientRect();
      const ratio = (e.clientX - rect.left) / rect.width;
      this.currentTime = Math.round(ratio * this.totalTime);
    },

    formatTime(s) {
      const m = Math.floor(s / 60);
      const sec = s % 60;
      return `${String(m).padStart(2,'0')}:${String(sec).padStart(2,'0')}`;
    },

    saveNote() {
      localStorage.setItem('lesson-note-{{ $lesson['num'] }}', this.noteText);
      this.noteSaved = true;
      setTimeout(() => this.noteSaved = false, 2500);
    },

    exportNotes() {
      const blob = new Blob([this.noteText], { type: 'text/plain;charset=utf-8' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'ملاحظات-الدرس-{{ $lesson['num'] }}.txt';
      a.click();
      URL.revokeObjectURL(url);
    }
  }
}
</script>
@endsection
