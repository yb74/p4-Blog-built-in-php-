<?php $title = 'Admin'; ?>

<?php ob_start(); ?>


        <div class="row header-dashboard py-5">
            <div class="col-md-12 text-center">
                <h2>Posts</h2>
                <a href="/manageComments" class="btn btn-primary">Manage comments</a>
                <a href="createPost" class="btn btn-primary">Create a post</a>
            </div>
        </div>

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="case">
                            <div class="row">
                                <?php
                                foreach ($comments as $comment) {
                                    ?>
                                    <div class="col-xl-4 col-lg-6 col-md-12 card py-5 card-dashboard">
                                        <div class="text w-100 pl-md-3">
                                            <img src="<?= $comment->getPictureUrl() ?>" class="img-fluid mb-3" alt="Responsive image">
                                            <p class="text-center">Title</p>
                                            <h3 class="text-center">
                                                <?= $comment->getTitle() ?>
                                            </h3>
                                            <p class="text-center">Comments number</p>
                                            <h3 class="text-center">
                                                <?= $comment->getNbComments() ?>
                                            </h3>
                                            <p class="text-center">Creation date</p>
                                            <h3 class="text-center">
                                                <?= $comment->getPostDate() ?>
                                            </h3>
                                            <br>
                                            <p class="text-center">Available options</p>
                                            <div class="d-flex justify-content-center">
                                                <a href="/chapter<?= $comment->getPostId() ?>" class="btn btn-primary btn-sm mx-2 display-button">See</a>
                                                <a href="/modifyPost<?= $comment->getPostId() ?>" class="btn btn-warning btn-sm mx-2 modify-button">Modify</a>
                                                <a href="/deletePost<?= $comment->getPostId() ?>" class="delete-post btn btn-danger btn-sm mx-2 delete-button">Delete</a>
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