<?php $title = 'Logout';
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Thank you for your visit !';
$subheadingPage='We hope to see you soon !';
?>

<?php ob_start(); ?>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="text text-center">
                    <a href="<?= '/'?>" class="btn btn-primary my-3">&laquo; Back to chapters list</a>
                </div>

            </div>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>