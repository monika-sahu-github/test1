<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p><button id="start" onclick="start()">start camera!</button></p>

<div>
 <div style="float:left;margin-right:5px;">
  <p><video id="video-tag" width="240" height="180" autoplay=true/></p>
 </div>
 <div style="float:left">
  <p><img id="image-tag" width="240"> </img></p>
 </div>
</div>
  
<div style="width: 240px">
  <p><button onclick="takePhoto()">take photo</button></p>
 <input type="range" id="zoom-slider" min="0", max="0">
 <output id="zoom-slider-value"></output>
</div>

</body>
<script type="text/javascript">
	const constraints =  { "video": { width: { exact: 320 }}};
var videoTag = document.getElementById('video-tag');
var imageTag = document.getElementById('image-tag');
var zoomSlider = document.getElementById("zoom-slider");
var zoomSliderValue = document.getElementById("zoom-slider-value");
var imageCapturer;

function start() {
  navigator.mediaDevices.getUserMedia(constraints)
    .then(gotMedia)
    .catch(e => { console.error('getUserMedia() failed: ', e); });
}

function gotMedia(mediastream) {
  videoTag.srcObject = mediastream;
  document.getElementById('start').disabled = true;
  
  var videoTrack = mediastream.getVideoTracks()[0];
  imageCapturer = new ImageCapture(videoTrack);

  // Timeout needed in Chrome, see https://crbug.com/711524
  setTimeout(() => {
    const capabilities = videoTrack.getCapabilities()
    // Check whether zoom is supported or not.
    if (!capabilities.zoom) {
      return;
    }
    
    zoomSlider.min = capabilities.zoom.min;
    zoomSlider.max = capabilities.zoom.max;
    zoomSlider.step = capabilities.zoom.step;

    zoomSlider.value = zoomSliderValue.value = videoTrack.getSettings().zoom;
    zoomSliderValue.value = zoomSlider.value;
    
    zoomSlider.oninput = function() {
      zoomSliderValue.value = zoomSlider.value;
      videoTrack.applyConstraints({advanced : [{zoom: zoomSlider.value}] });
    }
  }, 500);
  
}

function takePhoto() {
  imageCapturer.takePhoto()
    .then((blob) => {
      console.log("Photo taken: " + blob.type + ", " + blob.size + "B")
      imageTag.src = URL.createObjectURL(blob);
})
    .catch((err) => { 
      console.error("takePhoto() failed: ", e);
    });
}

</script>
</html>