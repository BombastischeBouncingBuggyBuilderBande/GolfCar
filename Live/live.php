<link rel="stylesheet" href="Live/style_live.css">
<iframe id="videoFrame" onload="showFallbackMessage()" src="http://bombastisch:5000"></iframe>

<div>
    <div id="videoContainer">
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