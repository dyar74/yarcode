<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 13.09.2016
 * Time: 21:53
 */
?>
<!-- Services Section -->
<section id="services">
    <div class="container">
        <?php if (!is_null($services)) { ?>
            <div class="row">

                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row text-center">
                <?php
                $count = 1;

                ?>
                <?php foreach ($services as $service) { ?>

                    <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa <?= $service->icon; ?> fa-stack-1x fa-inverse"></i>
                    </span>
                        <h4 class="service-heading"><?= $service->title; ?></h4>
                        <p class="text-muted"><?= $service->text; ?></p>
                    </div>
                    <?php
                    $count++;
                    if ((int)($count % 4) === 0) {
                        echo "<div></div>";
                    }
                } ?>
            </div>
        <?php } ?>
    </div>
</section>
