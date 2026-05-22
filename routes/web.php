<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ø§Ù„ØµÙØ­Ø© Ø§Ù„Ø±Ø¦ÙŠØ³ÙŠØ©
Route::get('/', function () {
    return view('welcome');
});

// Ø§Ù„ÙØªØ§ÙˆÙ‰
Route::get('/fatwas', fn () => view('pages.fatwas'));
Route::get('/fatwa', fn () => view('pages.fatwa'));
Route::get('/ask-fatwa', fn () => view('pages.ask-fatwa'));

// Ø§Ù„Ù…ÙƒØªØ¨Ø©
Route::get('/library', fn () => view('pages.library'));

// Ø§Ù„Ø¯Ø±ÙˆØ³
Route::get('/lessons', fn () => view('pages.lessons'));
Route::get('/lesson', fn () => view('pages.lesson'));

// Ø§Ù„Ø¨Ø­Ø«
Route::get('/search', fn () => view('pages.search'));

// Ø§Ù„ÙƒØªØ¨

Route::get('/book', fn () => view('pages.book'));

Route::get('/curricula', fn () => view('pages.curricula'));

Route::get('/curriculum', fn () => view('pages.curriculum'));

Route::get('/lectures', fn () => view('pages.lectures'));

Route::get('/sermons', fn () => view('pages.sermons'));

Route::get('/refutations', fn () => view('pages.refutations'));


// =========================
// Ù„ÙˆØ­Ø© Ø§Ù„ØªØ­ÙƒÙ… Ø§Ù„Ø±Ø¦ÙŠØ³ÙŠØ©
// =========================

Route::get('/admin', fn () => view('admin.dashboard.index'));

// =========================
// Ø§Ù„Ù…Ù†Ø§Ù‡Ø¬
// =========================

Route::get('/admin/curricula', fn () => view('admin.curricula.index'));

// =========================
// Ø§Ù„Ø¯Ø±ÙˆØ³
// =========================

Route::get('/admin/lessons', fn () => view('admin.lessons.index'));

// =========================
// Ø§Ù„Ø®Ø·Ø¨
// =========================

Route::get('/admin/sermons', fn () => view('admin.sermons.index'));

// =========================
// Ø§Ù„Ù…Ø­Ø§Ø¶Ø±Ø§Øª
// =========================

Route::get('/admin/lectures', fn () => view('admin.lectures.index'));

// =========================
// Ø§Ù„Ø±Ø¯ÙˆØ¯ Ø§Ù„Ø¹Ù„Ù…ÙŠØ©
// =========================

Route::get('/admin/refutations', fn () => view('admin.refutations.index'));

// =========================
// Ø§Ù„Ù…ÙƒØªØ¨Ø©
// =========================

Route::get('/admin/library', fn () => view('admin.library.index'));

// =========================
// Ø§Ù„ÙØªØ§ÙˆÙ‰
// =========================

// Ø§Ù„Ø£Ø³Ø¦Ù„Ø© Ø§Ù„ÙˆØ§Ø±Ø¯Ø©
Route::get('/admin/fatwas/questions', fn () =>
    view('admin.fatwas.questions.index')
);

// Ø§Ù„ÙØªØ§ÙˆÙ‰ Ø§Ù„Ù…Ù†Ø´ÙˆØ±Ø©
Route::get('/admin/fatwas/published', fn () =>
    view('admin.fatwas.published.index')
);

// =========================
// Ø§Ù„Ø¹Ù„Ù…Ø§Ø¡
// =========================

Route::get('/admin/scholars', fn () => view('admin.scholars.index'));

// =========================
// Ø§Ù„ØªØµÙ†ÙŠÙØ§Øª
// =========================

Route::get('/admin/categories', fn () => view('admin.categories.index'));

// =========================
// Ø§Ù„Ø¥Ø´Ø¹Ø§Ø±Ø§Øª
// =========================

Route::get('/admin/notifications', fn () =>
    view('admin.notifications.index')
);

// =========================
// Ø§Ù„Ù…Ø³ØªØ®Ø¯Ù…ÙˆÙ†
// =========================

Route::get('/admin/users', fn () => view('admin.users.index'));

// =========================
// Ø³Ø¬Ù„ Ø§Ù„Ù†Ø´Ø§Ø·
// =========================

Route::get('/admin/activity-log', fn () =>
    view('admin.activity-log.index')
);

// =========================
// Ø§Ù„Ø¥Ø¹Ø¯Ø§Ø¯Ø§Øª
// =========================

Route::get('/admin/settings/general', fn () =>
    view('admin.settings.general')
);

Route::get('/admin/settings/profile', fn () =>
    view('admin.settings.profile')
);

Route::get('/login', fn () => view('auth.login'))->name('login');