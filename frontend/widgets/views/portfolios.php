<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 12.09.2016
 * Time: 11:04
 */
?>
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <?php if (!is_null($portfolios)) {
    $i = 1;
    ?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-heading">Portfolio</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
    </div>
    <div class="row">
        <?php foreach ($portfolios as $item) { ?>
            <div class="col-md-4 col-sm-6 portfolio-item">

                <a href="#portfolioModal<?= $i ?>" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="<?= $item->getImageFileUrl('image'); ?>" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4><?= $item->title; ?></h4>
                    <p class="text-muted"><?= !empty($item->category) ? $item->category : ""; ?></p>
                </div>
            </div>
            <?php
            $i++;
            if ((int)($i % 4) === 0) {
                echo "<div></div>";
            }
        }
        ?>
     </div>
<?php } ?>
</div>
</section>
