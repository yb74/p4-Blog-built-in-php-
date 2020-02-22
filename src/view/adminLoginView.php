<?php $title = "adminView"; ?>

<?php ob_start(); ?>

    <h1>Espace de connection d'administration</h1>
    <p><a href="/">Retour à la liste des billets</a></p>

    <form method="post" action="/adminLogin" class="p-5 bg-light">
        <div>
            <label for="admin_name">Nom</label><br />
            <input type="text" id="admin_name" name="admin_name" />
        </div>
        <div>
            <label for="password">password</label><br />
            <input type="password" id="password" name="password" />
        </div>
        <div>
            <input type="submit" name="send_data"/>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>