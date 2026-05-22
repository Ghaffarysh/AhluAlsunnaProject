<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ - منصة المعرفة الإسلامية</title>

    <!-- Local Fonts -->
    <style>
        /* ── Thmanyah Sans (UI / Body) ── */
        @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Light.woff2') }}") format('woff2'); font-weight: 300; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Regular.woff2') }}") format('woff2'); font-weight: 400; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Medium.woff2') }}") format('woff2'); font-weight: 500; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Bold.woff2') }}") format('woff2'); font-weight: 700; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSans'; src: url("{{ asset('fonts/thmanyahsans/woff2/thmanyahsans-Black.woff2') }}") format('woff2'); font-weight: 900; font-style: normal; font-display: swap; }

        /* ── Thmanyah Serif Display (Hero titles / large headings) ── */
        @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Light.woff2') }}") format('woff2'); font-weight: 300; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Regular.woff2') }}") format('woff2'); font-weight: 400; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Medium.woff2') }}") format('woff2'); font-weight: 500; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Bold.woff2') }}") format('woff2'); font-weight: 700; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifDisplay'; src: url("{{ asset('fonts/thmanyahserifdisplay/woff2/thmanyahserifdisplay-Black.woff2') }}") format('woff2'); font-weight: 900; font-style: normal; font-display: swap; }

        /* ── Thmanyah Serif Text (Long-form reading / article body) ── */
        @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Light.woff2') }}") format('woff2'); font-weight: 300; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Regular.woff2') }}") format('woff2'); font-weight: 400; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Medium.woff2') }}") format('woff2'); font-weight: 500; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Bold.woff2') }}") format('woff2'); font-weight: 700; font-style: normal; font-display: swap; }
        @font-face { font-family: 'ThmanyahSerifText'; src: url("{{ asset('fonts/thmanyahseriftext/woff2/thmanyahseriftext-Black.woff2') }}") format('woff2'); font-weight: 900; font-style: normal; font-display: swap; }

        /* ── Lyon (Latin accent / numbers / decorative) ── */
        @font-face { font-family: 'Lyon'; src: url("{{ asset('fonts/lyon.otf') }}") format('opentype'); font-weight: 400; font-style: normal; font-display: swap; }
    </style>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#045f72',
                        'primary-light': '#057a91',
                        'primary-dark': '#034a59',
                        accent: '#b19346',
                        'accent-light': '#c8aa62',
                        'bg-day': '#fafcfd',
                        'bg-dark': '#0c1a1e',
                        'surface-dark': '#102229',
                    },
                    fontFamily: {
                        sans:          ['ThmanyahSans', 'sans-serif'],
                        display:       ['ThmanyahSerifDisplay', 'serif'],
                        text:          ['ThmanyahSerifText', 'serif'],
                        lyon:          ['Lyon', 'serif'],
                        arabic:        ['ThmanyahSans', 'sans-serif'],
                        amiri:         ['ThmanyahSerifDisplay', 'serif'],
                    }
                }
            }
        }
    </script>
@vite('resources/css/app.css')
</head>
@stack('scripts')
<body x-data="siteApp()" :class="{ 'dark': darkMode }" @keydown.escape.window="closeFatwa(); closeMobileMenu()">

<!-- ============================
     HEADER
