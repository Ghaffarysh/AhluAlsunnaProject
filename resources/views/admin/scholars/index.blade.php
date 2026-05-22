{{-- resources/views/admin/scholars/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'الشيوخ والعلماء')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">الشيوخ والعلماء</span>
@endsection

@section('content')
<div x-data="scholarsPage()">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">الشيوخ والعلماء</h1>
      <p class="dash-page-header__sub">قاعدة بيانات الشيوخ المرجعية — كل إضافة محتوى تستدعي منها</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء' : 'إضافة شيخ'"></span>
      </button>
    </div>
  </div>

  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">إضافة شيخ جديد</h2>
      </div>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <div class="dash-form-card__body">
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">الاسم الكامل <span style="color:#c0392b;font-size:.72rem">*</span></label>
              <input type="text" class="dash-input" placeholder="مثال: يحيى بن علي الحجوري" required>
            </div>
            <div class="dash-field">
              <label class="dash-label">اللقب العلمي</label>
              <input type="text" class="dash-input" placeholder="مثال: شيخ دار الحديث بدماج">
            </div>
          </div>
          <div class="dash-field">
            <label class="dash-label">صورة الشيخ <span class="dash-label__optional">(اختياري)</span></label>
            <label class="dash-file-upload">
              <div class="dash-file-upload__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              </div>
              <span class="dash-file-upload__label">اسحب صورة أو انقر للاختيار</span>
              <input type="file" accept="image/*" style="display:none">
            </label>
          </div>
          <div class="dash-field">
            <label class="dash-label">نبذة مختصرة <span class="dash-label__optional">(اختياري)</span></label>
            <textarea class="dash-textarea" rows="3" placeholder="نبذة عن الشيخ وتخصصه..."></textarea>
          </div>
          <div class="dash-field">
            <label class="dash-label">التخصص</label>
            <select class="dash-select">
              <option value="">اختر التخصص...</option>
              @foreach(['عقيدة','فقه','حديث','تفسير','لغة','متعدد'] as $s)
                <option>{{ $s }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="dash-form-card__footer">
          <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
          <button type="submit" class="dash-btn dash-btn--primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            حفظ
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="dash-table-wrap">
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery" placeholder="ابحث باسم الشيخ...">
      </div>
      <span class="dash-table-count" style="margin-right:auto">إجمالي: <strong>١٢</strong> شيخاً</span>
    </div>

    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr><th>الشيخ</th><th>اللقب العلمي</th><th>التخصص</th><th>المقررات</th><th>الفتاوى</th><th style="width:120px"></th></tr>
        </thead>
        <tbody>
          @php $scholars = [
            [1,'ي','يحيى بن علي الحجوري',  'شيخ دار الحديث بدماج',   'عقيدة وحديث', 47, 124, '٢ يناير ٢٠٢٤'],
            [2,'ع','عبد العزيز بن مرزوق',   'أستاذ في جامعة الإيمان',  'فقه معاملات', 38, 98,  '١٠ مارس ٢٠٢٤'],
            [3,'م','محمد بن هادي الغامدي',   'عالم سعودي',               'أصول وتفسير', 29, 74,  '٥ أبريل ٢٠٢٤'],
            [4,'ص','صالح بن فوزان الفوزان', 'عضو اللجنة الدائمة',       'فقه عام',     52, 210, '١ يناير ٢٠٢٤'],
          ]; @endphp

          @foreach($scholars as [$id,$initial,$name,$title,$specialty,$curricula,$fatwas,$date])
          <tr data-row-id="{{ $id }}">
            <td>
              <div style="display:flex;align-items:center;gap:10px">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(4,95,114,0.1);color:var(--primary);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;flex-shrink:0;font-family:'ThmanyahSerifDisplay',serif">{{ $initial }}</div>
                <span class="dash-table__cell--title">{{ $name }}</span>
              </div>
            </td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $title }}</td>
            <td><span class="dash-badge" style="background:rgba(4,95,114,0.08);color:var(--primary)">{{ $specialty }}</span></td>
            <td style="font-size:.84rem;font-weight:600;color:var(--text-day)">{{ $curricula }}</td>
            <td style="font-size:.84rem;font-weight:600;color:var(--text-day)">{{ $fatwas }}</td>
            <td>
              <div class="dash-row-actions">
                <button type="button" class="dash-btn--edit"
                        @click="$dispatch('open-edit', {
                          id: {{ $id }}, title: '{{ addslashes($name) }}', createdAt: '{{ $date }}',
                          fields: [
                            { label:'الاسم الكامل', name:'name', type:'text', value:'{{ addslashes($name) }}' },
                            { label:'اللقب العلمي', name:'academic_title', type:'text', value:'{{ addslashes($title) }}' },
                            { label:'التخصص', name:'specialty', type:'select', value:'{{ $specialty }}',
                              options:[{value:'عقيدة وحديث',label:'عقيدة وحديث'},{value:'فقه معاملات',label:'فقه معاملات'},{value:'أصول وتفسير',label:'أصول وتفسير'},{value:'فقه عام',label:'فقه عام'},{value:'لغة',label:'لغة'}] },
                            { label:'نبذة مختصرة', name:'bio', type:'textarea', value:'', placeholder:'نبذة عن الشيخ...' }
                          ]
                        })">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  تعديل
                </button>
                <button type="button" class="dash-btn--delete"
                        @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($name) }}'})" title="حذف">
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
      @foreach($scholars as [$id,$initial,$name,$title,$specialty,$curricula,$fatwas,$date])
        <div class="dash-mobile-row" data-row-id="{{ $id }}">
          <div style="width:36px;height:36px;border-radius:10px;background:rgba(4,95,114,0.1);color:var(--primary);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;flex-shrink:0">{{ $initial }}</div>
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $name }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $title }}</span>
              <span class="dash-mobile-row__meta-item">{{ $curricula }} مقرراً</span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button" class="dash-btn--edit"
                    @click="$dispatch('open-edit',{id:{{ $id }},title:'{{ addslashes($name) }}',fields:[{label:'الاسم الكامل',name:'name',type:'text',value:'{{ addslashes($name) }}'},{label:'اللقب العلمي',name:'academic_title',type:'text',value:'{{ addslashes($title) }}'}]})">
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

  <x-dashboard.edit-panel formAction="/admin/scholars" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>
<script>
function scholarsPage() { return { showForm: false, tableQuery: '' } }
</script>
@endsection