<?php $title = "admin"; ?>

<?php ob_start(); ?>

    <h1>Espace d'administration</h1>
    <p><a href="/">Retour à la liste des billets</a></p>

    <form method="post" action="" class="p-5 bg-light">
        <div>
            <label for="edit_post">Editer l'article</label><br />
            <textarea id="edit_post" name="edit_post"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>