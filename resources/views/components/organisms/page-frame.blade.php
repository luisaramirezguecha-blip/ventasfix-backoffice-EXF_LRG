@props(['title', 'subtitle' => null])
<div class="page-shell">
  <div {{ $attributes->merge(['class' => 'page-card manuscript-frame']) }}>
    <x-atoms.icon-ogival />
    <h1 class="page-title">{{ $title }}</h1>
    @if($subtitle)
        <p class="page-subtitle">{{ $subtitle }}</p>
    @endif
    {{ $slot }}
  </div>
</div>
