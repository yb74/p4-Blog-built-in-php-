<?php $title = htmlspecialchars($post['post_title']); ?>

<?php ob_start(); ?>
    <div style="background-image: url('<?= $post['post_picture'] ?>'); background-size: cover;">
        <div class="jumbotron jumbotron-fluid">
            <div class="container chapter-title">
                <h1 class="display-4"><?= htmlspecialchars($post['post_title']) ?></h1>
                <h3 class="lead"><?= $post['creation_date_fr'] ?></h3>
            </div>
        </div>
    </div>


<div class="news">
    <p>
        <?= nl2br(htmlspecialchars($post['post_content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<form action="/post/<?= $post['post_id'] ?>" method="post" class="p-5 bg-light">
    <div>
        <label for="comment_author">Auteur</label><br />
        <input type="text" id="comment_author" name="comment_author" />
    </div>
    <div>
        <label for="comment_content">Commentaire</label><br />
        <textarea id="comment_content" name="comment_content"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while ($comment = $comments->fetch())
{
    ?>

    <div class="container comment-zone p-4 mx-auto bg-light">
        <div id="report-message"></div>
        <div class="media mt-3 p-3 bg-white comment-bubble">
            <img src="public/images/profile_pictures/155678948553782604_2525062594189150_7288303766074294272_o (2).jpg" class="mr-3 profile-picture align-middle" alt="profile picture">
            <div class="media-body">
                <div class="row">
                    <p class="comment-username mt-0 mx-2"><?= htmlspecialchars($comment['comment_author']) ?></p>
                    <span class="font-weight-lighter font-italic"><?= $comment['comment_date_fr'] ?></span>
                </div>
                <div class="row">
                    <p class="comment-title p-0 col-12 mt-0 mx-2 mb-1">Sujet du commentaire</p>
                    <p class="col-12 p-0 mt-0 mx-2 mb-0"><?= nl2br(htmlspecialchars($comment['comment_content'])) ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>