============================= -->
<header class="site-header" id="siteHeader">
    <div class="header-inner">

        <!-- Logo (RTL: Right side) -->
        <a href="/" class="logo-wrap">
            <img src="{{ asset('images/logo.png') }}"      alt="مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ" class="logo-img logo-img-day">
            <img src="{{ asset('images/nightLogo.png') }}" alt="مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ" class="logo-img logo-img-night">
        </a>

        <!-- Main Navigation (Center) -->
        <nav class="main-nav" role="navigation">

            <!-- الدروس -->
            <div class="nav-item" x-data="{ open: false }" @click.away="open = false">
                <button class="nav-link" :class="{ open: open }" @click="open = !open">
                    <svg class="nav-arrow" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                    الدروس
                </button>
                <div class="nav-dropdown" :class="{ open: open }">
                    <!-- عقيدة -->
                    <div class="dropdown-category" x-data="{ subOpen: false }">
                        <button class="dropdown-cat-btn" @click="subOpen = !subOpen">
                            <div class="cat-icon">🕌</div>
                            <span class="cat-label">العقيدة</span>
                            <svg class="cat-arrow" :class="{ open: subOpen }" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                        </button>
                        <div class="sub-menu" :class="{ open: subOpen }">
                            <a href="/?section=aqeedah&sub=tawhid" class="sub-link">التوحيد</a>
                            <div x-data="{ deep: false }">
                                <button class="dropdown-cat-btn" @click="deep = !deep" style="padding: 7px 12px; font-weight:500; font-size:0.82rem; color:var(--text-muted-day);">
                                    <div style="width:26px; margin-left:8px;"></div>
                                    <span class="cat-label">أسماء الله وصفاته</span>
                                    <svg class="cat-arrow" :class="{ open: deep }" viewBox="0 0 16 16" fill="currentColor" style="width:12px;height:12px;flex-shrink:0;"><path d="M4 6l4 4 4-4H4z"/></svg>
                                </button>
                                <div class="sub-sub-menu" x-show="deep">
                                    <a href="/?section=aqeedah&sub=asma_husna" class="sub-sub-link">الأسماء الحسنى</a>
                                    <a href="/?section=aqeedah&sub=sifat" class="sub-sub-link">الصفات الإلهية</a>
                                </div>
                            </div>
                            <a href="/?section=aqeedah&sub=iman" class="sub-link">أركان الإيمان</a>
                            <a href="/?section=aqeedah&sub=milal" class="sub-link">الفرق والمذاهب</a>
                        </div>
                    </div>
                    <div class="drop-divider"></div>
                    <!-- فقه -->
                    <div class="dropdown-category" x-data="{ subOpen: false }">
                        <button class="dropdown-cat-btn" @click="subOpen = !subOpen">
                            <div class="cat-icon">📖</div>
                            <span class="cat-label">الفقه</span>
                            <svg class="cat-arrow" :class="{ open: subOpen }" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                        </button>
                        <div class="sub-menu" :class="{ open: subOpen }">
                            <a href="/?section=fiqh&sub=ibadat" class="sub-link">العبادات</a>
                            <a href="/?section=fiqh&sub=muamalat" class="sub-link">المعاملات</a>
                            <a href="/?section=fiqh&sub=usool" class="sub-link">أصول الفقه</a>
                        </div>
                    </div>
                    <div class="drop-divider"></div>
                    <!-- حديث -->
                    <div class="dropdown-category" x-data="{ subOpen: false }">
                        <button class="dropdown-cat-btn" @click="subOpen = !subOpen">
                            <div class="cat-icon">📜</div>
                            <span class="cat-label">الحديث</span>
                            <svg class="cat-arrow" :class="{ open: subOpen }" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                        </button>
                        <div class="sub-menu" :class="{ open: subOpen }">
                            <a href="/?section=hadith&sub=nawawi" class="sub-link">الأربعون النووية</a>
                            <a href="/?section=hadith&sub=bukhari" class="sub-link">صحيح البخاري</a>
                            <a href="/?section=hadith&sub=mustalah" class="sub-link">مصطلح الحديث</a>
                        </div>
                    </div>
                    <div class="drop-divider"></div>
                    <!-- تفسير -->
                    <div class="dropdown-category" x-data="{ subOpen: false }">
                        <button class="dropdown-cat-btn" @click="subOpen = !subOpen">
                            <div class="cat-icon">✨</div>
                            <span class="cat-label">التفسير</span>
                            <svg class="cat-arrow" :class="{ open: subOpen }" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                        </button>
                        <div class="sub-menu" :class="{ open: subOpen }">
                            <a href="/?section=tafsir&sub=tafsir_muyassar" class="sub-link">التفسير الميسر</a>
                            <a href="/?section=tafsir&sub=tafsir_ibn_kathir" class="sub-link">تفسير ابن كثير</a>
                            <a href="/?section=tafsir&sub=asbab_nuzul" class="sub-link">أسباب النزول</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- المكتبة -->
            <div class="nav-item" x-data="{ open: false }" @click.away="open = false">
                <button class="nav-link" :class="{ open: open }" @click="open = !open">
                    <svg class="nav-arrow" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                    المكتبة
                </button>
                <div class="nav-dropdown" :class="{ open: open }" style="min-width: 200px;">
                    <a href="/?section=books" class="sub-link" style="padding: 9px 12px; font-size: 0.88rem; border-radius: 8px; display:flex; align-items:center; gap:8px; color:var(--text-muted-day); text-decoration:none; transition:all 0.15s;">
                        <div class="cat-icon" style="margin-left:8px; width:26px; height:26px;">📚</div> الكتب الإسلامية
                    </a>
                    <a href="/?section=audio" class="sub-link" style="padding: 9px 12px; font-size: 0.88rem; border-radius: 8px; display:flex; align-items:center; gap:8px; color:var(--text-muted-day); text-decoration:none; transition:all 0.15s;">
                        <div class="cat-icon" style="margin-left:8px; width:26px; height:26px;">🎧</div> الدروس الصوتية
                    </a>
                    <a href="/?section=video" class="sub-link" style="padding: 9px 12px; font-size: 0.88rem; border-radius: 8px; display:flex; align-items:center; gap:8px; color:var(--text-muted-day); text-decoration:none; transition:all 0.15s;">
                        <div class="cat-icon" style="margin-left:8px; width:26px; height:26px;">🎬</div> المحاضرات المرئية
                    </a>
                    <a href="/?section=articles" class="sub-link" style="padding: 9px 12px; font-size: 0.88rem; border-radius: 8px; display:flex; align-items:center; gap:8px; color:var(--text-muted-day); text-decoration:none; transition:all 0.15s;">
                        <div class="cat-icon" style="margin-left:8px; width:26px; height:26px;">📄</div> المقالات العلمية
                    </a>
                </div>
            </div>

            <!-- الفتاوى -->
            <div class="nav-item" x-data="{ open: false }" @click.away="open = false">
                <button class="nav-link" :class="{ open: open }" @click="open = !open">
                    <svg class="nav-arrow" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                    الفتاوى
                </button>
                <div class="nav-dropdown" :class="{ open: open }" style="min-width: 200px;">
                    <a href="/?section=fatawa_aqeedah" class="sub-link" style="padding: 9px 12px; font-size: 0.88rem; border-radius: 8px; display:flex; align-items:center; gap:8px; color:var(--text-muted-day); text-decoration:none;">
                        <div class="cat-icon" style="margin-left:8px; width:26px; height:26px;">🕌</div> فتاوى العقيدة
                    </a>
                    <a href="/?section=fatawa_fiqh" class="sub-link" style="padding: 9px 12px; font-size: 0.88rem; border-radius: 8px; display:flex; align-items:center; gap:8px; color:var(--text-muted-day); text-decoration:none;">
                        <div class="cat-icon" style="margin-left:8px; width:26px; height:26px;">📖</div> فتاوى الفقه
                    </a>
                    <a href="/?section=fatawa_contemporary" class="sub-link" style="padding: 9px 12px; font-size: 0.88rem; border-radius: 8px; display:flex; align-items:center; gap:8px; color:var(--text-muted-day); text-decoration:none;">
                        <div class="cat-icon" style="margin-left:8px; width:26px; height:26px;">💡</div> المسائل المعاصرة
                    </a>
                    <div class="drop-divider"></div>
                    <button class="dropdown-cat-btn" @click="$dispatch('open-fatwa')" style="font-size: 0.85rem; color: var(--primary); padding: 9px 12px;">
                        <div class="cat-icon" style="margin-left:8px; background:rgba(4,95,114,0.15);">✉️</div>
                        <span class="cat-label">أرسل سؤالك</span>
                    </button>
                </div>
            </div>

        </nav>

        <!-- Controls (Left side in RTL) -->
        <div class="header-controls">

            <!-- Search (desktop) -->
            <div class="search-wrap hidden md:block" x-data="{ expanded: false }">
                <div class="search-container" :class="{ expanded: expanded }" @click="!expanded && (expanded = true)">
                    <button class="search-icon-btn" @click.stop="expanded = !expanded">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </button>
                    <input class="search-input" type="text" placeholder="ابحث في المَوْسُوعَة ..." x-ref="searchInput" @click.away="expanded = false">
                </div>
            </div>

            <!-- Dark mode toggle -->
            <button class="dark-toggle" @click="toggleDark()" :title="darkMode ? 'الوضع النهاري' : 'الوضع الليلي'">
                <svg x-show="!darkMode" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                </svg>
                <svg x-show="darkMode" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
            </button>

            <!-- Mobile menu button -->
            <button class="mobile-menu-btn" @click="openMobileMenu()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
        </div>

    </div>
