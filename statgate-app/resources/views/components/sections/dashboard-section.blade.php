@props([
  'description',
  'image',
  'image_pos' => '', // flex-row, flex-row-reversed, flex-col, flex-col-reversed
  'section_class' => '',
  'desc_class' => '',
  'redirect' => '',
])

<div id="albion_section--char" class="my-4 {{ $section_class }}">
    <div class="flex flex-col {{ $image_pos }}">
      <img src="{{ $image }}" alt="" loading="lazy" class="rounded-lg">
      <div class="flex justify-center flex-col items-center m-auto my-6 xl:my-12 px-2 {{ $desc_class }}">
          <h1 class="text-xl font-bold">{{ $description }}</h1>
          <a class="{{ $redirect ? 'albion-btn albion-btn-main mt-6' : 'hidden' }}" href="{{ $redirect }}">Click here</a>
      </div>
    </div>
</div>