<?php $title = 'Error';
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='An error has occurred !';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center"><?= $this->msg ?></div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>