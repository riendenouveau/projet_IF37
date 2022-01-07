<div class="w3-content w3-display-container" style="max-width:800px;height:30vh;width:80%;background-color :rgba(221, 231, 240, 0);">
    <?php
        foreach($images as $image){
            $nomImage = $image['nom'];
            echo ('<img class="mySlides" src = "' . $nomImage . '"  style="height:100%; max-width:100%;margin:auto;" />' );
        }
    ?>
    <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
        <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
        <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
        <?php
            $index=0;
            foreach($images as $image){
                $index++;
                echo ('<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(' . $index .')"></span>');
            }
        ?>
    </div>
</div>

<style>
    .w3-left, .w3-right{
        color : rgba(51, 51, 51,1);
        font-size : 1.5em;
    }
</style>