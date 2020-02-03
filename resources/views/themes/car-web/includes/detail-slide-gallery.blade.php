@if ($content)
    <div class="card border-0">
        <div class="vehicle-imgSlider owl-carousel owl-theme" data-slider-id="1">
			@if($content->metaValue("thumbnail"))
                <div class="vi-slider-item">
                    <img src="{{ $content->metaValue('thumbnail') }}" alt="">
                </div>
			@endif

            @if($content->metaValue('link'))
            <div class="vi-slider-item">
                <a class="owl-video" href="{{$content->metaValue('link')}}"></a>
            </div>
            @endif

            @for ($i=2; $i<=15; $i++)
				@if ($content->metaValue("image".$i))
                <div class="vi-slider-item">
                    <img src="{{ $content->metaValue("image".$i) }}" alt="">
                </div>
				@endif
            @endfor
        </div>
        <div class="owl-thumbs" data-slider-id="1"> </div>
    </div>
@endif
