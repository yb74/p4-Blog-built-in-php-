<?php $title = 'Error'; ?>

<?php ob_start(); ?>


        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                 data-scrollax-parent="true">
                <div class="col-md-12 ftco-animate">
                    <h1 class="mb-4 mb-md-0"><?= 'Error' ?></h1>
                    <p><?= "error message" ?></p>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="text">
                                <div class="mouse">
                                    <a href="#" class="mouse-icon">
                                        <div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>