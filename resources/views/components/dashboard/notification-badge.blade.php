{{-- notification-badge.blade.php
     Usage: <x-dashboard.notification-badge :count="7" />
--}}
@if($count > 0)
  <span class="dash-nav-badge">{{ $count > 99 ? '99+' : $count }}</span>
@endif