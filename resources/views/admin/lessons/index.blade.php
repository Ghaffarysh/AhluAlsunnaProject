{{-- resources/views/admin/lessons/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'إدارة الدروس')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">الدروس</span>
@endsection

@section('content')
<div x-data="lessonsPage()">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">إدارة الدروس</h1>
      <p class="dash-page-header__sub">إضافة الدروس الصوتية وربطها بمقرراتها</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة درس'"></span>
      </button>
    </div>
  </div>

  {{-- Add Form --}}
  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          إضافة درس جديد
        </h2>
      </div>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <div class="dash-form-card__body">
          <div class="dash-field">
            <label class="dash-label">المقرر المرتبط <span style="color:#c0392b;font-size:.72rem">*</span></label>
            <select class="dash-select" required>
              <option value="">اختر المقرر...</option>
              @foreach(['الأصول الثلاثة','الأربعون النووية','زاد المستقنع','العقيدة الواسطية'] as $c)
                <option>{{ $c }}</option>
              @endforeach
            </select>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">رقم الدرس <span style="color:#c0392b;font-size:.72rem">*</span></label>
              <input type="number" class="dash-input" placeholder="١" min="1">
            </div>
            <div class="dash-field">
              <label class="dash-label">عنوان الدرس <span style="color:#c0392b;font-size:.72rem">*</span></label>
              <input type="text" class="dash-input" placeholder="مثال: الدرس الأول — مقدمة" required>
            </div>
          </div>
          <div class="dash-field">
            <label class="dash-label">ملف الصوت <span style="color:#c0392b;font-size:.72rem">*</span></label>
            <label class="dash-file-upload">
              <div class="dash-file-upload__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                  <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
              </div>
              <span class="dash-file-upload__label">اسحب ملف MP3 أو انقر للاختيار</span>
              <input type="file" accept="audio/*" style="display:none">
            </label>
          </div>
          <div class="dash-field">
            <label class="dash-label">رابط صوتي بديل <span class="dash-label__optional">(اختياري)</span></label>
            <input type="url" class="dash-input" placeholder="https://...">
          </div>
          <div class="dash-field">
            <label class="dash-label">نص الدرس <span class="dash-label__optional">(اختياري)</span></label>
            <textarea class="dash-textarea" rows="4" placeholder="نص الدرس أو ملخصه..."></textarea>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">مدة الصوت <span class="dash-label__optional">(اختياري)</span></label>
              <input type="text" class="dash-input" placeholder="مثال: ٤٨ دقيقة">
            </div>
            <div class="dash-field">
              <label class="dash-label">حالة النشر</label>
              <select class="dash-select">
                <option value="draft">مسودة</option>
                <option value="published">منشور</option>
              </select>
            </div>
          </div>
        </div>
        <div class="dash-form-card__footer">
          <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
          <button type="submit" class="dash-btn dash-btn--primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            حفظ الدرس
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- Table --}}
  <div class="dash-table-wrap">
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             style="color:var(--text-muted-day);flex-shrink:0">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery"
               placeholder="ابحث بعنوان الدرس أو المقرر...">
      </div>
      <div class="dash-filter-chips" style="padding:0">
         as $chip)
          <button class="dash-filter-chip"
                  :class="filterStatus==='{{ $chip }}' ? 'dash-filter-chip--active':''"
                  @click="filterStatus='{{ $chip }}'">{{ $chip }}</button>
        @endforeach
      </div>
      <span class="dash-table-count" style="margin-right:auto">إجمالي: <strong>٢٠٤٨</strong> درساً</span>
    </div>

    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr>
            <th style="width:40px">#</th>
            <th>عنوان الدرس</th>
            <th>المقرر</th>
            <th>المدة</th>
            <th>النشر</th>
            <th style="width:120px"></th>
          </tr>
        </thead>
        <tbody>
          @php $lessons = [
            [1, 1,  'مقدمة المقرر وأهمية الكتاب',           'الأصول الثلاثة',    '٢٢ د', 'published','منشور',  '٢ يناير ٢٠٢٥'],
            [2, 2,  'الأصل الأول: معرفة الرب سبحانه',      'الأصول الثلاثة',    '٥٢ د', 'published','منشور',  '٣ يناير ٢٠٢٥'],
            [3, 3,  'الأصل الثاني: معرفة دين الإسلام',     'الأصول الثلاثة',    '٤٨ د', 'published','منشور',  '٤ يناير ٢٠٢٥'],
            [4, 1,  'مقدمة في علم الحديث',                  'الأربعون النووية',  '٣٥ د', 'published','منشور',  '٥ يناير ٢٠٢٥'],
            [5, 2,  'الحديث الأول: الأعمال بالنيات',        'الأربعون النووية',  '٦٢ د', 'draft',    'مسودة',  '٦ يناير ٢٠٢٥'],
          ]; @endphp

          @foreach($lessons as [$id,$num,$title,$curriculum,$dur,$statusVal,$statusLabel,$date])
          <tr data-row-id="{{ $id }}">
            <td style="font-size:.8rem;color:var(--text-muted-day);font-weight:600">{{ $num }}</td>
            <td class="dash-table__cell--title">{{ $title }}</td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $curriculum }}</td>
            <td style="font-size:.82rem;color:var(--text-muted-day);white-space:nowrap">{{ $dur }}</td>
            <td>
              <span class="dash-badge dash-badge--{{ $statusVal }}">
                <span class="dash-badge__dot"></span>{{ $statusLabel }}
              </span>
            </td>
            <td>
              <div class="dash-row-actions">
                <button type="button" class="dash-btn--edit"
                        @click="$dispatch('open-edit', {
                          id: {{ $id }},
                          title: '{{ addslashes($title) }}',
                          createdAt: '{{ $date }}',
                          fields: [
                            { label:'عنوان الدرس', name:'title', type:'text', value:'{{ addslashes($title) }}' },
                            { label:'رقم الدرس', name:'number', type:'number', value:'{{ $num }}' },
                            { label:'المقرر', name:'curriculum', type:'select', value:'{{ $curriculum }}',
                              options:[
                                {value:'الأصول الثلاثة',label:'الأصول الثلاثة'},
                                {value:'الأربعون النووية',label:'الأربعون النووية'},
                                {value:'زاد المستقنع',label:'زاد المستقنع'},
                                {value:'العقيدة الواسطية',label:'العقيدة الواسطية'}
                              ]
                            },
                            { label:'مدة الصوت', name:'duration', type:'text', value:'{{ $dur }}', placeholder:'مثال: ٤٨ دقيقة' },
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
                <button type="button" class="dash-btn--delete"
                        @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($title) }}'})"
                        title="حذف">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
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

    <div class="dash-table-mobile">
      @foreach($lessons as [$id,$num,$title,$curriculum,$dur,$statusVal,$statusLabel,$date])
        <div class="dash-mobile-row" data-row-id="{{ $id }}">
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $title }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $curriculum }}</span>
              <span class="dash-mobile-row__meta-item">{{ $dur }}</span>
              <span class="dash-mobile-row__meta-item">
                <span class="dash-badge dash-badge--{{ $statusVal }}" style="font-size:.65rem">
                  <span class="dash-badge__dot"></span>{{ $statusLabel }}
                </span>
              </span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button" class="dash-btn--edit"
                    @click="$dispatch('open-edit',{id:{{ $id }},title:'{{ addslashes($title) }}',fields:[
                      {label:'عنوان الدرس',name:'title',type:'text',value:'{{ addslashes($title) }}'},
                      {label:'حالة النشر',name:'status',type:'select',value:'{{ $statusVal }}',options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}]}
                    ]})">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
              </svg>
              تعديل
            </button>
            <button type="button" class="dash-btn--delete"
                    @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($title) }}'})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
              </svg>
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <x-dashboard.edit-panel formAction="/admin/lessons" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>

<script>
function lessonsPage() {
  return { showForm: false, tableQuery: '', filterStatus: 'الكل' }
}
</script>
@endsection