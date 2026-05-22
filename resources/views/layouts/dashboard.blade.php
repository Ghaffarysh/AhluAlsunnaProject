<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="dashboardApp()" :class="{ 'dark': darkMode }">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'لوحة التحكم') — موسوعة أهل السنة</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Light.woff2') }}") format('woff2'); font-weight: 300; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Regular.woff2') }}") format('woff2'); font-weight: 400; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Medium.woff2') }}") format('woff2'); font-weight: 500; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Bold.woff2') }}") format('woff2'); font-weight: 700; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Black.woff2') }}") format('woff2'); font-weight: 900; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Light.woff2') }}") format('woff2'); font-weight: 300; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Regular.woff2') }}") format('woff2'); font-weight: 400; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Medium.woff2') }}") format('woff2'); font-weight: 500; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Bold.woff2') }}") format('woff2'); font-weight: 700; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Black.woff2') }}") format('woff2'); font-weight: 900; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Light.woff2') }}") format('woff2'); font-weight: 300; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Regular.woff2') }}") format('woff2'); font-weight: 400; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Medium.woff2') }}") format('woff2'); font-weight: 500; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Bold.woff2') }}") format('woff2'); font-weight: 700; font-style: normal; font-display: swap; }
    @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Black.woff2') }}") format('woff2'); font-weight: 900; font-style: normal; font-display: swap; }
    @font-face { font-family: 'Lyon'; src: url("{{ asset('fonts/lyon.otf') }}") format('opentype'); font-weight: 400; font-style: normal; font-display: swap; }
  </style>
  @vite('resources/css/dashboard.css')
</head>
<body class="dash-body">

{{-- Mobile backdrop --}}
<div class="dash-sidebar-backdrop"
     x-show="mobileMenuOpen"
     @click="mobileMenuOpen = false"
     x-transition:enter="transition-opacity duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display:none">
</div>

