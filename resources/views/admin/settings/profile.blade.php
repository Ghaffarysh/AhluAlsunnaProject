@extends('layouts.dashboard')
@section('title', 'حسابي')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">حسابي</span>
@endsection
@section('content')
<div x-data="{ showCurrentPass: false, showNewPass: false, showConfirmPass: false, saved: false }">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">حسابي</h1>
      <p class="dash-page-header__sub">إعدادات حسابك الشخصي وكلمة المرور</p>
    </div>
  </div>

  {{-- Saved feedback --}}
  <div x-show="saved" x-transition class="dash-alert dash-alert--info" style="margin-bottom:1.25rem">
    <div class="dash-alert__icon">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="20 6 9 17 4 12"/>
      </svg>
    </div>
    <div class="dash-alert__body">
      <p class="dash-alert__title">تم تحديث بياناتك بنجاح</p>
    </div>
  </div>

  <div class="dash-grid-2">

    {{-- Profile info --}}
    <div class="dash-form-card" style="margin-bottom:0">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
          المعلومات الشخصية
        </h2>
      </div>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="dash-form-card__body">

          {{-- Avatar --}}
          <div style="display:flex;align-items:center;gap:1rem;padding:.5rem 0">
            <div style="width:64px;height:64px;border-radius:14px;background:rgba(4,95,114,0.1);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:1.75rem;font-weight:700;font-family:'ThmanyahSerifDisplay',serif;flex-shrink:0">
              م
            </div>
            <div>
              <p style="font-size:.87rem;font-weight:600;color:var(--text-day);margin-bottom:4px">محمد العدني</p>
              <label class="dash-btn dash-btn--ghost dash-btn--sm" style="cursor:pointer">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                  <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                تغيير الصورة
                <input type="file" accept="image/*" style="display:none">
              </label>
            </div>
          </div>

          <div class="dash-field">
            <label class="dash-label">الاسم الكامل</label>
            <input type="text" class="dash-input" value="محمد العدني">
          </div>

          <div class="dash-field">
            <label class="dash-label">البريد الإلكتروني</label>
            <input type="email" class="dash-input" value="super_admin@mawsoa.com">
          </div>

          <div class="dash-field">
            <label class="dash-label">الدور الحالي</label>
            <div style="display:flex;align-items:center;gap:8px;padding:10px 12px;border:1px solid var(--border-day);border-radius:9px;background:var(--bg-day)">
              <span class="dash-badge" style="background:rgba(4,95,114,0.1);color:var(--primary)">
                <span class="dash-badge__dot"></span>Super Admin
              </span>
              <span style="font-size:.76rem;color:var(--text-muted-day)">— لا يمكن تغييره من هنا</span>
            </div>
          </div>

        </div>
        <div class="dash-form-card__footer">
          <button type="submit" class="dash-btn dash-btn--primary"
                  @click.prevent="saved=true; setTimeout(()=>saved=false,2500)">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            حفظ التغييرات
          </button>
        </div>
      </form>
    </div>

    {{-- Password change --}}
    <div class="dash-form-card" style="margin-bottom:0">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
          تغيير كلمة المرور
        </h2>
      </div>
      <form method="POST" action="#">
        @csrf @method('PUT')
        <div class="dash-form-card__body">

          <div class="dash-field">
            <label class="dash-label">كلمة المرور الحالية</label>
            <div class="dash-password-wrap">
              <input :type="showCurrentPass ? 'text' : 'password'" class="dash-input" placeholder="أدخل كلمة المرور الحالية">
              <button type="button" class="dash-password-toggle" @click="showCurrentPass = !showCurrentPass">
                <svg x-show="!showCurrentPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
                <svg x-show="showCurrentPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                  <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                  <line x1="1" y1="1" x2="23" y2="23"/>
                </svg>
              </button>
            </div>
          </div>

          <div class="dash-field">
            <label class="dash-label">كلمة المرور الجديدة</label>
            <div class="dash-password-wrap">
              <input :type="showNewPass ? 'text' : 'password'" class="dash-input" placeholder="٨ أحرف على الأقل">
              <button type="button" class="dash-password-toggle" @click="showNewPass = !showNewPass">
                <svg x-show="!showNewPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
                <svg x-show="showNewPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                  <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                  <line x1="1" y1="1" x2="23" y2="23"/>
                </svg>
              </button>
            </div>
          </div>

          <div class="dash-field">
            <label class="dash-label">تأكيد كلمة المرور</label>
            <div class="dash-password-wrap">
              <input :type="showConfirmPass ? 'text' : 'password'" class="dash-input" placeholder="أعد كتابة كلمة المرور الجديدة">
              <button type="button" class="dash-password-toggle" @click="showConfirmPass = !showConfirmPass">
                <svg x-show="!showConfirmPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
                <svg x-show="showConfirmPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                  <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                  <line x1="1" y1="1" x2="23" y2="23"/>
                </svg>
              </button>
            </div>
          </div>

          {{-- Password requirements --}}
          <div style="background:var(--bg-day);border:1px solid var(--border-day);border-radius:9px;padding:.875rem;font-size:.76rem;color:var(--text-muted-day);line-height:2">
            <p style="font-weight:600;margin-bottom:4px;color:var(--text-day)">متطلبات كلمة المرور:</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:2px 1rem">
              <span>✓ ٨ أحرف على الأقل</span>
              <span>✓ حرف كبير واحد</span>
              <span>✓ رقم واحد</span>
              <span>✓ رمز خاص (@, !, #...)</span>
            </div>
          </div>

        </div>
        <div class="dash-form-card__footer">
          <button type="submit" class="dash-btn dash-btn--primary"
                  @click.prevent="saved=true; setTimeout(()=>saved=false,2500)">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            تغيير كلمة المرور
          </button>
        </div>
      </form>
    </div>

  </div>

</div>
@endsection