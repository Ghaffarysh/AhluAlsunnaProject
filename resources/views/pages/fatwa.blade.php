@extends('layouts.app')
@section('content')

{{-- fatwa.blade.php | prefix: fatwa- --}}
@php
$fatwa = [
  'question' => 'هل تجب الزكاة على مال الأطفال الذين لم يبلغوا سن الرشد؟',
  'verdict'  => 'تجب الزكاة في مال الأطفال',
  'section'  => 'fiqh',
  'sheikh'   => ['name'=>'الشيخ عبد العزيز بن باز','title'=>'رحمه الله — المفتي العام السابق للمملكة','initial'=>'ع'],
  'date'     => '١٤ محرم ١٤٤٦هـ',
];
$related = [
  ['حكم زكاة مال اليتيم','من نفس التصنيف','فقه'],
  ['نصاب الزكاة وشروطها','تكملة للموضوع','فقه'],
  ['هل تجب الزكاة على الديون؟','من نفس المفتي','فقه'],
];
@endphp

<div class="shared-page">

  {{-- Breadcrumb --}}
  <nav class="shared-breadcrumb">
    <div class="shared-inner--mid">
      <ol class="shared-breadcrumb__list">
        <li><a href="/" class="shared-breadcrumb__link">الرئيسية</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><a href="/fatwas" class="shared-breadcrumb__link">الفتاوى</a></li>
        <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="shared-breadcrumb__sep"><path d="M15 18l-6-6 6-6"/></svg></li>
        <li><span class="shared-breadcrumb__current">فتوى</span></li>
      </ol>
    </div>
  </nav>

  <div class="shared-inner--mid">

    {{-- ══ METADATA — above answer (not below) ════════════════ --}}
    <div class="fatwa-meta-header">
      <div class="shared-sheikh">
        <div class="shared-sheikh__avatar shared-sheikh__avatar--lg">{{ $fatwa['sheikh']['initial'] }}</div>
        <div>
          <div class="shared-sheikh__name" style="font-size:.95rem">{{ $fatwa['sheikh']['name'] }}</div>
          <div class="shared-sheikh__role">{{ $fatwa['sheikh']['title'] }}</div>
        </div>
      </div>
      <div class="fatwa-meta-header__right">
        <span class="shared-tag shared-tag--{{ $fatwa['section'] }}">فقه</span>
        <span class="fatwa-meta-header__date">{{ $fatwa['date'] }}</span>
      </div>
    </div>

    {{-- ══ QUESTION ════════════════════════════════════════════ --}}
    <div class="fatwa-question">
      <p class="fatwa-question__label">السؤال</p>
      <p class="fatwa-question__text">{{ $fatwa['question'] }}</p>
    </div>

    {{-- ══ ANSWER — hierarchical (ruling → evidence → detail) ═ --}}
    <div class="fatwa-answer">

      {{-- 1. Ruling — prominent first sentence --}}
      <div class="fatwa-answer__ruling">
        <div class="fatwa-answer__ruling-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <p class="fatwa-answer__ruling-text">{{ $fatwa['verdict'] }}</p>
      </div>

      {{-- 2. Evidence --}}
      <div class="fatwa-answer__evidence">
        <p class="fatwa-answer__evidence-label">الدليل</p>
        <p>قال الله تعالى: ﴿خُذْ مِنْ أَمْوَالِهِمْ صَدَقَةً تُطَهِّرُهُمْ وَتُزَكِّيهِم بِهَا﴾ [التوبة: ١٠٣]
          والخطاب في الآية عام يشمل الأطفال وغيرهم.</p>
        <p>وعن ابن عمر رضي الله عنهما أن النبي ﷺ قال: «ابتغوا في مال اليتيم لا تأكله الصدقة» رواه الترمذي.</p>
      </div>

      {{-- 3. Detail --}}
      <div class="fatwa-answer__detail">
        <h3 class="fatwa-answer__detail-title">التفصيل</h3>
        <p>ذهب جمهور أهل العلم — ومنهم الأئمة الثلاثة مالك والشافعي وأحمد — إلى أن الزكاة تجب في مال الصبي إذا بلغ النصاب وحال عليه الحول، ويُخرجها وليُّه عنه.</p>
        <p>وخالف في ذلك أبو حنيفة فقال لا تجب الزكاة في مال الصبي لأنها عبادة وهو ليس مكلفاً، والأرجح قول الجمهور للأدلة المتقدمة.</p>
        <p>وعلى هذا فعلى وليّ اليتيم أو الطفل أن يُخرج الزكاة من ماله إذا بلغ النصاب وهو ربع العشر في النقود أي (٢٫٥٪) وحال عليه الحول الهجري.</p>
      </div>
    </div>

    {{-- ══ SHARE OPTIONS ════════════════════════════════════════ --}}
    <div class="fatwa-share" x-data="{ copied: false }">
      <p class="fatwa-share__label">مشاركة الفتوى</p>
      <div class="shared-share-row">
        <button class="shared-share-btn"
                :class="{ 'shared-share-btn--copied': copied }"
                @click="navigator.clipboard?.writeText(window.location.href); copied=true; setTimeout(()=>copied=false,2000)">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          <span x-text="copied ? 'تم النسخ!' : 'نسخ الرابط'"></span>
        </button>
        <button class="shared-share-btn"
                @click="navigator.clipboard?.writeText(`السؤال: {{ $fatwa['question'] }}\nالجواب: {{ $fatwa['verdict'] }}\nالمفتي: {{ $fatwa['sheikh']['name'] }}`)">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          نسخ الفتوى كاملة
        </button>
        <a href="https://wa.me/?text={{ urlencode('فتوى: '.$fatwa['question'].' — '.$fatwa['verdict']) }}"
           target="_blank" class="shared-share-btn shared-share-btn--whatsapp">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.122 1.524 5.855L.057 24l6.305-1.654A11.954 11.954 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0"/></svg>
          واتساب
        </a>
        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}"
           target="_blank" class="shared-share-btn shared-share-btn--telegram">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
          تيليغرام
        </a>
      </div>
    </div>

    {{-- Related fatwas --}}
    <section class="shared-related">
      <h3 class="shared-related__title">فتاوى ذات صلة</h3>
      <div class="fatwa-related-grid">
        @foreach($related as [$title,$reason,$sec])
          <a href="/fatwa/{{ Str::slug($title) }}" class="shared-related-card">
            <span class="shared-related-card__reason">{{ $reason }}</span>
            <span class="shared-tag shared-tag--{{ $sec==='فقه'?'fiqh':'aqeedah' }}" style="font-size:.62rem;align-self:flex-start">{{ $sec }}</span>
            <h4 class="shared-related-card__title">{{ $title }}</h4>
          </a>
        @endforeach
      </div>
    </section>

  </div>
</div>
@endsection