</header>


<!-- ============================
     MOBILE OVERLAY
============================= -->
<div class="mobile-overlay" :class="{ open: mobileOpen }" @keydown.escape="closeMobileMenu()">

    <div class="mobile-overlay-header">
        <a href="/" class="logo-wrap">
            <img src="{{ asset('images/logo.png') }}"      alt="مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ" class="logo-img logo-img-day">
            <img src="{{ asset('images/nightLogo.png') }}" alt="مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ" class="logo-img logo-img-night">
        </a>
        <button class="mobile-close-btn" @click="closeMobileMenu()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <!-- Search bar -->
    <div class="mobile-search-bar">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <input class="mobile-search-input" type="text" placeholder="ابحث في المَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ...">
    </div>

    <!-- Navigation -->
    <div class="mobile-nav-section">
        <p class="mobile-nav-label">التصفح الرئيسي</p>

        <!-- الدروس -->
        <div class="mobile-nav-main-item" x-data="{ open: false }">
            <button class="mobile-nav-main-btn" :class="{ 'active-section': open }" @click="open = !open">
                <span>الدروس</span>
                <svg width="14" height="14" style="transition:transform 0.25s;flex-shrink:0;" :style="open ? 'transform:rotate(180deg)' : ''" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
            </button>
            <div class="mobile-sub-panel" :class="{ open: open }">
                <!-- عقيدة -->
                <div x-data="{ catOpen: false }">
                    <button class="mobile-cat-btn" @click="catOpen = !catOpen">
                        <span>العقيدة</span>
                        <svg width="12" height="12" style="transition:transform 0.2s;flex-shrink:0;" :style="catOpen ? 'transform:rotate(180deg)' : ''" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                    </button>
                    <div class="mobile-sub-links" :class="{ open: catOpen }">
                        <a href="/?section=aqeedah&sub=tawhid" class="mobile-sub-a">التوحيد</a>
                        <a href="/?section=aqeedah&sub=asma" class="mobile-sub-a">أسماء الله وصفاته</a>
                        <a href="/?section=aqeedah&sub=iman" class="mobile-sub-a">أركان الإيمان</a>
                        <a href="/?section=aqeedah&sub=milal" class="mobile-sub-a">الفرق والمذاهب</a>
                    </div>
                </div>
                <!-- فقه -->
                <div x-data="{ catOpen: false }">
                    <button class="mobile-cat-btn" @click="catOpen = !catOpen">
                        <span>الفقه</span>
                        <svg width="12" height="12" style="transition:transform 0.2s;flex-shrink:0;" :style="catOpen ? 'transform:rotate(180deg)' : ''" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                    </button>
                    <div class="mobile-sub-links" :class="{ open: catOpen }">
                        <a href="/?section=fiqh&sub=ibadat" class="mobile-sub-a">العبادات</a>
                        <a href="/?section=fiqh&sub=muamalat" class="mobile-sub-a">المعاملات</a>
                        <a href="/?section=fiqh&sub=usool" class="mobile-sub-a">أصول الفقه</a>
                    </div>
                </div>
                <!-- حديث -->
                <div x-data="{ catOpen: false }">
                    <button class="mobile-cat-btn" @click="catOpen = !catOpen">
                        <span>الحديث</span>
                        <svg width="12" height="12" style="transition:transform 0.2s;flex-shrink:0;" :style="catOpen ? 'transform:rotate(180deg)' : ''" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                    </button>
                    <div class="mobile-sub-links" :class="{ open: catOpen }">
                        <a href="/?section=hadith&sub=nawawi" class="mobile-sub-a">الأربعون النووية</a>
                        <a href="/?section=hadith&sub=bukhari" class="mobile-sub-a">صحيح البخاري</a>
                        <a href="/?section=hadith&sub=mustalah" class="mobile-sub-a">مصطلح الحديث</a>
                    </div>
                </div>
                <!-- تفسير -->
                <div x-data="{ catOpen: false }">
                    <button class="mobile-cat-btn" @click="catOpen = !catOpen">
                        <span>التفسير</span>
                        <svg width="12" height="12" style="transition:transform 0.2s;flex-shrink:0;" :style="catOpen ? 'transform:rotate(180deg)' : ''" viewBox="0 0 16 16" fill="currentColor"><path d="M4 6l4 4 4-4H4z"/></svg>
                    </button>
                    <div class="mobile-sub-links" :class="{ open: catOpen }">
                        <a href="/?section=tafsir&sub=muyassar" class="mobile-sub-a">التفسير الميسر</a>
                        <a href="/?section=tafsir&sub=ibn_kathir" class="mobile-sub-a">تفسير ابن كثير</a>
                        <a href="/?section=tafsir&sub=asbab" class="mobile-sub-a">أسباب النزول</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- المكتبة -->
        <div class="mobile-nav-main-item">
            <button class="mobile-nav-main-btn" style="justify-content:flex-start;">
                <a href="/?section=library" style="text-decoration:none; color:inherit; flex:1; text-align:right;">المكتبة</a>
            </button>
        </div>

        <!-- الفتاوى -->
        <div class="mobile-nav-main-item">
            <button class="mobile-nav-main-btn" @click="closeMobileMenu(); openFatwa()">
                <span>الفتاوى — أرسل سؤالك</span>
            </button>
        </div>
    </div>

    <!-- Dark mode toggle row -->
    <div class="mobile-dark-row">
        <span class="dark-toggle-label" x-text="darkMode ? '🌙 الوضع الليلي مفعّل' : '☀️ الوضع النهاري مفعّل'"></span>
        <label class="toggle-switch">
            <input type="checkbox" :checked="darkMode" @change="toggleDark()">
            <span class="toggle-slider"></span>
        </label>
    </div>

