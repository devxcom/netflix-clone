<?php
require_once("includes/header.php");

if (!isset($_GET['id'])) {
    ErrorMessage::show("No id passed into page");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();

$upNextVideo = VideoProvider::getUpNext($con,$video)

?>

<div class="watchContainer">

    <div class="videoControls watchNav">
        <button onclick="goBack()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <h2><?php echo $video->getTitle(); ?></h2>
    </div>

    <div class="videoControls upNext" style="display:none;">
        <button onclick="restartVideo()"> 
        <i class="fa-solid fa-rotate-right"></i> 
        </button>
        <div class="upNextContainer">
            <h2>Up Next :</h2>
            <h3><?php echo $upNextVideo->getTitle(); ?></h3>
            <h3><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>
            
            <button class="playNext" onclick="watchVideo(<?php echo $upNextVideo->getId(); ?>)">
            <i class="fa-solid fa-play"></i> Play
            </button>
        </div>
    </div>


    <video controls autoplay onended="showUpNext()">
        <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>
<script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn ?>");
</script>