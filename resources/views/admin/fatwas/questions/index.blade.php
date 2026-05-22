{{-- resources/views/admin/fatwas/questions/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'أسئلة الفتاوى الجديدة')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">أسئلة جديدة</span>
@endsection

@section('content')
<div x-data="fatwasQuestionsPage()" x-cloak>

  {{-- ══ Page header ══════════════════════════════════════════════ --}}
  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">أسئلة الفتاوى الجديدة</h1>
      <p class="dash-page-header__sub">الأسئلة الواردة من الزوار — مرتبة بالأحدث. المراجعة السريعة تُقلل وقت انتظار الزوار.</p>
    </div>
  </div>

  {{-- ══ Alert ════════════════════════════════════════════════════ --}}
  <div class="dash-alert dash-alert--warning" style="margin-bottom:1.25rem">
    <div class="dash-alert__icon">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
      </svg>
    </div>
    <div class="dash-alert__body">
      <p class="dash-alert__title">7 أسئلة جديدة تنتظر المراجعة</p>
      <p class="dash-alert__desc">آخر سؤال وصل منذ ١٢ دقيقة — توجيه السؤال لشيخ يُسرّع المعالجة.</p>
    </div>
  </div>

  {{-- ══ Filter chips ═════════════════════════════════════════════ --}}
  <div class="dash-filter-chips" style="margin-bottom:1rem">
    @foreach(['الكل','الجديدة','قيد المراجعة','مُجابة','مرفوضة'] as $chip)
      <button class="dash-filter-chip"
              :class="activeChip === '{{ $chip }}' ? 'dash-filter-chip--active' : ''"
              @click="activeChip = '{{ $chip }}'">
        {{ $chip }}
        @if($chip === 'الجديدة')
          <span class="dash-tab__count" style="margin-right:4px">7</span>
        @endif
      </button>
    @endforeach
  </div>

  {{-- ══ Table ════════════════════════════════════════════════════ --}}
  <div class="dash-table-wrap">

    {{-- Toolbar --}}
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             style="color:var(--text-muted-day);flex-shrink:0">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery"
               placeholder="ابحث بعنوان السؤال أو اسم المرسل...">
      </div>
      <span class="dash-table-count" style="margin-right:auto">
        إجمالي: <strong>٧</strong> سؤال جديد
      </span>
    </div>

    {{-- ── Desktop table ────────────────────────────────────────── --}}
    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr>
            <th style="width:35%">السؤال</th>
            <th>المرسل</th>
            <th>التاريخ</th>
            <th>توجيه لشيخ</th>
            <th>النشر</th>
            <th>الحالة</th>
            <th style="width:130px"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $questions = [
            [1,'حكم قراءة القرآن من الهاتف المحمول دون وضوء','مجهول','منذ ١٢ دقيقة','new'],
            [2,'هل يجوز الصلاة خلف إمام لا يُتقن الفاتحة','أحمد محمد','منذ ٤٥ دقيقة','new'],
            [3,'حكم العقود الآجلة في الذهب والفضة','مجهول','منذ ساعتين','reviewing'],
            [4,'ما حكم الاستثمار في صناديق الاستثمار الإسلامية','خالد العمري','منذ ٣ ساعات','new'],
            [5,'هل تجب زكاة المال على الديون المؤجلة','مجهول','أمس ١١:٢٢','new'],
            [6,'حكم الصلاة في المسجد الذي فيه قبر','عبد الله السالم','أمس ٩:٠٥','new'],
            [7,'ما صحة حديث طلب العلم فريضة على كل مسلم','مجهول','منذ يومين','reviewing'],
          ];
          @endphp

          @foreach($questions as [$id,$question,$sender,$date,$status])
          <tr x-bind:data-row-id="'row-' + ($id ?? $loop?.index ?? Math.random())" data-row-id="">
            {{-- السؤال --}}
            <td>
              <p style="font-size:.87rem;font-weight:500;color:var(--text-day);line-height:1.45;
                         display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;
                         -webkit-box-orient:vertical;overflow:hidden">
                {{ $question }}
              </p>
            </td>

            {{-- المرسل --}}
            <td>
              <div style="display:flex;align-items:center;gap:7px">
                <div style="width:28px;height:28px;border-radius:7px;background:rgba(4,95,114,0.08);
                             color:var(--primary);display:flex;align-items:center;justify-content:center;
                             font-size:.72rem;font-weight:700;flex-shrink:0">
                  {{ $sender === 'مجهول' ? '؟' : mb_substr($sender,0,1,'UTF-8') }}
                </div>
                <span style="font-size:.8rem;color:{{ $sender==='مجهول' ? 'var(--text-muted-day)' : 'var(--text-day)' }}">
                  {{ $sender }}
                </span>
              </div>
            </td>

            {{-- التاريخ --}}
            <td style="font-size:.78rem;color:var(--text-muted-day);white-space:nowrap">{{ $date }}</td>

            {{-- توجيه لشيخ — Custom Searchable Dropdown --}}
            <td>
              <div class="dash-custom-select dash-sheikh-select"
                   x-data="sheikhSelectData({{ $id }})"
                   @click.away="open = false">

                <button type="button"
                        class="dash-custom-select__trigger"
                        style="min-width:160px"
                        @click="open = !open"
                        :class="selected ? 'dash-custom-select--assigned' : ''">

                  {{-- Avatar if selected --}}
                  <template x-if="selected">
                    <div class="dash-custom-select__avatar" style="width:22px;height:22px;font-size:.65rem;border-radius:6px"
                         x-text="selected.initial"></div>
                  </template>

                  {{-- Icon if not selected --}}
                  <template x-if="!selected">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                      <circle cx="12" cy="7" r="4"/>
                    </svg>
                  </template>

                  <span class="dash-custom-select__value">
                    <span x-show="!selected" class="dash-custom-select__placeholder">وجّه لشيخ...</span>
                    <span x-show="selected" x-text="selected?.name" style="font-size:.8rem"></span>
                  </span>

                  <svg class="dash-custom-select__chevron" width="11" height="11"
                       viewBox="0 0 16 16" fill="currentColor">
                    <path d="M4 6l4 4 4-4H4z"/>
                  </svg>
                </button>

                {{-- Panel --}}
                <div class="dash-custom-select__panel" x-show="open" x-transition
                     style="width:280px" @click.stop>

                  {{-- Search --}}
                  <div class="dash-custom-select__search">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0">
                      <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input class="dash-custom-select__search-input"
                           type="text"
                           x-model="search"
                           placeholder="ابحث عن شيخ..."
                           @click.stop>
                  </div>

                  {{-- List --}}
                  <div class="dash-custom-select__list">

                    {{-- "بدون توجيه" option --}}
                    <button type="button"
                            class="dash-custom-select__option"
                            :class="!selected ? 'dash-custom-select__option--selected' : ''"
                            @click="selected = null; open = false">
                      <div style="width:30px;height:30px;border-radius:8px;background:var(--bg-day);
                                   border:1px dashed var(--border-day);display:flex;align-items:center;
                                   justify-content:center;flex-shrink:0">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" style="color:var(--text-muted-day)">
                          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                      </div>
                      <span class="dash-custom-select__option-label" style="color:var(--text-muted-day)">
                        بدون توجيه
                      </span>
                      <svg x-show="!selected" class="dash-custom-select__check"
                           width="13" height="13" viewBox="0 0 24 24" fill="none"
                           stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                    </button>

                    {{-- Sheikh options --}}
                    <template x-for="sheikh in filteredSheikhs" :key="sheikh.id">
                      <button type="button"
                              class="dash-custom-select__option"
                              :class="selected?.id === sheikh.id ? 'dash-custom-select__option--selected' : ''"
                              @click="selected = sheikh; open = false">
                        <div class="dash-custom-select__avatar" x-text="sheikh.initial"></div>
                        <div style="flex:1;min-width:0">
                          <p class="dash-custom-select__option-label" x-text="sheikh.name"></p>
                          <p style="font-size:.67rem;color:var(--text-muted-day);margin-top:1px"
                             x-text="sheikh.specialty"></p>
                        </div>
                        <span class="dash-custom-select__option-meta" x-text="sheikh.count"></span>
                        <svg x-show="selected?.id === sheikh.id" class="dash-custom-select__check"
                             width="13" height="13" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                          <polyline points="20 6 9 17 4 12"/>
                        </svg>
                      </button>
                    </template>

                    {{-- Empty state --}}
                    <p class="dash-custom-select__empty"
                       x-show="filteredSheikhs.length === 0">
                      لا يوجد شيخ بهذا الاسم
                    </p>

                  </div>
                </div>
              </div>
            </td>

            {{-- النشر — Publish Status Dropdown --}}
            <td>
              <div class="dash-custom-select dash-publish-select"
                   :data-value="publishStatus[{{ $id }}] ?? 'draft'"
                   x-data="{ open: false }"
                   @click.away="open = false">

                <button type="button"
                        class="dash-custom-select__trigger"
                        style="min-width:110px"
                        @click="open = !open">
                  <span class="dash-status-dot"></span>
                  <span class="dash-custom-select__value"
                        x-text="(publishStatus[{{ $id }}] ?? 'draft') === 'published' ? 'منشور' : 'غير منشور'">
                  </span>
                  <svg class="dash-custom-select__chevron" width="11" height="11"
                       viewBox="0 0 16 16" fill="currentColor">
                    <path d="M4 6l4 4 4-4H4z"/>
                  </svg>
                </button>

                <div class="dash-custom-select__panel" x-show="open" x-transition
                     style="min-width:160px;width:160px" @click.stop>
                  <div class="dash-custom-select__list" style="padding:4px">

                    <button type="button"
                            class="dash-custom-select__option"
                            :class="(publishStatus[{{ $id }}] ?? 'draft') === 'published' ? 'dash-custom-select__option--selected' : ''"
                            @click="publishStatus[{{ $id }}] = 'published'; $el.closest('.dash-custom-select').setAttribute('data-value','published'); open=false">
                      <span style="width:8px;height:8px;border-radius:50%;background:#3d7a50;flex-shrink:0"></span>
                      <span class="dash-custom-select__option-label">منشور</span>
                      <svg x-show="(publishStatus[{{ $id }}] ?? 'draft') === 'published'"
                           class="dash-custom-select__check" width="12" height="12"
                           viewBox="0 0 24 24" fill="none" stroke="currentColor"
                           stroke-width="2.5" stroke-linecap="round">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                    </button>

                    <button type="button"
                            class="dash-custom-select__option"
                            :class="(publishStatus[{{ $id }}] ?? 'draft') === 'draft' ? 'dash-custom-select__option--selected' : ''"
                            @click="publishStatus[{{ $id }}] = 'draft'; $el.closest('.dash-custom-select').setAttribute('data-value','draft'); open=false">
                      <span style="width:8px;height:8px;border-radius:50%;background:var(--text-muted-day);opacity:.45;flex-shrink:0"></span>
                      <span class="dash-custom-select__option-label">غير منشور</span>
                      <svg x-show="(publishStatus[{{ $id }}] ?? 'draft') === 'draft'"
                           class="dash-custom-select__check" width="12" height="12"
                           viewBox="0 0 24 24" fill="none" stroke="currentColor"
                           stroke-width="2.5" stroke-linecap="round">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                    </button>

                  </div>
                </div>
              </div>
            </td>

            {{-- الحالة --}}
            <td>
              @if($status === 'new')
                <span class="dash-badge dash-badge--pending">
                  <span class="dash-badge__dot"></span>جديد
                </span>
              @else
                <span class="dash-badge dash-badge--draft">
                  <span class="dash-badge__dot"></span>قيد المراجعة
                </span>
              @endif
            </td>

            {{-- Actions --}}
            <td>
              <div class="dash-row-actions">
                {{-- معالجة --}}
                <button type="button"
                        class="dash-btn dash-btn--primary dash-btn--sm"
                        @click="openProcess({{ $id }}, '{{ addslashes($question) }}')">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                  معالجة
                </button>

                {{-- حذف --}}
                <button type="button"
                        class="dash-btn--delete"
                        @click="$dispatch('open-delete', {id:{{ $id }}, name:'السؤال رقم {{ $id }}'})"
                        title="حذف">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- ── Mobile cards ──────────────────────────────────────────── --}}
    <div class="dash-table-mobile">
      @php $questions_mobile = [
        [1,'حكم قراءة القرآن من الهاتف دون وضوء','مجهول','منذ ١٢ دقيقة','new'],
        [2,'هل يجوز الصلاة خلف إمام لا يُتقن الفاتحة','أحمد محمد','منذ ٤٥ دقيقة','new'],
        [3,'حكم العقود الآجلة في الذهب والفضة','مجهول','منذ ساعتين','reviewing'],
      ]; @endphp
      @foreach($questions_mobile as [$id,$q,$sender,$date,$status])
        <div class="dash-mobile-row">
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $q }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $sender }}</span>
              <span class="dash-mobile-row__meta-item">{{ $date }}</span>
              <span class="dash-mobile-row__meta-item">
                @if($status==='new')
                  <span class="dash-badge dash-badge--pending" style="font-size:.65rem">
                    <span class="dash-badge__dot"></span>جديد
                  </span>
                @else
                  <span class="dash-badge dash-badge--draft" style="font-size:.65rem">
                    <span class="dash-badge__dot"></span>قيد المراجعة
                  </span>
                @endif
              </span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button"
                    class="dash-btn dash-btn--primary dash-btn--sm"
                    @click="openProcess({{ $id }}, '{{ addslashes($q) }}')">
              معالجة
            </button>
            <button type="button"
                    class="dash-btn--delete"
                    @click="$dispatch('open-delete',{id:{{ $id }},name:'السؤال'})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
              </svg>
            </button>
          </div>
        </div>
      @endforeach
    </div>

  </div>{{-- end table-wrap --}}


  {{-- ══ PROCESS MODAL — معالجة السؤال ════════════════════════════ --}}
  <div x-show="processOpen"
       class="dash-modal-backdrop"
       @click.self="processOpen = false"
       @keydown.escape.window="processOpen = false"
       x-transition:enter="transition-opacity duration-200"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0">

    <div class="dash-modal dash-fatwa-modal" @click.stop
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">

      {{-- Header --}}
      <div class="dash-modal__header">
        <div>
          <p style="font-size:.67rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--accent);margin-bottom:3px">
            معالجة السؤال
          </p>
          <h3 class="dash-modal__title">صياغة الجواب</h3>
        </div>
        <button class="dash-modal__close" @click="processOpen = false">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      {{-- Body --}}
      <div class="dash-modal__body">

        {{-- السؤال المعروض --}}
        <div class="dash-fatwa-modal__question">
          <p class="dash-fatwa-modal__question-label">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" style="display:inline;vertical-align:middle;margin-left:4px">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            سؤال الزائر
          </p>
          <p class="dash-fatwa-modal__question-text" x-text="processQuestion"></p>
        </div>

        {{-- توجيه لشيخ داخل المودال --}}
        <div class="dash-field" style="margin-bottom:.25rem">
          <label class="dash-label">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            توجيه لشيخ <span class="dash-label__optional">(اختياري)</span>
          </label>
          <div class="dash-custom-select" x-data="{ open: false, selected: null, search: '' }"
               @click.away="open=false" style="width:100%">
            <button type="button" class="dash-custom-select__trigger" style="width:100%" @click="open=!open">
              <template x-if="selected">
                <div class="dash-custom-select__avatar" x-text="selected.initial"></div>
              </template>
              <template x-if="!selected">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
              </template>
              <span class="dash-custom-select__value">
                <span x-show="!selected" class="dash-custom-select__placeholder">اختر شيخاً للإجابة...</span>
                <span x-show="selected" x-text="selected?.name"></span>
              </span>
              <svg class="dash-custom-select__chevron" width="11" height="11"
                   viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
            </button>
            <div class="dash-custom-select__panel" x-show="open" x-transition
                 style="width:100%;position:relative;top:4px;box-shadow:none;border:1px solid var(--border-day);border-radius:10px"
                 @click.stop>
              <div class="dash-custom-select__search">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" style="color:var(--text-muted-day)">
                  <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                <input class="dash-custom-select__search-input" type="text"
                       x-model="search" placeholder="ابحث عن شيخ..." @click.stop>
              </div>
              <div class="dash-custom-select__list">
                <template x-for="s in $root.sheikhs.filter(s => s.name.includes(search))" :key="s.id">
                  <button type="button" class="dash-custom-select__option"
                          :class="selected?.id === s.id ? 'dash-custom-select__option--selected':''"
                          @click="selected = s; open = false">
                    <div class="dash-custom-select__avatar" x-text="s.initial"></div>
                    <div style="flex:1;min-width:0">
                      <p class="dash-custom-select__option-label" x-text="s.name"></p>
                      <p style="font-size:.67rem;color:var(--text-muted-day)" x-text="s.specialty"></p>
                    </div>
                    <svg x-show="selected?.id === s.id" class="dash-custom-select__check"
                         width="12" height="12" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </button>
                </template>
              </div>
            </div>
          </div>
        </div>

        {{-- صياغة الجواب --}}
        <div>
          <p class="dash-fatwa-modal__answer-label">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
            </svg>
            الجواب
          </p>
          <textarea class="dash-fatwa-modal__answer-textarea"
                    x-model="processAnswer"
                    placeholder="اكتب الجواب بوضوح — الحكم أولاً، ثم الدليل، ثم التفصيل..."></textarea>
          {{-- Guide tags --}}
          <div class="dash-fatwa-modal__guide">
            <span style="font-size:.7rem;color:var(--text-muted-day);align-self:center">قوالب:</span>
            @foreach(['الحكم:','الدليل:','التفصيل:','والله أعلم'] as $tag)
              <button type="button"
                      class="dash-fatwa-modal__guide-tag"
                      @click="processAnswer += (processAnswer ? '\n\n' : '') + '{{ $tag }} '">
                {{ $tag }}
              </button>
            @endforeach
          </div>
        </div>

        {{-- Field: المفتي --}}
        <div class="dash-field" style="margin-top:.25rem">
          <label class="dash-label">المفتي الرسمي</label>
          <select class="dash-select">
            <option value="">اختر المفتي...</option>
            <option>الشيخ يحيى الحجوري</option>
            <option>الشيخ عبد العزيز</option>
            <option>الشيخ محمد الغامدي</option>
          </select>
        </div>

        {{-- Field: تصنيف --}}
        <div class="dash-field">
          <label class="dash-label">التصنيف</label>
          <select class="dash-select">
            <option value="">اختر التصنيف...</option>
            <option>عقيدة</option>
            <option>فقه</option>
            <option>معاملات</option>
            <option>أسرة</option>
            <option>أخلاق</option>
          </select>
        </div>

      </div>

      {{-- Footer --}}
      <div class="dash-modal__footer" style="justify-content:space-between">
        <button type="button" class="dash-btn dash-btn--ghost" @click="processOpen = false">
          إلغاء
        </button>
        <div style="display:flex;gap:8px">
          {{-- حفظ كمسودة --}}
          <button type="button" class="dash-btn dash-btn--outline"
                  @click="saveProcess('draft')">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
              <polyline points="17 21 17 13 7 13 7 21"/>
              <polyline points="7 3 7 8 15 8"/>
            </svg>
            حفظ مسودة
          </button>
          {{-- نشر --}}
          <button type="button" class="dash-btn dash-btn--publish"
                  @click="saveProcess('publish')">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            نشر الفتوى
          </button>
        </div>
      </div>

    </div>{{-- end modal --}}
  </div>{{-- end backdrop --}}

  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>{{-- end x-data --}}

