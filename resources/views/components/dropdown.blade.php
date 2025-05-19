{{-- resources/views/components/dropdown.blade.php --}}
@props([
    'align'         => 'right',
    'width'         => '48',
    'dropUp'        => false,
    'contentClasses'=> '',
])

@php
    //
    // 1) figure out horizontal placement
    //
    $alignments = [
        'left'         => 'ltr:origin-top-left rtl:origin-top-right start-0',
        'top'          => 'origin-top',
        'bottom-left'  => 'ltr:origin-bottom-left rtl:origin-bottom-right start-0',
        'bottom-right' => 'origin-bottom-right end-0',
    ];
    $alignmentClasses = $alignments[$align] 
                       ?? $alignments['top'];

    //
    // 2) compute width class
    //
    $widthClasses = [
        '48' => 'w-48',
    ];
    $widthClass = $widthClasses[$width] 
                ?? $width;  // allow passing a custom class if you want

    //
    // 3) decide “drop‐up” vs “drop‐down”
    //
    if ($dropUp) {
        $positionClasses = 'absolute z-50 mb-2 bottom-full';
    } else {
        $positionClasses = 'absolute z-50 mt-2';
    }
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false">
  {{-- trigger --}}
  <div @click="open = ! open">
    {{ $trigger }}
  </div>

  {{-- panel --}}
  <div
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="{{ $positionClasses }} {{ $widthClass }} rounded-md shadow-lg {{ $alignmentClasses }}"
    style="display: none;"
    @click="open = false"
  >
    <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
      {{ $content }}
    </div>
  </div>
</div>
