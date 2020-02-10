<div class="maz-loader" id="demo-spinner" role="status">
  <div id="maz-loading"></div>
  <span class="sr-only">Loading...</span>
</div>

<script>
    var animation = bodymovin.loadAnimation({
    container: document.getElementById('maz-loading'),
    renderer: 'svg',
    loop: true,
    rendererSettings: {
        progressiveLoad: true
    },
    autoplay: true,
    path: '{{ asset("car-web/animation/loading.json")}}'
});
</script>