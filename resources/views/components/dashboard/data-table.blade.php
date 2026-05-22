{{-- data-table.blade.php — Responsive table component
     Usage: <x-dashboard.data-table
               :headers="['العنوان','الشيخ','الحالة','']"
               :rows="$items"
               searchPlaceholder="ابحث..."
               :count="$total"
            />
     Children are the <td> cells per row, passed via named slots
--}}
<div class="dash-table-wrap">
  {{-- Toolbar --}}
  <div class="dash-table-toolbar">
    <div class="dash-table-search">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-muted-day);flex-shrink:0">
        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
      </svg>
      <input
        class="dash-table-search__input"
        type="text"
        x-model="tableQuery"
        placeholder="{{ $searchPlaceholder ?? 'ابحث...' }}"
      >
    </div>
    @if(isset($filters)){{ $filters }}@endif
    <span class="dash-table-count">
      إجمالي: <strong>{{ $count ?? 0 }}</strong> عنصر
    </span>
  </div>

  {{-- Desktop --}}
  <div class="dash-table-desktop">
    <table class="dash-table">
      <thead>
        <tr>
          @foreach($headers ?? [] as $header)
            <th>{{ $header }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>{{ $slot }}</tbody>
    </table>
  </div>

  {{-- Mobile --}}
  <div class="dash-table-mobile">
    {{ $mobile ?? '' }}
  </div>

  {{-- Empty state --}}
  @if(($count ?? 1) === 0)
    <div class="dash-empty">
      <div class="dash-empty__icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
      </div>
      <h3 class="dash-empty__title">لا توجد عناصر</h3>
      <p class="dash-empty__desc">{{ $emptyMessage ?? 'لم يتم إضافة أي عناصر بعد.' }}</p>
    </div>
  @endif
</div>