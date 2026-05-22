{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'التصنيفات')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">التصنيفات</span>
@endsection

@section('content')
<div x-data="categoriesPage()">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">إدارة التصنيفات</h1>
      <p class="dash-page-header__sub">تصنيفات المقررات والفتاوى والردود والخطب وأنواع الكتب</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة تصنيف'"></span>
      </button>
    </div>
  </div>

  {{-- Tabs --}}
  <div class="dash-section-card">
    <div class="dash-tabs">
      @php $tabs = [
        'curricula'   => 'تخصصات المقررات',
        'fatwas'      => 'تصنيفات الفتاوى',
        'refutations' => 'تصنيفات الردود',
        'sermons'     => 'تصنيفات الخطب',
        'books'       => 'أنواع الكتب',
      ]; @endphp
      @foreach($tabs as $id => $label)
        <button class="dash-tab"
                :class="activeTab === '{{ $id }}' ? 'dash-tab--active' : ''"
                @click="activeTab = '{{ $id }}'">
          {{ $label }}
        </button>
      @endforeach
    </div>

    <div style="padding:1.25rem">

      {{-- Add form --}}
      <div x-show="showForm" x-transition style="margin-bottom:1.25rem">
        <div class="dash-form-card">
          <div class="dash-form-card__header">
            <h2 class="dash-form-card__title">إضافة تصنيف جديد</h2>
          </div>
          <form method="POST" action="#">
            @csrf
            <div class="dash-form-card__body">
              <div class="dash-field__row">
                <div class="dash-field">
                  <label class="dash-label">اسم التصنيف <span style="color:#c0392b;font-size:.72rem">*</span></label>
                  <input type="text" class="dash-input" placeholder="مثال: عقيدة" required>
                </div>
                <div class="dash-field">
                  <label class="dash-label">اللون المميز</label>
                  <input type="color" class="dash-input" value="#045f72" style="height:44px;padding:4px 8px">
                </div>
              </div>
            </div>
            <div class="dash-form-card__footer">
              <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
              <button type="submit" class="dash-btn dash-btn--primary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                حفظ
              </button>
            </div>
          </form>
        </div>
      </div>

      {{-- Categories table --}}
      @php
      $allCategories = [
        'curricula'   => [
          [1,'عقيدة',   '#045f72', 124],
          [2,'فقه',     '#3d7a50', 98],
          [3,'حديث',    '#b19346', 76],
          [4,'تفسير',   '#6e4682', 44],
          [5,'لغة',     '#3c648c', 31],
          [6,'أخلاق',   '#7a4d8c', 58],
        ],
        'fatwas'      => [[7,'عقيدة','#045f72',210],[8,'فقه','#3d7a50',184],[9,'معاملات','#3c648c',96],[10,'أسرة','#6e4682',74],[11,'أخلاق','#7a4d8c',58]],
        'refutations' => [[12,'الردود على البدع','#045f72',48],[13,'الفرق الضالة','#7a4d8c',37],[14,'الشبهات','#3d7a50',52],[15,'الإلحاد','#3c648c',34],[16,'الفتن المعاصرة','#b19346',29]],
        'sermons'     => [[17,'عقيدة','#045f72',87],[18,'فقه','#3d7a50',64],[19,'أخلاق','#7a4d8c',93],[20,'أحداث معاصرة','#b19346',41]],
        'books'       => [[21,'متن','#045f72',34],[22,'شرح','#3d7a50',28],[23,'مرجع','#6e4682',18],[24,'رسالة','#b19346',9]],
      ];
      @endphp

      @foreach($allCategories as $tabId => $categories)
        <div x-show="activeTab === '{{ $tabId }}'">
          <table class="dash-table" style="border:1px solid var(--border-day);border-radius:10px;overflow:hidden">
            <thead>
              <tr>
                <th>اسم التصنيف</th>
                <th>اللون</th>
                <th>عدد العناصر</th>
                <th style="width:100px"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as [$id,$name,$color,$count])
              <tr data-row-id="{{ $id }}">
                <td>
                  <div style="display:flex;align-items:center;gap:10px">
                    <span style="width:12px;height:12px;border-radius:50%;background:{{ $color }};flex-shrink:0;box-shadow:0 0 0 3px {{ $color }}22"></span>
                    <span style="font-size:.86rem;font-weight:500;color:var(--text-day)">{{ $name }}</span>
                  </div>
                </td>
                <td>
                  <code style="font-size:.75rem;color:var(--text-muted-day);background:var(--bg-day);
                                padding:2px 7px;border-radius:5px;border:1px solid var(--border-day)">
                    {{ $color }}
                  </code>
                </td>
                <td style="font-size:.88rem;font-weight:700;color:var(--text-day)">{{ $count }}</td>
                <td>
                  <div class="dash-row-actions">
                    <button type="button" class="dash-btn--edit"
                            @click="$dispatch('open-edit', {
                              id: {{ $id }},
                              title: '{{ addslashes($name) }}',
                              fields: [
                                { label:'اسم التصنيف', name:'name', type:'text', value:'{{ addslashes($name) }}' },
                                { label:'اللون المميز', name:'color', type:'color', value:'{{ $color }}' }
                              ]
                            })">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                      </svg>
                      تعديل
                    </button>
                    <button type="button" class="dash-btn--delete"
                            @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($name) }}'})">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
      @endforeach

    </div>
  </div>

  <x-dashboard.edit-panel formAction="/admin/categories" />
  <x-dashboard.confirm-delete-modal />

</div>

<script>
function categoriesPage() {
  return { showForm: false, activeTab: 'curricula' }
}
</script>
@endsection