<script>
function fatwasQuestionsPage() {
  return {
    activeChip: 'الكل',
    tableQuery: '',
    processOpen: false,
    processId: null,
    processQuestion: '',
    processAnswer: '',
    publishStatus: {},  // { questionId: 'draft' | 'published' }

    sheikhs: [
      { id:1, name:'الشيخ يحيى الحجوري',  initial:'ي', specialty:'عقيدة وحديث', count:'٧٨ فتوى' },
      { id:2, name:'الشيخ عبد العزيز',     initial:'ع', specialty:'فقه ومعاملات', count:'٥٤ فتوى' },
      { id:3, name:'الشيخ محمد الغامدي',  initial:'م', specialty:'أصول وتفسير',  count:'٤١ فتوى' },
      { id:4, name:'الشيخ صالح الفوزان',  initial:'ص', specialty:'فقه عام',       count:'٦٢ فتوى' },
      { id:5, name:'الشيخ ابن عثيمين',    initial:'م', specialty:'فقه وعقيدة',   count:'٧١ فتوى' },
      { id:6, name:'الشيخ الألباني',       initial:'م', specialty:'حديث ورجال',   count:'٤٢ فتوى' },
      { id:7, name:'الشيخ مقبل الوادعي',  initial:'م', specialty:'حديث وتخريج',  count:'٢٨ فتوى' },
    ],

    openProcess(id, question) {
      this.processId = id;
      this.processQuestion = question;
      this.processAnswer = '';
      this.processOpen = true;
    },

    saveProcess(mode) {
      if (!this.processAnswer.trim()) {
        alert('الرجاء كتابة الجواب أولاً.');
        return;
      }
      if (mode === 'publish') {
        this.publishStatus[this.processId] = 'published';
      }
      // TODO: submit via fetch/axios
      this.processOpen = false;
    }
  }
}

