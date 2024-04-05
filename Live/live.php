<link rel="stylesheet" href="Live/style_live.css">

<div>
    <div id="videoContainer">
        <iframe id="videoFrame" onload="showFallbackMessage()" src="http://bombastisch:5000" width="640" height="480" frameborder="0"></iframe>
        <div id="fallbackMessage">Streaming not available</div>
    </div>
</div>

<script>
    function showFallbackMessage() {
        const videoFrame = document.getElementById('videoFrame');
        const fallbackMessage = document.getElementById('fallbackMessage');
        fallbackMessage.style.display = 'flex'; // Show the fallback message
        videoFrame.style.display = 'none'; // Hide the video player
    }
</script>