{{-- resources/views/admin/curricula/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'إدارة المقررات العلمية')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">المقررات العلمية</span>
@endsection

@section('content')
<div x-data="curriculaPage()">

  {{-- ══ Header ═══════════════════════════════════════════════════ --}}
  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">إدارة المقررات العلمية</h1>
      <p class="dash-page-header__sub">إدارة الكتب والمتون العلمية مع الشيوخ الشارحين</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة مقرر'"></span>
      </button>
    </div>
  </div>

  {{-- ══ Add Form ══════════════════════════════════════════════════ --}}
  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          إضافة مقرر علمي جديد
        </h2>
      </div>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <div class="dash-form-card__body">

          <div class="dash-field">
            <label class="dash-label">اسم الكتاب <span style="color:#c0392b;font-size:.72rem">*</span></label>
            <input type="text" class="dash-input" placeholder="مثال: الأصول الثلاثة" required>
          </div>

          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">المؤلف الأصلي</label>
              <input type="text" class="dash-input" placeholder="مثال: محمد بن عبد الوهاب">
            </div>
            <div class="dash-field">
              <label class="dash-label">الشيخ الشارح</label>
              <select class="dash-select">
                <option value="">اختر الشيخ...</option>
                <option>الشيخ يحيى الحجوري</option>
                <option>الشيخ عبد العزيز</option>
                <option>الشيخ محمد الغامدي</option>
              </select>
            </div>
          </div>

          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">التخصص</label>
              <select class="dash-select">
                <option value="">اختر التخصص...</option>
                @foreach(['عقيدة','فقه','حديث','تفسير','لغة','أخلاق'] as $s)
                  <option>{{ $s }}</option>
                @endforeach
              </select>
            </div>
            <div class="dash-field">
              <label class="dash-label">المستوى</label>
              <select class="dash-select">
                <option value="">اختر المستوى...</option>
                <option>مبتدئ</option><option>متوسط</option><option>متقدم</option>
              </select>
            </div>
          </div>

          <div class="dash-field">
            <label class="dash-label">وصف المقرر <span class="dash-label__optional">(اختياري)</span></label>
            <textarea class="dash-textarea" rows="3" placeholder="وصف مختصر للمقرر..."></textarea>
          </div>

          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">صورة الغلاف <span class="dash-label__optional">(اختياري)</span></label>
              <label class="dash-file-upload">
                <div class="dash-file-upload__icon">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                  </svg>
                </div>
                <span class="dash-file-upload__label">اسحب صورة أو انقر للاختيار</span>
                <input type="file" accept="image/*" style="display:none">
              </label>
            </div>
            <div class="dash-field">
              <label class="dash-label">ملف PDF للكتاب <span class="dash-label__optional">(اختياري)</span></label>
              <label class="dash-file-upload">
                <div class="dash-file-upload__icon">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                  </svg>
                </div>
                <span class="dash-file-upload__label">اسحب ملف PDF أو انقر</span>
                <input type="file" accept=".pdf" style="display:none">
              </label>
            </div>
          </div>

          <div class="dash-field">
            <label class="dash-label">حالة النشر</label>
            <select class="dash-select">
              <option value="draft">مسودة</option>
              <option value="published">منشور</option>
            </select>
          </div>

        </div>
        <div class="dash-form-card__footer">
          <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
          <button type="submit" class="dash-btn dash-btn--primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            حفظ المقرر
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- ══ Table ════════════════════════════════════════════════════ --}}
  <div class="dash-table-wrap">
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             style="color:var(--text-muted-day);flex-shrink:0">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery"
               placeholder="ابحث باسم الكتاب أو الشيخ...">
      </div>

      {{-- Publish filter --}}
      <div class="dash-filter-chips" style="padding:0">
        @foreach(['الكل','منشور','مسودة'] as $chip)
          <button class="dash-filter-chip"
                  :class="filterStatus==='{{ $chip }}' ? 'dash-filter-chip--active' : ''"
                  @click="filterStatus='{{ $chip }}'">
            {{ $chip }}
          </button>
        @endforeach
      </div>

      <span class="dash-table-count" style="margin-right:auto">
        إجمالي: <strong>١٤٧</strong> مقرر
      </span>
    </div>

    {{-- Desktop --}}
    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr>
            <th>اسم الكتاب</th>
            <th>الشيخ الشارح</th>
            <th>التخصص</th>
            <th>الدروس</th>
            <th>النشر</th>
            <th>تاريخ الإضافة</th>
            <th style="width:120px"></th>
          </tr>
        </thead>
        <tbody>
          @php $curricula = [
            [1,'الأصول الثلاثة',            'الشيخ يحيى الحجوري', 'aqeedah','عقيدة','١٢ درساً','published','منشور',  '٢ يناير ٢٠٢٥'],
            [2,'الأربعون النووية',           'الشيخ محمد الغامدي', 'hadith', 'حديث', '٤٢ درساً','draft',    'مسودة',  '١٥ يناير ٢٠٢٥'],
            [3,'زاد المستقنع في الفقه',      'الشيخ عبد العزيز',   'fiqh',   'فقه',  '٨٨ درساً','published','منشور',  '١ فبراير ٢٠٢٥'],
            [4,'العقيدة الواسطية',           'الشيخ يحيى الحجوري', 'aqeedah','عقيدة','٢٤ درساً','published','منشور',  '٨ فبراير ٢٠٢٥'],
            [5,'متن الآجرومية في النحو',     'الشيخ محمد الغامدي', 'lang',   'لغة',  '١٦ درساً','draft',    'مسودة',  '١٢ فبراير ٢٠٢٥'],
          ]; @endphp

          @foreach($curricula as [$id,$book,$sheikh,$topicId,$topic,$lessons,$statusVal,$statusLabel,$date])
          <tr x-bind:data-row-id="'row-' + ($id ?? $loop?.index ?? Math.random())" data-row-id="">
            <td>
              <div style="display:flex;align-items:center;gap:10px">
                <div style="width:8px;height:8px;border-radius:50%;flex-shrink:0;
                  background:{{ $topicId==='aqeedah' ? 'var(--primary)' : ($topicId==='fiqh' ? '#3d7a50' : ($topicId==='hadith' ? 'var(--accent)' : ($topicId==='lang' ? '#3c648c' : 'var(--text-muted-day)'))) }}">
                </div>
                <span class="dash-table__cell--title">{{ $book }}</span>
              </div>
            </td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $sheikh }}</td>
            <td>
              <span class="dash-badge dash-badge--{{ $statusVal === 'published' ? 'published' : 'draft' }}"
                    style="background:rgba(4,95,114,0.08);color:var(--primary);border-color:transparent">
                {{ $topic }}
              </span>
            </td>
            <td style="font-size:.84rem;font-weight:600;color:var(--text-day)">{{ $lessons }}</td>
            <td>
              <span class="dash-badge dash-badge--{{ $statusVal }}">
                <span class="dash-badge__dot"></span>{{ $statusLabel }}
              </span>
            </td>
            <td style="font-size:.78rem;color:var(--text-muted-day);white-space:nowrap">{{ $date }}</td>
            <td>
              <div class="dash-row-actions">
                {{-- Edit — opens slide panel --}}
                <button type="button"
                        class="dash-btn--edit"
                        @click="$dispatch('open-edit', {
                          id: {{ $id }},
                          title: '{{ addslashes($book) }}',
                          createdAt: '{{ $date }}',
                          fields: [
                            { label:'اسم الكتاب', name:'title', type:'text', value:'{{ addslashes($book) }}' },
                            { label:'الشيخ الشارح', name:'sheikh', type:'select', value:'{{ $sheikh }}',
                              options:[
                                {value:'الشيخ يحيى الحجوري',label:'الشيخ يحيى الحجوري'},
                                {value:'الشيخ عبد العزيز',label:'الشيخ عبد العزيز'},
                                {value:'الشيخ محمد الغامدي',label:'الشيخ محمد الغامدي'}
                              ]
                            },
                            { label:'التخصص', name:'topic', type:'select', value:'{{ $topic }}',
                              options:[
                                {value:'عقيدة',label:'عقيدة'},{value:'فقه',label:'فقه'},
                                {value:'حديث',label:'حديث'},{value:'لغة',label:'لغة'},{value:'أخلاق',label:'أخلاق'}
                              ]
                            },
                            { label:'حالة النشر', name:'status', type:'select', value:'{{ $statusVal }}',
                              options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}]
                            }
                          ]
                        })">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                  تعديل
                </button>

                {{-- Delete --}}
                <button type="button"
                        class="dash-btn--delete"
                        @click="$dispatch('open-delete', {id:{{ $id }}, name:'{{ addslashes($book) }}'})"
                        title="حذف">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                       stroke-width="2" stroke-linecap="round">
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

    {{-- Mobile --}}
    <div class="dash-table-mobile">
      @foreach($curricula as [$id,$book,$sheikh,$topicId,$topic,$lessons,$statusVal,$statusLabel,$date])
        <div class="dash-mobile-row">
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $book }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $sheikh }}</span>
              <span class="dash-mobile-row__meta-item">{{ $lessons }}</span>
              <span class="dash-mobile-row__meta-item">
                <span class="dash-badge dash-badge--{{ $statusVal }}" style="font-size:.65rem">
                  <span class="dash-badge__dot"></span>{{ $statusLabel }}
                </span>
              </span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button"
                    class="dash-btn--edit"
                    @click="$dispatch('open-edit', {id:{{ $id }}, title:'{{ addslashes($book) }}', fields:[]})">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
              </svg>
              تعديل
            </button>
            <button type="button"
                    class="dash-btn--delete"
                    @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($book) }}'})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
              </svg>
            </button>
          </div>
        </div>
      @endforeach
    </div>

  </div>{{-- end table-wrap --}}

  {{-- Shared components --}}
  <x-dashboard.edit-panel formAction="/admin/curricula" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>

<script>
function curriculaPage() {
  return {
    showForm: false,
    tableQuery: '',
    filterStatus: 'الكل',
  }
}
</script>
@endsection