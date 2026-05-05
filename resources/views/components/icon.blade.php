@props(['name', 'label' => null])

@php
  $icons = [
    'alert-triangle' => '<path d="m21.7 18.6-8.5-14.8a1.4 1.4 0 0 0-2.4 0L2.3 18.6A1.4 1.4 0 0 0 3.5 20.8h17a1.4 1.4 0 0 0 1.2-2.2Z"/><path d="M12 9v4"/><path d="M12 17h.01"/>',
    'arrow-up' => '<path d="m5 12 7-7 7 7"/><path d="M12 19V5"/>',
    'bar-chart' => '<path d="M3 3v18h18"/><path d="M7 16v-5"/><path d="M12 16V7"/><path d="M17 16v-8"/>',
    'book-open' => '<path d="M12 7v14"/><path d="M3 5.5A2.5 2.5 0 0 1 5.5 3H12v18H5.5A2.5 2.5 0 0 1 3 18.5z"/><path d="M21 5.5A2.5 2.5 0 0 0 18.5 3H12v18h6.5a2.5 2.5 0 0 0 2.5-2.5z"/>',
    'bot' => '<path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="3"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M9 13h.01"/><path d="M15 13h.01"/><path d="M9 17h6"/>',
    'brain' => '<path d="M9.5 2A3.5 3.5 0 0 0 6 5.5v.2A3.5 3.5 0 0 0 4 12a3.5 3.5 0 0 0 3.5 6H9"/><path d="M14.5 2A3.5 3.5 0 0 1 18 5.5v.2A3.5 3.5 0 0 1 20 12a3.5 3.5 0 0 1-3.5 6H15"/><path d="M9 2v20"/><path d="M15 2v20"/><path d="M9 8H7"/><path d="M17 8h-2"/><path d="M9 16H7"/><path d="M17 16h-2"/>',
    'calendar' => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>',
    'camera' => '<path d="M14.5 4 16 7h3a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h3l1.5-3z"/><circle cx="12" cy="13" r="3"/>',
    'check' => '<path d="m20 6-11 11-5-5"/>',
    'clipboard' => '<rect width="14" height="18" x="5" y="4" rx="2"/><path d="M9 4a3 3 0 0 1 6 0"/><path d="M9 12h6"/><path d="M9 16h4"/>',
    'eye' => '<path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/>',
    'file-text' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h8"/><path d="M8 17h5"/>',
    'flame' => '<path d="M8.5 14.5A4.5 4.5 0 0 0 12 22a6 6 0 0 0 6-6c0-4-3-6-4-9-.2 2-1.2 3.2-2.5 4.2C10 9.5 9.8 7.6 10.5 5 7 7.5 5 10.5 5 14a7 7 0 0 0 7 8"/>',
    'home' => '<path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/>',
    'key' => '<circle cx="7.5" cy="14.5" r="4.5"/><path d="M11 11 21 1"/><path d="m17 5 2 2"/><path d="m14 8 2 2"/>',
    'lock' => '<rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
    'mic' => '<path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><path d="M12 19v3"/>',
    'party' => '<path d="m5 22 14-14"/><path d="m5 22 4-12 8 8z"/><path d="M14 5h.01"/><path d="M18 2h.01"/><path d="M22 6h.01"/><path d="M20 11h.01"/>',
    'pencil' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/>',
    'school' => '<path d="m4 10 8-5 8 5"/><path d="M6 11v8"/><path d="M18 11v8"/><path d="M3 19h18"/><path d="M10 19v-5h4v5"/><path d="M8 12h.01"/><path d="M16 12h.01"/>',
    'search' => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
    'sparkles' => '<path d="m12 3 1.7 4.3L18 9l-4.3 1.7L12 15l-1.7-4.3L6 9l4.3-1.7z"/><path d="m19 15 .8 2.2L22 18l-2.2.8L19 21l-.8-2.2L16 18l2.2-.8z"/><path d="m5 4 .8 2.2L8 7l-2.2.8L5 10l-.8-2.2L2 7l2.2-.8z"/>',
    'star' => '<path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8-6.2-3.3L5.8 21 7 14.2 2 9.3l6.9-1z"/>',
    'target' => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
    'trash' => '<path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="m19 6-1 14H6L5 6"/><path d="M10 11v5"/><path d="M14 11v5"/>',
    'trending-up' => '<path d="m3 17 6-6 4 4 8-8"/><path d="M14 7h7v7"/>',
    'trophy' => '<path d="M8 21h8"/><path d="M12 17v4"/><path d="M7 4h10v5a5 5 0 0 1-10 0z"/><path d="M7 6H4a2 2 0 0 0 2 4h1"/><path d="M17 6h3a2 2 0 0 1-2 4h-1"/>',
    'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/>',
    'volume' => '<path d="M11 5 6 9H2v6h4l5 4z"/><path d="M15.5 8.5a5 5 0 0 1 0 7"/><path d="M19 5a10 10 0 0 1 0 14"/>',
    'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
    'zap' => '<path d="M13 2 4 14h7l-1 8 9-12h-7z"/>',
  ];
@endphp

<svg
  {{ $attributes->merge(['class' => 'readerly-icon']) }}
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
  @if($label)
    role="img"
    aria-label="{{ $label }}"
  @else
    aria-hidden="true"
  @endif
  style="width:1em;height:1em;display:inline-block;vertical-align:-.125em;flex-shrink:0"
>
  {!! $icons[$name] ?? $icons['user'] !!}
</svg>
