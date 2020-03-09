<?php $title = 'Single ticket for Alaska'; ?>

<?php ob_start(); ?>
    <section>
        <h1>Welcome to my blog !</h1>

        <a href="/">
            <button class="btn btn-info">&laquo; Back to the posts</button>
        </a>
        <a href="/connection">
            <button class="btn btn-info">Log In</button>
        </a>
    </section>
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>