{{-- ══ SIDEBAR ══════════════════════════════════════════════════ --}}
<aside class="dash-sidebar"
       :class="{ 'dash-sidebar--open': mobileMenuOpen, 'dash-sidebar--collapsed': sidebarCollapsed }">

  {{-- Logo --}}
  <div class="dash-sidebar__logo">
    <a href="/admin" class="dash-sidebar__logo-link">
      <div class="dash-sidebar__logo-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
      </div>
      <span class="dash-sidebar__logo-text">الموسوعة</span>
    </a>
    {{-- Collapse button — always visible on desktop --}}
    <button class="dash-sidebar__collapse-btn"
            @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('dash-collapsed', sidebarCollapsed)"
            :title="sidebarCollapsed ? 'توسيع الشريط' : 'طي الشريط'">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
           :style="sidebarCollapsed ? 'transform:rotate(180deg)' : ''"
           style="transition:transform .25s ease">
        <path d="M15 18l-6-6 6-6"/>
      </svg>
    </button>
  </div>

  {{-- Nav --}}
  <nav class="dash-sidebar__nav">

    <a href="/admin" class="dash-nav-item {{ request()->is('admin') && !request()->is('admin/*') ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
        <rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
      </svg>
      <span class="dash-nav-item__label">الرئيسية</span>
    </a>

    <p class="dash-nav-group__label">المحتوى</p>

    <div x-data="{ open: {{ request()->is('admin/curricula*','admin/lessons*','admin/sermons*','admin/lectures*','admin/refutations*','admin/library*') ? 'true' : 'false' }} }">
      <button class="dash-nav-item dash-nav-item--parent"
              @click="if(sidebarCollapsed){ sidebarCollapsed=false; $nextTick(()=>{ open=true }); } else { open=!open; }"
              :class="{ 'dash-nav-item--active': open }">
        <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
        <span class="dash-nav-item__label">المقررات والدروس</span>
        <svg class="dash-nav-item__chevron" width="11" height="11" viewBox="0 0 16 16" fill="currentColor"
             :style="open ? 'transform:rotate(180deg)' : ''" style="transition:.2s">
          <path d="M4 6l4 4 4-4H4z"/>
        </svg>
      </button>
      <div x-show="open && !sidebarCollapsed" x-collapse class="dash-nav-children">
        <a href="/admin/curricula"   class="dash-nav-child {{ request()->is('admin/curricula*')   ? 'dash-nav-child--active' : '' }}">المقررات العلمية</a>
        <a href="/admin/lessons"     class="dash-nav-child {{ request()->is('admin/lessons*')     ? 'dash-nav-child--active' : '' }}">الدروس</a>
        <a href="/admin/sermons"     class="dash-nav-child {{ request()->is('admin/sermons*')     ? 'dash-nav-child--active' : '' }}">خطب الجمعة</a>
        <a href="/admin/lectures"    class="dash-nav-child {{ request()->is('admin/lectures*')    ? 'dash-nav-child--active' : '' }}">المحاضرات</a>
        <a href="/admin/refutations" class="dash-nav-child {{ request()->is('admin/refutations*') ? 'dash-nav-child--active' : '' }}">الردود العلمية</a>
        <a href="/admin/library"     class="dash-nav-child {{ request()->is('admin/library*')     ? 'dash-nav-child--active' : '' }}">المكتبة</a>
      </div>
    </div>

    <p class="dash-nav-group__label">الفتاوى</p>

    <a href="/admin/fatwas/questions" class="dash-nav-item {{ request()->is('admin/fatwas/questions*') ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
      </svg>
      <span class="dash-nav-item__label">أسئلة جديدة</span>
      <span class="dash-nav-badge">7</span>
    </a>

    <a href="/admin/fatwas/published" class="dash-nav-item {{ request()->is('admin/fatwas/published*') ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
      </svg>
      <span class="dash-nav-item__label">الفتاوى المنشورة</span>
    </a>

    <p class="dash-nav-group__label">مشترك</p>

    <a href="/admin/scholars"     class="dash-nav-item {{ request()->is('admin/scholars*')     ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
      </svg>
      <span class="dash-nav-item__label">الشيوخ والعلماء</span>
    </a>

    <a href="/admin/categories"   class="dash-nav-item {{ request()->is('admin/categories*')   ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/>
        <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
      </svg>
      <span class="dash-nav-item__label">التصنيفات</span>
    </a>

    <a href="/admin/notifications" class="dash-nav-item {{ request()->is('admin/notifications*') ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
      </svg>
      <span class="dash-nav-item__label">الإشعارات</span>
    </a>

    <p class="dash-nav-group__label">الإدارة</p>

    <a href="/admin/users"        class="dash-nav-item {{ request()->is('admin/users*')        ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
      </svg>
      <span class="dash-nav-item__label">المستخدمون</span>
    </a>

    <a href="/admin/activity-log" class="dash-nav-item {{ request()->is('admin/activity-log*') ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
      </svg>
      <span class="dash-nav-item__label">سجل النشاط</span>
    </a>

    <p class="dash-nav-group__label">الإعدادات</p>

    <a href="/admin/settings/general" class="dash-nav-item {{ request()->is('admin/settings/general') ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 19.07a10 10 0 0 1 0-14.14"/>
      </svg>
      <span class="dash-nav-item__label">إعدادات عامة</span>
    </a>

    <a href="/admin/settings/profile"  class="dash-nav-item {{ request()->is('admin/settings/profile')  ? 'dash-nav-item--active' : '' }}">
      <svg class="dash-nav-item__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
      </svg>
      <span class="dash-nav-item__label">حسابي</span>
    </a>

  </nav>
</aside>

