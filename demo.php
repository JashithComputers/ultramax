<?php
include_once 'lib_security.php';
$stream = isset($_GET['stream']) ? $_GET['stream'] : 'ultramax';
?>


<style>
body, iframe, video {
    margin: 0;
    padding: 0;
    background: #000;
    position: fixed;
    width: 100%;
    height: 100%;
}
</style>
<script src="https://cdn.jsdelivr.net/hls.js/latest/hls.min.js"></script>
<video controls id="video"></video>
<script>
  if(Hls.isSupported()) {
    var video = document.getElementById('video');
    var hls = new Hls();
    hls.loadSource('http://site1.ultramaxnet.com/live/<?php echo $stream;?>/index.m3u8?ts=<?php echo time();?>');
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
      video.play();
  });
 }
</script>
