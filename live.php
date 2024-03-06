<link rel="stylesheet" href="style_live.css">

<div>
    <div id="videoContainer">
        <video id="videoPlayer" controls>
            <source src="video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div id="fallbackMessage">Cam not currently available</div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const videoPlayer = document.getElementById('videoPlayer');
        const fallbackMessage = document.getElementById('fallbackMessage');

        // Check if the video can be played
        setTimeout( function(){
            console.log(videoPlayer.readyState)
            if (videoPlayer.readyState === 0) {
                showFallbackMessage();
            }
        }, 5000);
        function showFallbackMessage() {
            fallbackMessage.style.display = 'flex'; // Show the fallback message
            videoPlayer.style.display = 'none'; // Hide the video player
        }

    });
</script>
