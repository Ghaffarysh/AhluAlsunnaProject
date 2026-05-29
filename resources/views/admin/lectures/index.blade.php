{{-- resources/views/admin/lectures/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'إدارة المحاضرات العامة')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">المحاضرات</span>
@endsection

@section('content')
<div x-data="lecturesPage()">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">إدارة المحاضرات العامة</h1>
      <p class="dash-page-header__sub">المحاضرات العلمية المستقلة — مفردة أو متعددة الأجزاء</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة محاضرة'"></span>
      </button>
    </div>
  </div>

  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">إضافة محاضرة جديدة</h2>
      </div>
      <form method="POST" action="#" enctype="multipart/form-data" x-data="{ isMulti: false }">
        @csrf
        <div class="dash-form-card__body">
          <div class="dash-field">
            <label class="dash-label">عنوان المحاضرة الرئيسي <span style="color:#c0392b;font-size:.72rem">*</span></label>
            <input type="text" class="dash-input" placeholder="مثال: أسباب النصر والهزيمة في ضوء السنة" required>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">الشيخ</label>
              <select class="dash-select">
                <option value="">اختر الشيخ...</option>
                @foreach(['الشيخ يحيى الحجوري','الشيخ عبد العزيز','الشيخ محمد الغامدي'] as $s)
                  <option>{{ $s }}</option>
                @endforeach
              </select>
            </div>
            <div class="dash-field">
              <label class="dash-label">التصنيف</label>
              <select class="dash-select">
                <option value="">اختر التصنيف...</option>
                @foreach(['عقيدة','فقه','أخلاق','حديث'] as $t)
                  <option>{{ $t }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="dash-toggle-row">
            <span class="dash-toggle-label">محاضرة متعددة الأجزاء؟</span>
            <label class="dash-toggle">
              <input type="checkbox" x-model="isMulti">
              <span class="dash-toggle__slider"></span>
            </label>
          </div>
          <div x-show="isMulti" x-transition>
            <div class="dash-field">
              <label class="dash-label">رقم الجزء</label>
              <input type="number" class="dash-input" placeholder="١" min="1">
            </div>
          </div>
          <div class="dash-field">
            <label class="dash-label">ملف الصوت <span style="color:#c0392b;font-size:.72rem">*</span></label>
            <label class="dash-file-upload">
              <div class="dash-file-upload__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              </div>
              <span class="dash-file-upload__label">اسحب ملف MP3 أو انقر للاختيار</span>
              <input type="file" accept="audio/*" style="display:none">
            </label>
          </div>
          <div class="dash-field">
            <label class="dash-label">نص الدرس <span class="dash-label__optional">(اختياري)</span></label>
            <textarea class="dash-textarea" rows="4" placeholder="نص الدرس أو ملخصه..."></textarea>
          </div>
          <div class="dash-field">
            <label class="dash-label">حالة النشر</label>
            <select class="dash-select"><option value="draft">مسودة</option><option value="published">منشور</option></select>
          </div>
        </div>
        <div class="dash-form-card__footer">
          <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
          <button type="submit" class="dash-btn dash-btn--primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            حفظ المحاضرة
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="dash-table-wrap">
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery" placeholder="ابحث بعنوان المحاضرة أو الشيخ...">
      </div>
      <div class="dash-filter-chips" style="padding:0">
        @foreach(['الكل','مفردة','متعددة الأجزاء'] as $chip)
          <button class="dash-filter-chip" :class="filterType==='{{ $chip }}' ? 'dash-filter-chip--active':''" @click="filterType='{{ $chip }}'">{{ $chip }}</button>
        @endforeach
      </div>
      <span class="dash-table-count" style="margin-right:auto">إجمالي: <strong>٢١٩</strong> محاضرة</span>
    </div>

    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr><th>عنوان المحاضرة</th><th>الشيخ</th><th>الأجزاء</th><th>التصنيف</th><th>النشر</th><th style="width:120px"></th></tr>
        </thead>
        <tbody>
          @php $lectures = [
            [1,'أسباب النصر والهزيمة في ضوء السنة', 'الشيخ يحيى الحجوري','٣ أجزاء','عقيدة','published','منشور', '٢ يناير ٢٠٢٥'],
            [2,'الشباب والتحديات المعاصرة',          'الشيخ عبد العزيز',  '١ جزء',  'أخلاق','published','منشور', '٩ يناير ٢٠٢٥'],
            [3,'الإسلام والعلم',                     'الشيخ محمد الغامدي','١ جزء',  'عقيدة','draft',    'مسودة', '١٦ يناير ٢٠٢٥'],
            [4,'التحذير من فتنة المال',              'الشيخ يحيى الحجوري','٢ جزء',  'فقه',  'published','منشور', '٢٣ يناير ٢٠٢٥'],
            [5,'مفهوم التوبة وشروط قبولها',          'الشيخ عبد العزيز',  '١ جزء',  'أخلاق','published','منشور', '٣٠ يناير ٢٠٢٥'],
          ]; @endphp

          @foreach($lectures as [$id,$title,$sheikh,$parts,$topic,$statusVal,$statusLabel,$date])
          <tr data-row-id="{{ $id }}">
            <td class="dash-table__cell--title">{{ $title }}</td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $sheikh }}</td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $parts }}</td>
            <td><span class="dash-badge" style="background:rgba(4,95,114,0.08);color:var(--primary)">{{ $topic }}</span></td>
            <td><span class="dash-badge dash-badge--{{ $statusVal }}"><span class="dash-badge__dot"></span>{{ $statusLabel }}</span></td>
            <td>
              <div class="dash-row-actions">
                <button type="button" class="dash-btn--edit"
                        @click="$dispatch('open-edit', {
                          id: {{ $id }}, title: '{{ addslashes($title) }}', createdAt: '{{ $date }}',
                          fields: [
                            { label:'عنوان المحاضرة', name:'title', type:'text', value:'{{ addslashes($title) }}' },
                            { label:'الشيخ', name:'sheikh', type:'select', value:'{{ $sheikh }}',
                              options:[{value:'الشيخ يحيى الحجوري',label:'الشيخ يحيى الحجوري'},{value:'الشيخ عبد العزيز',label:'الشيخ عبد العزيز'},{value:'الشيخ محمد الغامدي',label:'الشيخ محمد الغامدي'}] },
                            { label:'التصنيف', name:'topic', type:'select', value:'{{ $topic }}',
                              options:[{value:'عقيدة',label:'عقيدة'},{value:'فقه',label:'فقه'},{value:'أخلاق',label:'أخلاق'},{value:'حديث',label:'حديث'}] },
                            { label:'حالة النشر', name:'status', type:'select', value:'{{ $statusVal }}',
                              options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}] }
                          ]
                        })">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  تعديل
                </button>
                <button type="button" class="dash-btn--delete"
                        @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($title) }}'})">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                </button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="dash-table-mobile">
      @foreach($lectures as [$id,$title,$sheikh,$parts,$topic,$statusVal,$statusLabel,$date])
        <div class="dash-mobile-row" data-row-id="{{ $id }}">
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $title }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $sheikh }}</span>
              <span class="dash-mobile-row__meta-item">{{ $parts }}</span>
              <span class="dash-mobile-row__meta-item"><span class="dash-badge dash-badge--{{ $statusVal }}" style="font-size:.65rem"><span class="dash-badge__dot"></span>{{ $statusLabel }}</span></span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button" class="dash-btn--edit"
                    @click="$dispatch('open-edit',{id:{{ $id }},title:'{{ addslashes($title) }}',fields:[{label:'عنوان المحاضرة',name:'title',type:'text',value:'{{ addslashes($title) }}'},{label:'حالة النشر',name:'status',type:'select',value:'{{ $statusVal }}',options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}]}]})">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              تعديل
            </button>
            <button type="button" class="dash-btn--delete" @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($title) }}'})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <x-dashboard.edit-panel formAction="/admin/lectures" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>
<script>
function lecturesPage() { return { showForm: false, tableQuery: '', filterType: 'الكل' } }
</script>
@endsection