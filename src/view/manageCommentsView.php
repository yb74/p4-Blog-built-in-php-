<?php $title = 'Manage Comments';
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Manage the reported comments !';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <div class="container">
        <div class="row header-dashboard py-5">
            <div class="col-md-12 text-center">
                <h2>Manage Comments</h2>
                <a href="/admin" class="btn btn-primary">Manage posts</a>
                <a href="/createPost" class="btn btn-primary">Create a post</a>
                <a href="/error" class="btn btn-primary">Test Display Error view</a>
            </div>
        </div>

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="case">
                            <div class="row">
                                <?php foreach ($comments as $comment) : ?>
                                    <div class="col-xl-4 col-lg-6 col-md-12 card py-5 card-dashboard">
                                        <div class="text w-100 pl-md-3">
                                            <p class="text-center">Author</p>
                                            <h3 class="text-center">
                                                <?= strip_tags($comment->getAuthor()) ?>
                                            </h3>
                                            <p class="text-center">Content</p>
                                            <h3 class="text-center">
                                                <?= $comment->getContent() ?>
                                            </h3>
                                            <p class="text-center">Creation date</p>
                                            <h3 class="text-center">
                                                <?= strip_tags($comment->getCommentDateFr()) ?>
                                            </h3>
                                            <p class="text-center">Post ID</p>
                                            <h3 class="text-center">
                                                <?= $comment->getRelatedId() ?>
                                            </h3>
                                            <p class="text-center">Status</p>
                                            <h3 class="text-center">
                                                <?= $comment->getStatus() ?>
                                            </h3>
                                            <br>
                                            <p class="text-center">Available options</p>
                                            <div class="d-flex justify-content-center">
                                                <a href="/deleteComment<?= $comment->getId() ?>"
                                                   class="delete-post btn btn-danger btn-sm mx-2">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>