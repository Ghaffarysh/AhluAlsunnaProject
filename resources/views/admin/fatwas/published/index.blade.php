{{-- resources/views/admin/fatwas/published/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'الفتاوى المنشورة')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">الفتاوى المنشورة</span>
@endsection

@section('content')
<div x-data="publishedFatwasPage()">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">الفتاوى المنشورة</h1>
      <p class="dash-page-header__sub">إدارة الفتاوى المنشورة وإضافة فتاوى جديدة يدوياً</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة فتوى'"></span>
      </button>
    </div>
  </div>

  {{-- Add Form --}}
  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">إضافة فتوى جديدة يدوياً</h2>
      </div>
      <form method="POST" action="#">
        @csrf
        <div class="dash-form-card__body">
          <div class="dash-field">
            <label class="dash-label">السؤال الكامل <span style="color:#c0392b;font-size:.72rem">*</span></label>
            <textarea class="dash-textarea" rows="3" placeholder="نص السؤال كاملاً..." required></textarea>
          </div>
          <div class="dash-field">
            <label class="dash-label">الجواب — الحكم ثم الدليل ثم التفصيل</label>
            <div class="dash-richtext">
              <div class="dash-richtext__toolbar">
                <button type="button" class="dash-richtext__toolbar-btn"><b>ع</b></button>
                <button type="button" class="dash-richtext__toolbar-btn"><i>م</i></button>
                <button type="button" class="dash-richtext__toolbar-btn">H1</button>
                <button type="button" class="dash-richtext__toolbar-btn">H2</button>
              </div>
              <div class="dash-richtext__content" contenteditable="true"
                   placeholder="الحكم: ... ← الدليل: ... ← التفصيل: ..."></div>
            </div>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">المفتي</label>
              <select class="dash-select">
                <option value="">اختر المفتي...</option>
                @foreach(['الشيخ يحيى الحجوري','الشيخ عبد العزيز','الشيخ محمد الغامدي','الشيخ صالح الفوزان'] as $s)
                  <option>{{ $s }}</option>
                @endforeach
              </select>
            </div>
            <div class="dash-field">
              <label class="dash-label">التصنيف</label>
              <select class="dash-select">
                <option value="">اختر التصنيف...</option>
                @foreach(['عقيدة','فقه','معاملات','أسرة','أخلاق']) as $t)
                  <option>{{ $t }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">تاريخ الفتوى</label>
              <input type="date" class="dash-input">
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
            حفظ ونشر
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
               placeholder="ابحث في الفتاوى...">
      </div>
      <div class="dash-filter-chips" style="padding:0">
        @foreach(['الكل','عقيدة','فقه','معاملات','أسرة'] as $chip)
          <button class="dash-filter-chip"
                  :class="filterTopic==='{{ $chip }}' ? 'dash-filter-chip--active':''"
                  @click="filterTopic='{{ $chip }}'">{{ $chip }}</button>
        @endforeach
      </div>
      <span class="dash-table-count" style="margin-right:auto">إجمالي: <strong>٥٢٣</strong> فتوى</span>
    </div>

    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr>
            <th>السؤال</th>
            <th>المفتي</th>
            <th>التصنيف</th>
            <th>تاريخ النشر</th>
            <th>النشر</th>
            <th style="width:120px"></th>
          </tr>
        </thead>
        <tbody>
          @php $fatwas = [
            [1,'حكم قراءة القرآن من الهاتف المحمول دون وضوء','الشيخ يحيى الحجوري','فقه',      '٢ يناير ٢٠٢٥','published','منشور'],
            [2,'هل يجوز صيام يوم الشك؟',                    'الشيخ عبد العزيز',  'فقه',      '٥ يناير ٢٠٢٥','published','منشور'],
            [3,'حكم الصلاة خلف إمام مبتدع',                 'الشيخ يحيى الحجوري','عقيدة',    '٨ يناير ٢٠٢٥','draft',    'مسودة'],
            [4,'ما حكم العقود الآجلة في الذهب',             'الشيخ محمد الغامدي','معاملات',  '١٢ يناير ٢٠٢٥','published','منشور'],
            [5,'حكم تهنئة غير المسلمين بأعيادهم',           'الشيخ يحيى الحجوري','أخلاق',    '١٥ يناير ٢٠٢٥','published','منشور'],
          ]; @endphp

          @foreach($fatwas as [$id,$question,$mufti,$topic,$date,$statusVal,$statusLabel])
          <tr data-row-id="{{ $id }}">
            <td class="dash-table__cell--title" style="max-width:260px">{{ $question }}</td>
            <td style="font-size:.82rem;color:var(--text-muted-day);white-space:nowrap">{{ $mufti }}</td>
            <td><span class="dash-badge" style="background:rgba(4,95,114,0.08);color:var(--primary)">{{ $topic }}</span></td>
            <td style="font-size:.78rem;color:var(--text-muted-day);white-space:nowrap">{{ $date }}</td>
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
                          title: '{{ Str::limit(addslashes($question), 30) }}',
                          createdAt: '{{ $date }}',
                          fields: [
                            { label:'السؤال', name:'question', type:'textarea', value:'{{ addslashes($question) }}', rows:3 },
                            { label:'المفتي', name:'mufti', type:'select', value:'{{ $mufti }}',
                              options:[
                                {value:'الشيخ يحيى الحجوري',label:'الشيخ يحيى الحجوري'},
                                {value:'الشيخ عبد العزيز',label:'الشيخ عبد العزيز'},
                                {value:'الشيخ محمد الغامدي',label:'الشيخ محمد الغامدي'},
                                {value:'الشيخ صالح الفوزان',label:'الشيخ صالح الفوزان'}
                              ]
                            },
                            { label:'التصنيف', name:'topic', type:'select', value:'{{ $topic }}',
                              options:[
                                {value:'عقيدة',label:'عقيدة'},{value:'فقه',label:'فقه'},
                                {value:'معاملات',label:'معاملات'},{value:'أسرة',label:'أسرة'},{value:'أخلاق',label:'أخلاق'}
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
                <button type="button" class="dash-btn--delete"
                        @click="$dispatch('open-delete',{id:{{ $id }},name:'فتوى رقم {{ $id }}'})"
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

    <div class="dash-table-mobile">
      @foreach($fatwas as [$id,$question,$mufti,$topic,$date,$statusVal,$statusLabel])
        <div class="dash-mobile-row" data-row-id="{{ $id }}">
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ Str::limit($question, 55) }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $mufti }}</span>
              <span class="dash-mobile-row__meta-item">
                <span class="dash-badge dash-badge--{{ $statusVal }}" style="font-size:.65rem">
                  <span class="dash-badge__dot"></span>{{ $statusLabel }}
                </span>
              </span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button" class="dash-btn--edit"
                    @click="$dispatch('open-edit',{id:{{ $id }},title:'فتوى رقم {{ $id }}',fields:[
                      {label:'المفتي',name:'mufti',type:'select',value:'{{ $mufti }}',options:[{value:'الشيخ يحيى الحجوري',label:'الشيخ يحيى الحجوري'},{value:'الشيخ عبد العزيز',label:'الشيخ عبد العزيز'},{value:'الشيخ محمد الغامدي',label:'الشيخ محمد الغامدي'}]},
                      {label:'حالة النشر',name:'status',type:'select',value:'{{ $statusVal }}',options:[{value:'draft',label:'مسودة'},{value:'published',label:'منشور'}]}
                    ]})">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
              </svg>
              تعديل
            </button>
            <button type="button" class="dash-btn--delete"
                    @click="$dispatch('open-delete',{id:{{ $id }},name:'فتوى رقم {{ $id }}'})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
              </svg>
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <x-dashboard.edit-panel formAction="/admin/fatwas/published" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>

<script>
function publishedFatwasPage() {
  return { showForm: false, tableQuery: '', filterTopic: 'الكل' }
}
</script>
@endsection