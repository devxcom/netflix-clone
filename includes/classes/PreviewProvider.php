<?php
class PreviewProvider
{

    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }
    public function createPreview($entity)
    {

        if ($entity == null) {
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();

        // TODO: ADD SUBTITLE

        $videoId = VideoProvider::getEntityVideoForUser($this->con,$id,$this->username);

        return "<div class='previewContainer'>
    
        <img src='$thumbnail' alt='' class='previewImage' hidden>
    
        <video class='previewVideo' autoplay muted onended='previewEnded()'>
            <source src='$preview' type='video/mp4'>
        </video>

        <div class='previewOverlay'>

            <div class='mainDetails'>
                <h3>$name</h3>
                <div class='buttons'>
                    <button onclick='watchVideo($videoId)'><i class='fa-solid fa-play'></i> Play</button>            
                    <button onclick='volumeToggle(this)'><i class='fa-solid fa-volume-xmark'></i></button>            
                </div>
            </div>
        </div>
    
    </div> ";
    }

    public function createPreviewSquare($entity)
    {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name'>
                    </div>
        
                </a>";
    }

    private function getRandomEntity()
    {

        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}