function sheikhSelectData(questionId) {
  return {
    open: false,
    search: '',
    selected: null,
    get filteredSheikhs() {
      const sheikhs = [
        { id:1, name:'الشيخ يحيى الحجوري',  initial:'ي', specialty:'عقيدة وحديث', count:'٧٨ فتوى' },
        { id:2, name:'الشيخ عبد العزيز',     initial:'ع', specialty:'فقه ومعاملات', count:'٥٤ فتوى' },
        { id:3, name:'الشيخ محمد الغامدي',  initial:'م', specialty:'أصول وتفسير',  count:'٤١ فتوى' },
        { id:4, name:'الشيخ صالح الفوزان',  initial:'ص', specialty:'فقه عام',       count:'٦٢ فتوى' },
        { id:5, name:'الشيخ ابن عثيمين',    initial:'م', specialty:'فقه وعقيدة',   count:'٧١ فتوى' },
        { id:6, name:'الشيخ الألباني',       initial:'م', specialty:'حديث ورجال',   count:'٤٢ فتوى' },
        { id:7, name:'الشيخ مقبل الوادعي',  initial:'م', specialty:'حديث وتخريج',  count:'٢٨ فتوى' },
      ];
      if (!this.search) return sheikhs;
      return sheikhs.filter(s => s.name.includes(this.search));
    }
  }
}
</script>
@endsection