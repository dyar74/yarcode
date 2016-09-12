<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 12.09.2016
 * Time: 14:35
 */

$j = 1;
foreach ($portfolios as $portfolio) {
    ?>
    
    <div class="portfolio-modal modal fade" id="portfolioModal<?= $j; ?>" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2><?= $portfolio->name; ?></h2>
                                <?= !empty($portfolio->description) ? $portfolio->description : "" ?>
                                <ul class="list-inline">
                                    <?php
                                    echo !empty($portfolio->date) ? "<li>Date: " . date('F Y', strtotime($portfolio->date)) . "</li>" : "";
                                    echo !empty($portfolio->client) ? "<li>Client: " . $portfolio->client . "</li>" : "";
                                    ?>

                                    <li>Category: <?= $portfolio->category ?></li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Close Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $j ++;
}
?>