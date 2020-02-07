@if ($content)
    <div class="card border-0">
        <div class="vehicle-imgSlider owl-carousel owl-theme" data-slider-id="1">
            @if($content->metaValue('link'))
            <div class="vi-slider-item">

            <div id="player"></div>

            <script>
                var str = "{{ $content->metaValue('link') }}" 
                var split =str.split("=");
                var vidID = split[1];
            </script>

<script>
  // 2. This code loads the IFrame Player API code asynchronously.
  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // 3. This function creates an <iframe> (and YouTube player)
  //    after the API code downloads.
  var player;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
      height: '100%',
      width: '100%',
      videoId: vidID,
    //   mediaContentUrl: "{{ $content->metaValue('link') }}",
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
    });
  }

  // 4. The API will call this function when the video player is ready.
  function onPlayerReady(){
    //  player.loadVideoByUrl("{{ $content->metaValue('link') }}");
     player.playVideo();
     player.stopVideo();
}

  // 5. The API calls this function when the player's state changes.
  //    The function indicates that when playing a video (state=1),
  //    the player should play for six seconds and then stop.
  var done = false;
  function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
      setTimeout(stopVideo, 3000);
      done = true;
    }
  }
  function stopVideo() {
    player.stopVideo();
  }
</script>

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
