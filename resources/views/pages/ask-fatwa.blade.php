@extends('layouts.app')
@section('content')

{{-- ask-fatwa.blade.php | prefix: askfatwa- --}}
<div class="shared-page" x-data="askFatwaPage()">
  <div class="shared-inner--narrow" style="padding-top:2.5rem;padding-bottom:4rem">

    {{-- Breadcrumb --}}
    <nav style="margin-bottom:2rem">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/fatwas" class="shared-breadcrumb__link">الفتاوى</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><span class="shared-breadcrumb__current">إرسال سؤال</span></li>
      </ol>
    </nav>

    {{-- Success state --}}
    <div x-show="submitted" x-transition class="askfatwa-success">
      <div class="askfatwa-success__icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <h2 class="askfatwa-success__title">جزاك الله خيراً</h2>
      <p class="askfatwa-success__sub">سؤالك في طريقه للمراجعة — سيُنشر الجواب وتُشعَر به إن أضفت بريدك.</p>
      <div class="askfatwa-success__links">
        <a href="/fatwas" class="shared-btn-primary" style="font-size:.85rem">تصفح الفتاوى</a>
        <button @click="submitted=false;resetForm()" class="shared-btn-outline" style="font-size:.85rem">إرسال سؤال آخر</button>
      </div>
    </div>

    {{-- Form --}}
    <div x-show="!submitted">
      <div class="askfatwa-header">
        <h1 class="askfatwa-header__title">اسأل سؤالاً شرعياً</h1>
        {{-- Clear expectation before form (Shneiderman #5 — error prevention) --}}
        <div class="shared-motivate">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          سيُراجع سؤالك خلال ٣-٧ أيام. ستُشعَر بالجواب إذا أضفت بريدك الإلكتروني.
        </div>
      </div>

      <form class="askfatwa-form" @submit.prevent="submitForm()">

        {{-- Question title --}}
        <div class="askfatwa-field">
          <label class="askfatwa-field__label">
            عنوان السؤال
            <span class="askfatwa-field__required">*</span>
          </label>
          <input class="askfatwa-field__input" type="text" x-model="form.title"
                 placeholder="صُغ سؤالك في جملة واحدة واضحة..."
                 :class="{ 'askfatwa-field__input--error': errors.title }" required>
          <span class="askfatwa-field__error" x-show="errors.title" x-text="errors.title"></span>
        </div>

        {{-- Question body --}}
        <div class="askfatwa-field">
          <label class="askfatwa-field__label">
            تفاصيل السؤال
            <span class="askfatwa-field__required">*</span>
          </label>
          <textarea class="askfatwa-field__textarea" x-model="form.body" rows="6"
                    placeholder="اذكر السياق أولاً، ثم صُغ سؤالك بوضوح. كلما كان السؤال محدداً كانت الإجابة أدق وأسرع..."
                    :class="{ 'askfatwa-field__input--error': errors.body }" required></textarea>
          <div class="askfatwa-field__hint">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            سؤال محدد يحصل على إجابة أدق وأسرع
          </div>
          <span class="askfatwa-field__error" x-show="errors.body" x-text="errors.body"></span>
        </div>

        {{-- Section select --}}
        <div class="askfatwa-field">
          <label class="askfatwa-field__label">التصنيف</label>
          <div class="shared-filter-tabs" style="flex-wrap:wrap;gap:6px">
            @foreach(['عقيدة','فقه العبادات','فقه المعاملات','الأخلاق','الأسرة','أخرى'] as $cat)
              <button type="button" class="shared-filter-tab"
                      :class="{ 'shared-filter-tab--active': form.category==='{{ $cat }}' }"
                      @click="form.category='{{ $cat }}'">{{ $cat }}</button>
            @endforeach
          </div>
        </div>

        {{-- Optional: name --}}
        <div class="askfatwa-optional-row">
          <div class="askfatwa-field" style="flex:1">
            <label class="askfatwa-field__label">
              الاسم
              <span class="askfatwa-field__optional">اختياري — بلا ضغط</span>
            </label>
            <input class="askfatwa-field__input" type="text" x-model="form.name" placeholder="الاسم أو الكنية">
          </div>
          <div class="askfatwa-field" style="flex:1">
            <label class="askfatwa-field__label">
              البريد الإلكتروني
              <span class="askfatwa-field__optional">لإشعارك بالجواب</span>
            </label>
            <input class="askfatwa-field__input" type="email" x-model="form.email"
                   placeholder="example@mail.com" dir="ltr">
          </div>
        </div>

        {{-- Guidelines --}}
        <div class="askfatwa-guidelines">
          <p class="askfatwa-guidelines__title">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            إرشادات للسؤال الجيد
          </p>
          <ul class="askfatwa-guidelines__list">
            <li>تحقّق أولاً من أن سؤالك لم يُسأل من قبل في قسم الفتاوى</li>
            <li>اذكر السياق الكامل للمسألة</li>
            <li>سؤال واحد في كل مرة — لا تجمع أسئلة متعددة</li>
            <li>تجنّب الأسئلة الافتراضية غير الواقعية</li>
          </ul>
        </div>

        <button type="submit" class="shared-btn-primary askfatwa-submit-btn"
                :disabled="isSubmitting">
          <svg x-show="!isSubmitting" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          <svg x-show="isSubmitting" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="askfatwa-spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
          <span x-text="isSubmitting ? 'جارٍ الإرسال...' : 'إرسال السؤال'"></span>
        </button>

      </form>
    </div>

  </div>
</div>

<script>
function askFatwaPage() {
  return {
    submitted: false,
    isSubmitting: false,
    form: { title: '', body: '', category: 'فقه العبادات', name: '', email: '' },
    errors: {},
    validate() {
      this.errors = {};
      if (!this.form.title.trim()) this.errors.title = 'عنوان السؤال مطلوب';
      if (!this.form.body.trim() || this.form.body.length < 30) this.errors.body = 'يرجى توضيح السؤال بما لا يقل عن ٣٠ حرفاً';
      return Object.keys(this.errors).length === 0;
    },
    submitForm() {
      if (!this.validate()) return;
      this.isSubmitting = true;
      setTimeout(() => {
        this.isSubmitting = false;
        this.submitted = true;
      }, 1200);
    },
    resetForm() {
      this.form = { title: '', body: '', category: 'فقه العبادات', name: '', email: '' };
      this.errors = {};
    }
  }
}
</script>
@endsection
