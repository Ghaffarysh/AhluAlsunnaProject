{{-- stats-card.blade.php
     Usage: <x-dashboard.stats-card label="المقررات" value="٢٤٧" icon="primary" delta="+٣ هذا الأسبوع" />
--}}
<div class="dash-stat-card">
  <div class="dash-stat-card__top">
    <span class="dash-stat-card__label">{{ $label }}</span>
    <div class="dash-stat-card__icon dash-stat-card__icon--{{ $icon ?? 'primary' }}">
      {{ $slot }}
    </div>
  </div>
  <div class="dash-stat-card__value">{{ $value }}</div>
  @if(isset($delta))
    <span class="dash-stat-card__delta">
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
      </svg>
      {{ $delta }}
    </span>
  @endif
</div>