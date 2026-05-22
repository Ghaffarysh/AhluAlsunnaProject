{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.dashboard')
@section('title', 'المستخدمون')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">المستخدمون</span>
@endsection

@section('content')
<div x-data="usersPage()">

  {{-- Header --}}
  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">إدارة المستخدمين</h1>
      <p class="dash-page-header__sub">حسابات الفريق الإداري — إضافة وتحديد الأدوار والصلاحيات</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="showForm = !showForm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        <span x-text="showForm ? 'إخفاء النموذج' : 'إضافة مستخدم'"></span>
      </button>
    </div>
  </div>

  {{-- Add Form --}}
  <div x-show="showForm" x-transition style="margin-bottom:1.5rem">
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">إضافة مستخدم جديد</h2>
      </div>
      <form method="POST" action="#" x-data="{ showPass: false, role: 'admin' }">
        @csrf
        <div class="dash-form-card__body">

          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">الاسم الكامل <span style="color:#c0392b;font-size:.72rem">*</span></label>
              <input type="text" class="dash-input" placeholder="مثال: أحمد المنصوري" required>
            </div>
            <div class="dash-field">
              <label class="dash-label">البريد الإلكتروني <span style="color:#c0392b;font-size:.72rem">*</span></label>
              <input type="email" class="dash-input" placeholder="admin@mawsoa.com" required>
            </div>
          </div>

          <div class="dash-field">
            <label class="dash-label">كلمة المرور</label>
            <div style="display:flex;gap:8px;align-items:center">
              <div class="dash-password-wrap" style="flex:1">
                <input :type="showPass ? 'text' : 'password'" class="dash-input"
                       x-ref="passInput" value="Mawsoa@2025!">
                <button type="button" class="dash-password-toggle" @click="showPass = !showPass">
                  <svg x-show="!showPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                  </svg>
                  <svg x-show="showPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                    <line x1="1" y1="1" x2="23" y2="23"/>
                  </svg>
                </button>
              </div>
              <button type="button" class="dash-copy-btn"
                      @click="navigator.clipboard.writeText($refs.passInput.value); $el.textContent = 'تم ✓'">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="9" y="9" width="13" height="13" rx="2"/>
                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                </svg>
                نسخ
              </button>
              <button type="button" class="dash-btn dash-btn--ghost dash-btn--sm"
                      @click="$refs.passInput.value = 'Mawsoa' + Math.random().toString(36).slice(-6).toUpperCase() + '1' + String.fromCharCode(64)">
                توليد تلقائي
              </button>
            </div>
          </div>

          <div class="dash-field__row">
            <div class="dash-field">
              <label class="dash-label">الدور</label>
              <select class="dash-select" x-model="role">
                <option value="admin">Admin</option>
                <option value="general_admin">General Admin</option>
              </select>
            </div>
            <div class="dash-field">
              <label class="dash-label">حالة الحساب</label>
              <select class="dash-select">
                <option value="active">نشط</option>
                <option value="inactive">معطّل</option>
              </select>
            </div>
          </div>

          <div x-show="role === 'admin'" x-transition>
            <div class="dash-field">
              <label class="dash-label">الصلاحيات التفصيلية</label>
              <div style="background:var(--bg-day);border:1px solid var(--border-day);border-radius:10px;padding:1rem">
                <p style="font-size:.73rem;font-weight:700;color:var(--text-muted-day);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.625rem">المحتوى</p>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:6px;margin-bottom:.875rem">
                  @foreach(['إدارة المقررات','إدارة الدروس','إدارة الخطب','إدارة المحاضرات','إدارة الردود','إدارة المكتبة'] as $perm)
                    <label class="dash-checkbox-item">
                      <input type="checkbox" class="dash-checkbox-item__input" checked>
                      <span class="dash-checkbox-item__label">{{ $perm }}</span>
                    </label>
                  @endforeach
                </div>
                <p style="font-size:.73rem;font-weight:700;color:var(--text-muted-day);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.625rem">أخرى</p>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:6px">
                  @foreach(['إدارة الفتاوى','إضافة الشيوخ','إرسال الإشعارات'] as $perm)
                    <label class="dash-checkbox-item">
                      <input type="checkbox" class="dash-checkbox-item__input">
                      <span class="dash-checkbox-item__label">{{ $perm }}</span>
                    </label>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="dash-form-card__footer">
          <button type="button" class="dash-btn dash-btn--ghost" @click="showForm=false">إلغاء</button>
          <button type="submit" class="dash-btn dash-btn--primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            إنشاء الحساب
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
               placeholder="ابحث باسم أو بريد المستخدم...">
      </div>
      <div class="dash-filter-chips" style="padding:0">
        @foreach(['الكل','Admin','General Admin','نشط','معطّل'] as $chip)
          <button class="dash-filter-chip"
                  :class="activeChip === '{{ $chip }}' ? 'dash-filter-chip--active' : ''"
                  @click="activeChip = '{{ $chip }}'">{{ $chip }}</button>
        @endforeach
      </div>
      <span class="dash-table-count" style="margin-right:auto">إجمالي: <strong>٥</strong> مستخدمين</span>
    </div>

    {{-- Desktop --}}
    <div class="dash-table-desktop">
      <table class="dash-table">
        <thead>
          <tr>
            <th>المستخدم</th>
            <th>الدور</th>
            <th>المحتويات المضافة</th>
            <th>آخر دخول</th>
            <th>الحالة</th>
            <th style="width:130px"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $users = [
            [1,'م','محمد العدني',    'super_admin@mawsoa.com','Super Admin',  '٢٤٧','الآن',        'active',  'نشط'],
            [2,'أ','أحمد المنصوري','a.mansouri@mawsoa.com', 'General Admin','—',  'منذ ساعتين', 'active',  'نشط'],
            [3,'خ','خالد السالم',  'k.salem@mawsoa.com',    'Admin',        '٨٩', 'أمس',         'active',  'نشط'],
            [4,'ف','فاطمة الزهراء','f.zahraa@mawsoa.com',  'Admin',        '١٣٤','منذ ٣ أيام',  'active',  'نشط'],
            [5,'ع','عبد الله الحربي','a.harbi@mawsoa.com',  'Admin',        '٤٢', 'منذ أسبوعين','inactive','معطّل'],
          ];
          @endphp

          @foreach($users as [$id,$initial,$name,$email,$role,$added,$lastLogin,$statusVal,$statusLabel])
          <tr data-row-id="{{ $id }}">
            <td>
              <div style="display:flex;align-items:center;gap:10px">
                <div style="width:34px;height:34px;border-radius:9px;background:rgba(4,95,114,0.1);
                             color:var(--primary);display:flex;align-items:center;justify-content:center;
                             font-weight:700;font-size:.85rem;flex-shrink:0;font-family:'ThmanyahSerifDisplay',serif">
                  {{ $initial }}
                </div>
                <div>
                  <p style="font-size:.87rem;font-weight:600;color:var(--text-day);margin-bottom:1px">{{ $name }}</p>
                  <p style="font-size:.73rem;color:var(--text-muted-day)">{{ $email }}</p>
                </div>
              </div>
            </td>
            <td>
              @if($role === 'Super Admin')
                <span class="dash-badge" style="background:rgba(4,95,114,0.1);color:var(--primary)">
                  <span class="dash-badge__dot"></span>{{ $role }}
                </span>
              @elseif($role === 'General Admin')
                <span class="dash-badge dash-badge--pending"><span class="dash-badge__dot"></span>{{ $role }}</span>
              @else
                <span class="dash-badge dash-badge--draft"><span class="dash-badge__dot"></span>{{ $role }}</span>
              @endif
            </td>
            <td style="font-size:.84rem;font-weight:{{ $role !== 'General Admin' ? '600' : '400' }};
                        color:{{ $role === 'General Admin' ? 'var(--text-muted-day)' : 'var(--text-day)' }}">
              {{ $added }}
            </td>
            <td style="font-size:.8rem;color:var(--text-muted-day)">{{ $lastLogin }}</td>
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
                          title: '{{ addslashes($name) }}',
                          createdAt: '—',
                          fields: [
                            { label:'الاسم الكامل', name:'name', type:'text', value:'{{ addslashes($name) }}' },
                            { label:'البريد الإلكتروني', name:'email', type:'email', value:'{{ $email }}' },
                            { label:'الدور', name:'role', type:'select', value:'{{ Str::snake($role) }}',
                              options:[
                                {value:'admin',label:'Admin'},
                                {value:'general_admin',label:'General Admin'}
                              ]
                            },
                            { label:'حالة الحساب', name:'status', type:'select', value:'{{ $statusVal }}',
                              options:[{value:'active',label:'نشط'},{value:'inactive',label:'معطّل'}]
                            }
                          ]
                        })">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                  تعديل
                </button>
                @if($role !== 'Super Admin')
                <button type="button" class="dash-btn--delete"
                        @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($name) }}'})"
                        title="حذف">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                       stroke-width="2" stroke-linecap="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                  </svg>
                </button>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Mobile --}}
    <div class="dash-table-mobile">
      @foreach($users as [$id,$initial,$name,$email,$role,$added,$lastLogin,$statusVal,$statusLabel])
        <div class="dash-mobile-row" data-row-id="{{ $id }}">
          <div style="width:36px;height:36px;border-radius:9px;background:rgba(4,95,114,0.1);
                       color:var(--primary);display:flex;align-items:center;justify-content:center;
                       font-weight:700;font-size:.9rem;flex-shrink:0">{{ $initial }}</div>
          <div class="dash-mobile-row__main">
            <p class="dash-mobile-row__title">{{ $name }}</p>
            <div class="dash-mobile-row__meta">
              <span class="dash-mobile-row__meta-item">{{ $role }}</span>
              <span class="dash-mobile-row__meta-item">
                <span class="dash-badge dash-badge--{{ $statusVal }}" style="font-size:.65rem">
                  <span class="dash-badge__dot"></span>{{ $statusLabel }}
                </span>
              </span>
            </div>
          </div>
          <div class="dash-mobile-row__actions">
            <button type="button" class="dash-btn--edit"
                    @click="$dispatch('open-edit',{
                      id:{{ $id }}, title:'{{ addslashes($name) }}',
                      fields:[
                        {label:'الاسم الكامل',name:'name',type:'text',value:'{{ addslashes($name) }}'},
                        {label:'البريد',name:'email',type:'email',value:'{{ $email }}'},
                        {label:'الدور',name:'role',type:'select',value:'{{ Str::snake($role) }}',
                          options:[{value:'admin',label:'Admin'},{value:'general_admin',label:'General Admin'}]},
                        {label:'الحالة',name:'status',type:'select',value:'{{ $statusVal }}',
                          options:[{value:'active',label:'نشط'},{value:'inactive',label:'معطّل'}]}
                      ]
                    })">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
              </svg>
              تعديل
            </button>
            @if($role !== 'Super Admin')
            <button type="button" class="dash-btn--delete"
                    @click="$dispatch('open-delete',{id:{{ $id }},name:'{{ addslashes($name) }}'})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
              </svg>
            </button>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <x-dashboard.edit-panel formAction="/admin/users" />
  <x-dashboard.confirm-delete-modal />
  <x-dashboard.details-modal-mobile />

</div>

<script>
function usersPage() {
  return { showForm: false, tableQuery: '', activeChip: 'الكل' }
}
</script>
@endsection