<?php $title = 'Dashboard';
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Dashboard';
if ($_SESSION):
    $subheadingPage ='Welcome ' . $_SESSION['role'] . ' !';
else:
    $subheadingPage = "";
endif;
?>

<?php ob_start(); ?>

        <div class="row header-dashboard py-5">
            <div class="col-md-12 text-center">
                <h2>Posts</h2>
                <a href="/manageUsers" class="btn btn-primary btn-dashboard">Users list</a>
                <a href="/manageComments" class="btn btn-primary btn-dashboard">Reported comments</a>
                <a href="/createPost" class="btn btn-primary btn-dashboard">Create a post</a>
            </div>
        </div>

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="case">
                            <div class="row">
                                <?php
                                foreach ($posts as $post) {
                                    ?>
                                    <div class="col-xl-4 col-lg-6 col-md-12 card py-5 card-dashboard">
                                        <div class="text w-100 pl-md-3">
                                            <img src="<?= $post->getPictureUrl() ?>" class="img-fluid mb-3" alt="Responsive image">
                                            <p class="text-center">Title</p>
                                            <h3 class="text-center">
                                                <?= $post->getTitle() ?>
                                            </h3>
                                            <p class="text-center">Creation date</p>
                                            <h3 class="text-center">
                                                <?= $post->getCreationDateFr() ?>
                                            </h3>
                                            <br>
                                            <p class="text-center">Available options</p>
                                            <div class="d-flex justify-content-center">
                                                <a href="/chapter<?= $post->getId() ?>" class="btn btn-primary btn-sm mx-2 display-button">See</a>
                                                <a href="/modifyPost<?= $post->getId() ?>" class="btn btn-warning btn-sm mx-2 modify-button">Modify</a>
                                                <a href="/deletePost<?= $post->getId() ?>" class="delete-post btn btn-danger btn-sm mx-2 delete-button">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>