{{-- ══ MAIN ══════════════════════════════════════════════════════ --}}
<div class="dash-main" :class="{ 'dash-main--collapsed': sidebarCollapsed }">

  {{-- Header --}}
  <header class="dash-header">
    <div class="dash-header__inner">

      {{-- Hamburger — mobile only, always on right in RTL --}}
      <button class="dash-header__hamburger"
              @click="mobileMenuOpen = !mobileMenuOpen"
              aria-label="القائمة">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round">
          <line x1="3" y1="6" x2="21" y2="6"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
      </button>

      {{-- Breadcrumb — fills middle space --}}
      <nav class="dash-breadcrumb" aria-label="breadcrumb">
        <a href="/admin" class="dash-breadcrumb__link">لوحة التحكم</a>
        @yield('breadcrumb')
      </nav>

      {{-- Actions — always on left in RTL --}}
      <div class="dash-header__actions">

        {{-- Notifications --}}
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
          <button class="dash-header__icon-btn" @click="open = !open" aria-label="الإشعارات">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="dash-notif-dot"></span>
          </button>
          <div class="dash-notif-panel" x-show="open" x-transition style="display:none">
            <div class="dash-notif-panel__head">
              <span class="dash-notif-panel__title">الإشعارات</span>
              <button class="dash-notif-panel__read-all">تعليم الكل كمقروء</button>
            </div>
            <div class="dash-notif-panel__list">
              <div class="dash-notif-item dash-notif-item--warning">
                <div class="dash-notif-item__bar"></div>
                <div class="dash-notif-item__body">
                  <p class="dash-notif-item__text">لديك 7 أسئلة فتاوى جديدة تنتظر المراجعة</p>
                  <p class="dash-notif-item__time">منذ ١٢ دقيقة</p>
                </div>
              </div>
              <div class="dash-notif-item dash-notif-item--info">
                <div class="dash-notif-item__bar"></div>
                <div class="dash-notif-item__body">
                  <p class="dash-notif-item__text">تم إضافة مقرر جديد بواسطة Admin محمد</p>
                  <p class="dash-notif-item__time">منذ ساعة</p>
                </div>
              </div>
            </div>
            <a href="/admin/notifications" class="dash-notif-panel__footer">عرض كل الإشعارات</a>
          </div>
        </div>

        {{-- Dark mode --}}
        <button class="dash-header__icon-btn" @click="toggleDark()" :title="darkMode ? 'الوضع النهاري' : 'الوضع الليلي'">
          <svg x-show="!darkMode" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
          </svg>
          <svg x-show="darkMode" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
          </svg>
        </button>

        {{-- User menu --}}
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
          <button class="dash-user-btn" @click="open = !open">
            <div class="dash-user-btn__avatar">م</div>
            <div class="dash-user-btn__info">
              <span class="dash-user-btn__name">محمد العدني</span>
              <span class="dash-user-btn__role">Super Admin</span>
            </div>
            <svg width="10" height="10" viewBox="0 0 16 16" fill="currentColor"
                 :style="open ? 'transform:rotate(180deg)' : ''" style="transition:.18s">
              <path d="M4 6l4 4 4-4H4z"/>
            </svg>
          </button>
          <div class="dash-user-dropdown" x-show="open" x-transition style="display:none">
            <a href="/admin/settings/profile" class="dash-user-option">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="7" r="4"/><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              </svg>
              حسابي
            </a>
            <a href="/" target="_blank" class="dash-user-option">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
              </svg>
              عرض الموقع
            </a>
            <div class="dash-user-divider"></div>
            <button class="dash-user-option dash-user-option--danger">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
              </svg>
              تسجيل الخروج
            </button>
          </div>
        </div>

      </div>{{-- end actions --}}
    </div>
  </header>

  <main class="dash-content">
    @yield('content')
  </main>

</div>{{-- end dash-main --}}

<script>
function dashboardApp() {
  return {
    darkMode: false,
    sidebarCollapsed: false,
    mobileMenuOpen: false,

    init() {
      if (localStorage.getItem('dash-dark') === 'true') {
        this.darkMode = true;
        document.documentElement.classList.add('dark');
      }
      if (localStorage.getItem('dash-collapsed') === 'true') {
        this.sidebarCollapsed = true;
      }
      this.$watch('mobileMenuOpen', val => {
        document.body.style.overflow = val ? 'hidden' : '';
      });
    },

    toggleDark() {
      this.darkMode = !this.darkMode;
      document.documentElement.classList.toggle('dark', this.darkMode);
      localStorage.setItem('dash-dark', this.darkMode);
    }
  }
}
</script>

{{-- Toast notifications --}}
<x-dashboard.toast />

</body>
</html>