</div>


<!-- ============================
     DEMO PAGE CONTENT
============================= -->
<!-- Page Content -->
<main @open-fatwa.window="openFatwa()">
    @yield('content')
</main>


<!-- ============================
     FOOTER
============================= -->
<footer class="site-footer">
    <div class="footer-pattern"></div>
    <div class="footer-inner">
        <div class="footer-grid">

            <!-- Brand column -->
            <div class="footer-brand">
                <a href="/" class="logo-wrap" style="display:inline-flex;">
                    <img src="{{ asset('images/logo.png') }}"      alt="مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ" class="logo-img logo-img-day"  style="filter:brightness(0) invert(1) sepia(1) saturate(2) hue-rotate(160deg);">
                    <img src="{{ asset('images/nightLogo.png') }}" alt="مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ" class="logo-img logo-img-night">
                </a>
                <p class="footer-brand-desc">
                    مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ منصة علمية إسلامية تهدف إلى نشر المعرفة الشرعية الصحيحة المستندة إلى الكتاب والسنة، بأسلوب علمي رصين وميسّر للجميع.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-btn" title="تويتر / إكس">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.264 5.633 5.9-5.633zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="يوتيوب">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="واتساب">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="تيليغرام">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <p class="footer-col-title">روابط سريعة</p>
                <ul class="footer-links">
                    <li><a href="/?section=lessons">الدروس العلمية</a></li>
                    <li><a href="/?section=library">المكتبة الإسلامية</a></li>
                    <li><a href="/?section=fatawa">الفتاوى الشرعية</a></li>
                    <li><a href="/about">عن المَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ</a></li>
                    <li><a href="/scholars">العلماء والمشايخ</a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <p class="footer-col-title">الأقسام</p>
                <ul class="footer-links">
                    <li><a href="/?section=aqeedah">العقيدة الإسلامية</a></li>
                    <li><a href="/?section=fiqh">الفقه وأصوله</a></li>
                    <li><a href="/?section=hadith">علوم الحديث</a></li>
                    <li><a href="/?section=tafsir">تفسير القرآن</a></li>
                    <li><a href="/?section=seerah">السيرة النبوية</a></li>
                </ul>
            </div>

            <!-- Legal & Contact -->
            <div>
                <p class="footer-col-title">القانوني والتواصل</p>
                <ul class="footer-links">
                    <li><a href="/privacy">سياسة الخصوصية</a></li>
                    <li><a href="/terms">شروط الاستخدام</a></li>
                    <li><a href="/contact">تواصل معنا</a></li>
                    <li><a href="/contribute">المساهمة والدعم</a></li>
                </ul>
                <div style="margin-top: 1.25rem; padding: 12px; background: rgba(177,147,70,0.1); border: 1px solid rgba(177,147,70,0.2); border-radius: 10px;">
                    <p style="font-size:0.78rem; color: #c8aa62; font-weight: 600; margin-bottom: 4px;">📧 للتواصل العلمي</p>
                    <a href="mailto:scholars@manara.com" style="font-size:0.78rem; color:#8bb5c0; text-decoration:none;">scholars@manara.com</a>
                </div>
            </div>

        </div>

        <!-- Bottom bar -->
        <div class="footer-bottom">
            <p class="footer-copy">
                © ١٤٤٦هـ / ٢٠٢٥م — مَوْسُوعَةُ أَهْلِ السُّنَّةِ وَالْجَمَاعَةِ
 . جميع الحقوق محفوظة.
                مبني بـ <a href="#">❤️</a> لخدمة الإسلام والمسلمين.
            </p>
            <nav class="footer-legal">
                <a href="/privacy">الخصوصية</a>
                <a href="/terms">الشروط</a>
                <a href="/sitemap">خريطة الموقع</a>
            </nav>
        </div>
    </div>
