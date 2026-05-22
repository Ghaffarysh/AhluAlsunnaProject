{{-- resources/views/admin/refutations/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'إدارة الردود العلمية')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">الردود العلمية</span>
@endsection

@section('content')
<div x-data="refutationsPage()">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">إدارة الردود العلمية</h1>
      <p class="dash-page-header__sub">الردود على البدع والشبهات — مع نظام اعتماد من الإدارة العامة</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة رد'"></span>
      </button>
    </div>
  </div>

  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">إضافة رد علمي جديد</h2>
      </div>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <div class="dash-form-card__body">
          <div class="dash-field">
            <label class="dash-label">عنوان الرد <span style="color:#c0392b;font-size:.72rem">*</span></label>
            <input type="text" class="dash-input" placeholder="مثال: الرد على شبهة تعدد الزوجات" required>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">الشيخ الراد</label>
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
                @foreach(['الردود على البدع','الردود على الفرق الضالة','الردود على الشبهات','الردود على الإلحاد','الردود على الفتن المعاصرة'] as $t)
                  <option>{{ $t }}</option>
                @endforeach
              </select>
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
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">حالة الاعتماد</label>
              <select class="dash-select"><option value="pending">قيد المراجعة</option><option value="approved">معتمد</option><option value="rejected">مرفوض</option></select>
            </div>
            <div class="dash-field">
              <label class="dash-label">حالة النشر</label>
              <select class="dash-select"><option value="draft">مسودة</option><option value="published">منشور</option></select>
            </div>
          </div>
        </div>
        <div class="dash-form-card__footer">
          <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
          <button type="submit" class="dash-btn dash-btn--primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            حفظ الرد
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="dash-table-wrap">
    <div class="dash-table-toolbar">
      <div class="dash-table-search">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input class="dash-table-search__input" type="text" x-model="tableQuery" placeholder="ابحث عن رد...">
      </div>
      <div class="dash-filter-chips" style="padding:0">
        @foreach(['الكل','قيد المراجعة','معتمد','مرفوض'] as $chip)
          <button class="dash-filter-chip" :class="filterApproval==='{{ $chip }}' ? 'dash-filter-chip--active':''" @click="filterApproval='{{ $chip }}'">{{ $chip }}</button>
        @endforeach
      </div>
      <span class="dash-table-count" style="margin-right:auto">إجمالي: <strong>٢٠٠</strong> رد</span>
    </div>

    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr><th>عنوان الرد</th><th>الشيخ</th><th>التصنيف</th><th>الاعتماد</th><th>النشر</th><th style="width:120px"></th></tr>
        </thead>
        <tbody>
          @php $refutations = [
            [1,'الرد على شبهة تعدد الزوجات',         'الشيخ يحيى الحجوري','الإلحاد',   'approved','معتمد',       'published','منشور', '٢ يناير ٢٠٢٥'],
            [2,'الرد على القرآنيين',                  'الشيخ عبد العزيز',  'الشبهات',   'approved','معتمد',       'published','منشور', '٩ يناير ٢٠٢٥'],
            [3,'الرد على حركة الإخوان المسلمين',      'الشيخ يحيى الحجوري','الفرق',    'pending', 'قيد المراجعة','draft',    'مسودة', '١٦ يناير ٢٠٢٥'],
            [4,'الرد على بدعة القبورية',              'الشيخ محمد الغامدي','البدع',     'approved','معتمد',       'published','منشور', '٢٣ يناير ٢٠٢٥'],
            [5,'الرد على نظرية التطور',               'الشيخ يحيى الحجوري','الإلحاد',   'rejected','مرفوض',       'draft',    'مسودة', '٣٠ يناير ٢٠٢٥'],
          ]; @endphp

          @foreach($refutations as [$id,$title,$sheikh,$cat,$approvalVal,$approvalLabel,$statusVal,$statusLabel,$date])
          <tr data-row-id="{{ $id }}">
            <td class="dash-table__cell--title">{{ $title }}</td>
            <td style="font-size:.82rem;color:var(--text-muted-day)">{{ $sheikh }}</td>
            <td><span class="dash-badge" style="background:rgba(4,95,114,0.08);color:var(--primary)">{{ $cat }}</span></td>
            <td>
              @if($approvalVal === 'approved')
                <span class="dash-badge dash-badge--published"><span class="dash-badge__dot"></span>{{ $approvalLabel }}</span>
              @elseif($approvalVal === 'pending')
                <span class="dash-badge dash-badge--pending"><span class="dash-badge__dot"></span>{{ $approvalLabel }}</span>
              @else
                <span class="dash-badge dash-badge--rejected"><span class="dash-badge__dot"></span>{{ $approvalLabel }}</span>
              @endif
            </td>
            <td><span class="dash-badge dash-badge--{{ $statusVal }}"><span class="dash-badge__dot"></span>{{ $statusLabel }}</span></td>
            <td>
              <div class="dash-row-actions">
                <button type="button" class="dash-btn--edit"
                        @click="$dispatch('open-edit', {
                          id: {{ $id }}, title: '{{ addslashes($title) }}', createdAt: '{{ $date }}',
                          fields: [
                            { label:'عنوان الرد', name:'title', type:'text', value:'{{ addslashes($title) }}' },
                            { label:'الشيخ الراد', name:'sheikh', type:'select', value:'{{ $sheikh }}',
                              options:[{value:'الشيخ يحيى الحجوري',label:'الشيخ يحيى الحجوري'},{value:'الشيخ عبد العزيز',label:'الشيخ عبد العزيز'},{value:'الشيخ محمد الغامدي',label:'الشيخ محمد الغامدي'}] },
                            { label:'التصنيف', name:'category', type:'select', value:'{{ $cat }}',
                              options:[{value:'البدع',label:'الردود على البدع'},{value:'الفرق',label:'الردود على الفرق'},{value:'الشبهات',label:'الردود على الشبهات'},{value:'الإلحاد',label:'الردود على الإلحاد'}] },
                            { label:'حالة الاعتماد', name:'approval', type:'select', value:'{{ $approvalVal }}',
                              options:[{value:'pending',label:'قيد المراجعة'},{value:'approved',label:'معتمد'},{value:'rejected',label:'مرفوض'}] },
                            { label:'حالة النشر', name:'status', type:'select', value:'{{ $statusVal }}',
                              options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}] }
                          ]
                        })">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  تعديل
                </button>
                <button type="button" class="dash-btn--delete" @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($title) }}'})">
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
      @foreach($refutations as [$id,$title,$sheikh,$cat,$approvalVal,$approvalLabel,$statusVal,$statusLabel,$date])
        <div class="dash-mobile-row" data-row-id="{{ $id }}">
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $title }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $sheikh }}</span>
              <span class="dash-mobile-row__meta-item"><span class="dash-badge dash-badge--{{ $approvalVal }}" style="font-size:.65rem"><span class="dash-badge__dot"></span>{{ $approvalLabel }}</span></span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button" class="dash-btn--edit"
                    @click="$dispatch('open-edit',{id:{{ $id }},title:'{{ addslashes($title) }}',fields:[{label:'عنوان الرد',name:'title',type:'text',value:'{{ addslashes($title) }}'},{label:'حالة النشر',name:'status',type:'select',value:'{{ $statusVal }}',options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}]}]})">
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

  <x-dashboard.edit-panel formAction="/admin/refutations" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>
<script>
function refutationsPage() { return { showForm: false, tableQuery: '', filterApproval: 'الكل' } }
</script>
@endsection