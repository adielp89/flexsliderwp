<?php
$gallery_wp = get_field('galeria_de_fotos_alojamiento');
//var_dump ($gallery_wp);
if( $gallery_wp ): ?>
    <div id="slider" class="flexslider">
        <ul class="slides flex-direction-nav">
            <?php foreach( $gallery_wp as $image ): ?>
                <li>
                    <img src="<?php echo $image['sizes']['newsmag-slider-flexslider']; ?>" alt="<?php echo $image['alt']; ?>" />
                   <!-- <p class="flex-caption"><?php // echo $image['caption']; ?></p> -->
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="carousel" class="flexslider">
        <ul class="slides">
            <?php foreach( $gallery_wp as $image ): ?>
                <li>
                    <img src="<?php echo $image['sizes']['newsmag-carousel-flexslider']; ?>" alt="<?php echo $image['alt']; ?>" />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>