</footer>


<!-- ============================
     FATWA FLOATING BUTTON
============================= -->
<button class="fatwa-float-btn" @click="openFatwa()" x-show="!fatwaOpen">
    <div class="fatwa-btn-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>
    </div>
    <span>اطرح سؤالاً</span>
</button>


<!-- ============================
     FATWA MODAL
============================= -->
<div class="fatwa-backdrop" :class="{ open: fatwaOpen }" @click.self="closeFatwa()">
    <div class="fatwa-card" role="dialog" aria-modal="true" aria-labelledby="fatwaTitle">

        <div class="fatwa-card-header">
            <div class="fatwa-card-title">
                <div class="fatwa-title-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <div class="fatwa-title-text">
                    <h2 id="fatwaTitle">طلب فتوى</h2>
                    <p>سيُجاب على سؤالك من قِبل العلماء المعتمدين</p>
                </div>
            </div>
            <button class="fatwa-close" @click="closeFatwa()" aria-label="إغلاق">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="fatwa-card-body">
            <textarea
                class="fatwa-textarea"
                placeholder="اكتب سؤالك هنا... كلما كان السؤال أوضح وأكثر تفصيلاً، كانت الإجابة أدق وأشمل."
                rows="5"
            ></textarea>

            <div class="optional-fields">
                <input class="fatwa-input" type="text" placeholder="الاسم (اختياري)">
                <input class="fatwa-input" type="email" placeholder="البريد الإلكتروني (اختياري)" dir="ltr">
            </div>

            <p class="fatwa-note">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                معلوماتك محفوظة وتُستخدم فقط للرد على سؤالك
            </p>

            <button class="fatwa-submit" @click="submitFatwa()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                إرسال السؤال
            </button>
        </div>

    </div>
