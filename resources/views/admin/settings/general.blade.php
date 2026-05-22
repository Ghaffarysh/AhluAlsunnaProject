@extends('layouts.dashboard')
@section('title', 'الإعدادات العامة')
@section('breadcrumb')
  <span class="dash-breadcrumb__sep">‹</span>
  <span class="dash-breadcrumb__current">الإعدادات العامة</span>
@endsection
@section('content')
<div x-data="{ saved: false }">

  <div class="dash-page-header">
    <div class="dash-page-header__text">
      <h1 class="dash-page-header__title">الإعدادات العامة</h1>
      <p class="dash-page-header__sub">إعدادات الموقع الأساسية — تؤثر على كل ما يراه الزوار</p>
    </div>
    <div class="dash-page-header__actions">
      <button class="dash-btn dash-btn--primary" @click="saved=true; setTimeout(()=>saved=false,2500)">
        <svg x-show="!saved" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
        <svg x-show="saved" width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
        <span x-text="saved ? 'تم الحفظ ✓' : 'حفظ الإعدادات'"></span>
      </button>
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
      <p class="dash-alert__title">تم حفظ الإعدادات بنجاح</p>
      <p class="dash-alert__desc">التغييرات ستظهر على الموقع فوراً</p>
    </div>
  </div>

  <div class="dash-grid-2">
    {{-- Card 1: Site identity --}}
    <div class="dash-form-card" style="margin-bottom:0">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          هوية الموقع
        </h2>
      </div>
      <div class="dash-form-card__body">
        <div class="dash-field">
          <label class="dash-label">اسم الموقع <span style="color:#c0392b;font-size:.72rem">*</span></label>
          <input type="text" class="dash-input" value="مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ">
        </div>
        <div class="dash-field">
          <label class="dash-label">الوصف العام</label>
          <textarea class="dash-textarea" rows="3">الموسوعة العلمية الشاملة لمحتوى أهل السنة والجماعة — مقررات ودروس وفتاوى وكتب ومحاضرات.</textarea>
        </div>
        <div class="dash-field__row">
          <div class="dash-field">
            <label class="dash-label">شعار الموقع (Logo)</label>
            <label class="dash-file-upload">
              <div class="dash-file-upload__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                  <polyline points="21 15 16 10 5 21"/>
                </svg>
              </div>
              <span class="dash-file-upload__label">الشعار الحالي: logo.svg</span>
              <input type="file" accept="image/*" style="display:none">
            </label>
          </div>
          <div class="dash-field">
            <label class="dash-label">Favicon</label>
            <label class="dash-file-upload">
              <div class="dash-file-upload__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                  <polyline points="21 15 16 10 5 21"/>
                </svg>
              </div>
              <span class="dash-file-upload__label">favicon.ico</span>
              <input type="file" accept=".ico,image/*" style="display:none">
            </label>
          </div>
        </div>
      </div>
    </div>

    {{-- Card 2: Contact info --}}
    <div class="dash-form-card" style="margin-bottom:0">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.56 1.32h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.03z"/>
          </svg>
          بيانات التواصل
        </h2>
      </div>
      <div class="dash-form-card__body">
        <div class="dash-field">
          <label class="dash-label">البريد الإلكتروني الرسمي</label>
          <input type="email" class="dash-input" value="info@mawsoa.com">
        </div>
        <div class="dash-field">
          <label class="dash-label">رابط تيليغرام <span class="dash-label__optional">(اختياري)</span></label>
          <input type="url" class="dash-input" placeholder="https://t.me/...">
        </div>
        <div class="dash-field">
          <label class="dash-label">رابط يوتيوب <span class="dash-label__optional">(اختياري)</span></label>
          <input type="url" class="dash-input" placeholder="https://youtube.com/@...">
        </div>
      </div>
    </div>
  </div>

  <div style="margin-top:1.5rem">
    {{-- Card 3: System messages --}}
    <div class="dash-form-card">
      <div class="dash-form-card__header">
        <h2 class="dash-form-card__title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
          رسائل النظام
        </h2>
      </div>
      <div class="dash-form-card__body">
        <div class="dash-field">
          <label class="dash-label">رسالة الترحيب بالزوار</label>
          <textarea class="dash-textarea" rows="2">أهلاً بك في موسوعة أهل السنة والجماعة — نسأل الله أن ينفعك بما تجد هنا.</textarea>
          <p style="font-size:.72rem;color:var(--text-muted-day);margin-top:4px">تظهر في الصفحة الرئيسية تحت العنوان مباشرةً</p>
        </div>
        <div class="dash-field">
          <label class="dash-label">رسالة نجاح إرسال سؤال الفتوى</label>
          <textarea class="dash-textarea" rows="2">جزاك الله خيراً — سؤالك في طريقه للمراجعة. إليك فتاوى مشابهة بينما تنتظر.</textarea>
          <p style="font-size:.72rem;color:var(--text-muted-day);margin-top:4px">Peak-End Rule — هذه اللحظة هي ذاكرة الزائر عن الموقع</p>
        </div>
      </div>
      <div class="dash-form-card__footer">
        <button type="button" class="dash-btn dash-btn--ghost" onclick="location.reload()">إعادة ضبط</button>
        <button type="button" class="dash-btn dash-btn--primary" @click="saved=true; setTimeout(()=>saved=false,2500)">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          حفظ الإعدادات
        </button>
      </div>
    </div>
  </div>

</div>
@endsection