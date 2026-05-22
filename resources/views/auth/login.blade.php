{{-- resources/views/auth/login.blade.php --}}
{{-- صفحة تسجيل الدخول — موسوعة أهل السنة والجماعة --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تسجيل الدخول — موسوعة أهل السنة</title>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Light.woff2') }}") format('woff2'); font-weight: 300; font-display: swap; }
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Regular.woff2') }}") format('woff2'); font-weight: 400; font-display: swap; }
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Medium.woff2') }}") format('woff2'); font-weight: 500; font-display: swap; }
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Bold.woff2') }}") format('woff2'); font-weight: 700; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Regular.woff2') }}") format('woff2'); font-weight: 400; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Bold.woff2') }}") format('woff2'); font-weight: 700; font-display: swap; }
  </style>
  @vite('resources/css/login.css')
</head>
<body class="login-body" x-data="loginPage()">

  {{-- ══ BACKGROUND GEOMETRY ══════════════════════════════════════ --}}
  <div class="login-bg" aria-hidden="true">
    <div class="login-bg__grid"></div>
    <div class="login-bg__gradient-1"></div>
    <div class="login-bg__gradient-2"></div>
    <div class="login-bg__orb login-bg__orb--1"></div>
    <div class="login-bg__orb login-bg__orb--2"></div>
    {{-- Decorative Arabic calligraphy watermark --}}
    <div class="login-bg__watermark" aria-hidden="true">
      <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" fill="none">
        <text x="100" y="60" text-anchor="middle"
              font-family="'ThmanyahSerifDisplay', serif"
              font-size="52" fill="currentColor" opacity="1">
          السنة
        </text>
      </svg>
    </div>
  </div>

  {{-- ══ MAIN CONTAINER ════════════════════════════════════════════ --}}
  <main class="login-main">

    {{-- Left panel: brand story --}}
    <div class="login-brand">
      <div class="login-brand__inner">

        <div class="login-brand__logo">
          {{-- Logo: 1824×392px — نسبة 4.65:1 أفقية --}}
          <img
            x-show="!$store.dark"
            src="{{ asset('images/logo.png') }}"
            alt="موسوعة أهل السنة والجماعة"
            class="login-brand__logo-img"
            width="280"
            height="60"
          >
          <img
            x-show="$store.dark"
            src="{{ asset('images/nightLogo.png') }}"
            alt="موسوعة أهل السنة والجماعة"
            class="login-brand__logo-img login-brand__logo-img--night"
            width="280"
            height="60"
          >
        </div>

        <div class="login-brand__content">
          <p class="login-brand__eyebrow">لوحة التحكم الإدارية</p>
          <h1 class="login-brand__title">
            مَوْسُوعَةُ<br>
            أَهْلِ السُّنَّةِ
          </h1>
          <p class="login-brand__desc">
            منصة علمية موثّقة تجمع خطب وفتاوى ودروس وكتب<br>
            علماء أهل السنة والجماعة — منهجاً وعلماً وتراثاً
          </p>
        </div>

        <div class="login-brand__stats">
          @foreach([
            ['٢٠٤٨', 'درساً منشوراً'],
            ['٥٢٣',  'فتوى موثّقة'],
            ['٨٩',   'كتاباً في المكتبة'],
          ] as [$num, $label])
            <div class="login-brand__stat">
              <span class="login-brand__stat-num">{{ $num }}</span>
              <span class="login-brand__stat-label">{{ $label }}</span>
            </div>
          @endforeach
        </div>

        <div class="login-brand__quote">
          <div class="login-brand__quote-mark">"</div>
          <p class="login-brand__quote-text">
            طَلَبُ العِلمِ فَرِيضَةٌ عَلَى كُلِّ مُسلِمٍ
          </p>
          <p class="login-brand__quote-source">ابن ماجه</p>
        </div>

      </div>
    </div>

    {{-- Right panel: login form --}}
    <div class="login-card-wrap">
      <div class="login-card" x-ref="card">

        {{-- Card header --}}
        <div class="login-card__header">
          {{-- Card logo: height ثابت، width auto بناءً على نسبة 4.65:1 --}}
          <div class="login-card__logo">
            <img
              x-show="!$store.dark"
              src="{{ asset('images/logo.png') }}"
              alt="موسوعة أهل السنة والجماعة"
              class="login-card__logo-img"
              width="200"
              height="43"
            >
            <img
              x-show="$store.dark"
              src="{{ asset('images/nightLogo.png') }}"
              alt="موسوعة أهل السنة والجماعة"
              class="login-card__logo-img login-card__logo-img--night"
              width="200"
              height="43"
            >
          </div>
          <h2 class="login-card__title">تسجيل الدخول</h2>
          <p class="login-card__sub">أدخل بيانات حسابك للدخول للوحة التحكم</p>
        </div>

        {{-- Error message (session) --}}
        @if($errors->any())
          <div class="login-alert login-alert--error" x-data="{ show: true }" x-show="show">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
            </svg>
            <span>{{ $errors->first() }}</span>
            <button @click="show=false" class="login-alert__close">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
              </svg>
            </button>
          </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}" class="login-form" @submit="submitting = true">
          @csrf

          {{-- Email --}}
          <div class="login-field" :class="{ 'login-field--focused': focused === 'email' }">
            <label class="login-label" for="email">
              البريد الإلكتروني
            </label>
            <div class="login-input-wrap">
              <div class="login-input-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
              </div>
              <input
                id="email"
                name="email"
                type="email"
                class="login-input"
                placeholder="admin@mawsoa.com"
                value="{{ old('email') }}"
                autocomplete="email"
                required
                @focus="focused = 'email'"
                @blur="focused = null"
              >
            </div>
          </div>

          {{-- Password --}}
          <div class="login-field" :class="{ 'login-field--focused': focused === 'password' }">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
              <label class="login-label" for="password" style="margin-bottom:0">
                كلمة المرور
              </label>
              <a href="{{ url('#') }}" class="login-forgot">
                نسيت كلمة المرور؟
              </a>
            </div>
            <div class="login-input-wrap" x-data="{ showPass: false }">
              <div class="login-input-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="11" width="18" height="11" rx="2"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </div>
              <input
                id="password"
                name="password"
                :type="showPass ? 'text' : 'password'"
                class="login-input"
                placeholder="••••••••••"
                autocomplete="current-password"
                required
                @focus="focused = 'password'"
                @blur="focused = null"
              >
              <button type="button"
                      class="login-input-toggle"
                      @click="showPass = !showPass"
                      :title="showPass ? 'إخفاء' : 'إظهار'">
                <svg x-show="!showPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
                <svg x-show="showPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                  <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                  <line x1="1" y1="1" x2="23" y2="23"/>
                </svg>
              </button>
            </div>
          </div>

          {{-- Remember me --}}
          <div class="login-remember">
            <label class="login-checkbox-wrap">
              <input type="checkbox" name="remember" class="login-checkbox" {{ old('remember') ? 'checked' : '' }}>
              <span class="login-checkbox-label">تذكّرني لمدة ٣٠ يوماً</span>
            </label>
          </div>

          {{-- Submit --}}
          <button type="submit"
                  class="login-submit"
                  :class="{ 'login-submit--loading': submitting }"
                  :disabled="submitting">
            <span x-show="!submitting" class="login-submit__text">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                <polyline points="10 17 15 12 10 7"/>
                <line x1="15" y1="12" x2="3" y2="12"/>
              </svg>
              دخول لوحة التحكم
            </span>
            <span x-show="submitting" class="login-submit__loading">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" style="animation:login-spin .7s linear infinite">
                <circle cx="12" cy="12" r="10" stroke-dasharray="60" stroke-dashoffset="20"/>
              </svg>
              جارٍ التحقق...
            </span>
          </button>

        </form>

        {{-- Footer --}}
        <div class="login-card__footer">
          <a href="/" class="login-card__footer-link">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
              <polyline points="15 3 21 3 21 9"/>
              <line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
            العودة إلى الموقع العام
          </a>
        </div>

      </div>
    </div>

  </main>

  <script>
  // Alpine store for dark mode — يتحقق من prefers-color-scheme
  document.addEventListener('alpine:init', () => {
    Alpine.store('dark', window.matchMedia('(prefers-color-scheme: dark)').matches);
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
      Alpine.store('dark', e.matches);
    });
  });

  function loginPage() {
    return {
      focused: null,
      submitting: false,
    }
  }
  </script>

</body>
</html>