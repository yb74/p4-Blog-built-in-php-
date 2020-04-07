<?php $title = htmlspecialchars($post->getTitle());
$picture = $post->getPictureUrl();
$titlePage= htmlspecialchars($post->getTitle());
$subheadingPage= "Posted on : " . $post->getCreationDateFr();
?>

<!--         Display the selected post          -->

<?php ob_start(); ?>
    <section>
        <div class="news">
            <article class="chapter_content mb-4">
                <?= $post->getContent() ?>
            </article>
        </div>
            <a href="<?= '/'?>" class="btn btn-primary my-3">&laquo; Back to chapters list</a>
    <!--         Add Comment Form          -->
        <h2 class="my-3">Comments</h2>
<?php if (!$_SESSION): ?>
    <p>Please, <a href="/connection" class="btn btn-info">Log In</a> to be able to leave a comment !</p>
<?php elseif ($_SESSION['role'] === 'user'): ?>
        <form action="/chapter<?= $post->getId() ?>" method="post" class="p-5 bg-light">
            <div class="form-group <?= $errors['form'] ? 'has-error' : ''; ?>">
                <?php if(!empty($errors['form'])): ?>
                    <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center"><?= $errors['form'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="text" id="author" style= "cursor: not-allowed" name="author" readonly="readonly" value = "<?= $_SESSION['username']  ?>" class="form-control mb-4">
            </div>
            <div class="form-group">
                <label for="content">Comment</label><br />
                <textarea id="content" name="content" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div>
                <input type="submit" value="Post" name="send_data" class="btn py-2 px-3 my-2 btn-primary" />
            </div>
        </form>
<?php endif; ?>

    <!--         Display all comments           -->
        <?php
foreach ($comments as $comment)
        {
            ?>

            <div class="container comment-zone p-4 mx-auto bg-light">
                <div class="media mt-3 p-3 bg-white comment-bubble">
                    <div class="media-body">
                        <div class="row">
                            <p class="comment-username mt-0 mx-2"><?= $comment->getAuthor(); ?></p>
                            <span class="font-weight-lighter font-italic"><?= $comment->getCommentDateFr(); ?></span>
                        </div>
                        <div class="row">
                            <p class="col-12 p-0 mt-0 mx-2 mb-0"><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
                            <?php if ($_SESSION): ?>
                                <?php if ($_SESSION['role'] === 'user'): ?>
                                    <?php if ($comment->getStatus() == 0): ?>
                                        <a href="<?= '/reportComment'?><?= $comment->getId() ?>">
                                            <button class="btn btn-danger ml-5 mt-3">Report</button>
                                        </a>
                                    <?php else : ?>
                                        <span class = "col-lg-8 col-md-10 mx-auto alert alert-danger text-center"> Comment reported ! </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <?php
}
?>



<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>