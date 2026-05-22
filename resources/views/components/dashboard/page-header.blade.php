{{-- page-header.blade.php
     Usage: <x-dashboard.page-header title="عنوان الصفحة" sub="وصف مختصر">
               <x-slot:actions>...buttons...</x-slot:actions>
             </x-dashboard.page-header>
--}}
<div class="dash-page-header">
  <div class="dash-page-header__text">
    <h1 class="dash-page-header__title">{{ $title }}</h1>
    @if(isset($sub))<p class="dash-page-header__sub">{{ $sub }}</p>@endif
  </div>
  @if(isset($actions))
    <div class="dash-page-header__actions">{{ $actions }}</div>
  @endif
</div>