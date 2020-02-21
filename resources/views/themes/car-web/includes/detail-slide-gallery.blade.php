@if ($content)
    <div class="card border-0">
        <div class="vehicle-imgSlider owl-carousel owl-theme" data-slider-id="1">
            @if($content->youtubeLink())
            <div class="vi-slider-item">

            <div id="player"></div>

            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $content->youtubeLink() }}" frameborder="0"
              allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            </div>
            @endif

			@if($content->metaValue("thumbnail"))
                <div class="vi-slider-item">
                    <img src="{{ $content->metaValue('thumbnail') }}" alt="">
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