</div>


<!-- ============================
     ALPINE.JS APP
============================= -->
<script>
    function siteApp() {
        return {
            darkMode: false,
            mobileOpen: false,
            fatwaOpen: false,

            init() {
                // Load dark mode preference
                const stored = localStorage.getItem('manara-dark');
                if (stored === 'true') {
                    this.darkMode = true;
                    document.documentElement.classList.add('dark');
                }

                // Header scroll shadow
                window.addEventListener('scroll', () => {
                    const header = document.getElementById('siteHeader');
                    if (window.scrollY > 10) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                });
            },

            toggleDark() {
                this.darkMode = !this.darkMode;
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('manara-dark', 'true');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('manara-dark', 'false');
                }
            },

            openMobileMenu() {
                this.mobileOpen = true;
                document.body.style.overflow = 'hidden';
            },

            closeMobileMenu() {
                this.mobileOpen = false;
                document.body.style.overflow = '';
            },

            openFatwa() {
                this.fatwaOpen = true;
                document.body.style.overflow = 'hidden';
            },

            closeFatwa() {
                this.fatwaOpen = false;
                document.body.style.overflow = '';
            },

            submitFatwa() {
                // Placeholder — integrate with Laravel backend
                alert('تم إرسال سؤالك بنجاح! سيتم الرد عليك قريباً بإذن الله.');
                this.closeFatwa();
            }
        }
    }
</script>

</body>
</html>