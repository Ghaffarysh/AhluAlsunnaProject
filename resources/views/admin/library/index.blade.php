{{-- resources/views/admin/library/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'إدارة المكتبة الإسلامية')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">المكتبة</span>
@endsection

@section('content')
<div x-data="libraryPage()">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">إدارة المكتبة الإسلامية</h1>
      <p class="dash-page-header__sub">الكتب والمتون المستقلة — PDF قابل للتحميل والقراءة</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة كتاب'"></span>
      </button>
    </div>
  </div>

  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">إضافة كتاب للمكتبة</h2>
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
              <label class="dash-label">المؤلف</label>
              <input type="text" class="dash-input" placeholder="اسم المؤلف">
            </div>
            <div class="dash-field">
              <label class="dash-label">التصنيف</label>
              <select class="dash-select">
                <option value="">اختر التصنيف...</option>
                @foreach(['عقيدة','فقه','حديث','تفسير','لغة','أخلاق'] as $t)
                  <option>{{ $t }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">نوع الكتاب</label>
              <select class="dash-select">
                <option>متن</option><option>شرح</option><option>مرجع</option><option>رسالة</option>
              </select>
            </div>
            <div class="dash-field">
              <label class="dash-label">المستوى</label>
              <select class="dash-select">
                <option>مبتدئ</option><option>متوسط</option><option>متقدم</option>
              </select>
            </div>
          </div>
          <div class="dash-field">
            <label class="dash-label">وصف الكتاب <span class="dash-label__optional">(اختياري)</span></label>
            <textarea class="dash-textarea" rows="3" placeholder="وصف مختصر..."></textarea>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">صورة الغلاف <span class="dash-label__optional">(اختياري)</span></label>
              <label class="dash-file-upload">
                <div class="dash-file-upload__icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
                <span class="dash-file-upload__label">اسحب صورة أو انقر</span>
                <input type="file" accept="image/*" style="display:none">
              </label>
            </div>
            <div class="dash-field">
              <label class="dash-label">ملف PDF <span style="color:#c0392b;font-size:.72rem">*</span></label>
              <label class="dash-file-upload">
                <div class="dash-file-upload__icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                <span class="dash-file-upload__label">اسحب ملف PDF أو انقر</span>
                <input type="file" accept=".pdf" style="display:none">
              </label>
            </div>
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
            حفظ الكتاب
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="dash-table-wrap">
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery" placeholder="ابحث باسم الكتاب أو المؤلف...">
      </div>
      <div class="dash-filter-chips" style="padding:0">
        @foreach(['الكل','متن','شرح','مرجع','رسالة'] as $chip)
          <button class="dash-filter-chip" :class="filterType==='{{ $chip }}' ? 'dash-filter-chip--active':''" @click="filterType='{{ $chip }}'">{{ $chip }}</button>
        @endforeach
      </div>
      <span class="dash-table-count" style="margin-right:auto">إجمالي: <strong>٨٩</strong> كتاباً</span>
    </div>

    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr><th>اسم الكتاب</th><th>المؤلف</th><th>التصنيف</th><th>النوع</th><th>النشر</th><th style="width:120px"></th></tr>
        </thead>
        <tbody>
          @php $books = [
            [1,'الأصول الثلاثة',        'محمد بن عبد الوهاب','عقيدة','متن',   'published','منشور', '٢ يناير ٢٠٢٥'],
            [2,'الأربعون النووية',       'الإمام النووي',     'حديث', 'متن',   'published','منشور', '٥ يناير ٢٠٢٥'],
            [3,'فتح الباري شرح البخاري','ابن حجر العسقلاني', 'حديث', 'شرح',   'draft',    'مسودة', '٨ يناير ٢٠٢٥'],
            [4,'مختصر المزني',           'المزني',            'فقه',  'مرجع',  'published','منشور', '١٢ يناير ٢٠٢٥'],
            [5,'رسالة في أصول التفسير', 'ابن تيمية',          'تفسير','رسالة', 'published','منشور', '١٥ يناير ٢٠٢٥'],
          ]; @endphp

          @foreach($books as [$id,$name,$author,$topic,$type,$statusVal,$statusLabel,$date])
          <tr data-row-id="{{ $id }}">
            <td class="dash-table__cell--title">{{ $name }}</td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $author }}</td>
            <td><span class="dash-badge" style="background:rgba(4,95,114,0.08);color:var(--primary)">{{ $topic }}</span></td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $type }}</td>
            <td><span class="dash-badge dash-badge--{{ $statusVal }}"><span class="dash-badge__dot"></span>{{ $statusLabel }}</span></td>
            <td>
              <div class="dash-row-actions">
                <button type="button" class="dash-btn--edit"
                        @click="$dispatch('open-edit', {
                          id: {{ $id }}, title: '{{ addslashes($name) }}', createdAt: '{{ $date }}',
                          fields: [
                            { label:'اسم الكتاب', name:'name', type:'text', value:'{{ addslashes($name) }}' },
                            { label:'المؤلف', name:'author', type:'text', value:'{{ addslashes($author) }}' },
                            { label:'التصنيف', name:'topic', type:'select', value:'{{ $topic }}',
                              options:[{value:'عقيدة',label:'عقيدة'},{value:'فقه',label:'فقه'},{value:'حديث',label:'حديث'},{value:'تفسير',label:'تفسير'},{value:'لغة',label:'لغة'},{value:'أخلاق',label:'أخلاق'}] },
                            { label:'نوع الكتاب', name:'type', type:'select', value:'{{ $type }}',
                              options:[{value:'متن',label:'متن'},{value:'شرح',label:'شرح'},{value:'مرجع',label:'مرجع'},{value:'رسالة',label:'رسالة'}] },
                            { label:'حالة النشر', name:'status', type:'select', value:'{{ $statusVal }}',
                              options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}] }
                          ]
                        })">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  تعديل
                </button>
                <button type="button" class="dash-btn--delete" @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($name) }}'})">
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
      @foreach($books as [$id,$name,$author,$topic,$type,$statusVal,$statusLabel,$date])
        <div class="dash-mobile-row" data-row-id="{{ $id }}">
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $name }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $author }}</span>
              <span class="dash-mobile-row__meta-item">{{ $type }}</span>
              <span class="dash-mobile-row__meta-item"><span class="dash-badge dash-badge--{{ $statusVal }}" style="font-size:.65rem"><span class="dash-badge__dot"></span>{{ $statusLabel }}</span></span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button" class="dash-btn--edit"
                    @click="$dispatch('open-edit',{id:{{ $id }},title:'{{ addslashes($name) }}',fields:[{label:'اسم الكتاب',name:'name',type:'text',value:'{{ addslashes($name) }}'},{label:'المؤلف',name:'author',type:'text',value:'{{ addslashes($author) }}'},{label:'حالة النشر',name:'status',type:'select',value:'{{ $statusVal }}',options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}]}]})">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              تعديل
            </button>
            <button type="button" class="dash-btn--delete" @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($name) }}'})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <x-dashboard.edit-panel formAction="/admin/library" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>
<script>
function libraryPage() { return { showForm: false, tableQuery: '', filterType: 'الكل' } }
</script>
@endsection