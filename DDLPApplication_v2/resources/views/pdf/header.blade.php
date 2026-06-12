<div style="width: 100%; text-align: center; margin-bottom: 20px;">
    <?php 
        $headerImage = public_path('images/entete_officielle.png');
        if(file_exists($headerImage)) {
            $imageData = base64_encode(file_get_contents($headerImage));
            echo '<img src="data:image/png;base64,' . $imageData . '" style="width: 100%; max-height: 150px; object-fit: contain;">';
        }
    ?>
</div>
