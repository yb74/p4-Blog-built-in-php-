<?php $title = "Connection";
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Log In space';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <section>
        <form action="/connection" method="post" class="bg-light p-4 p-md-5 contact-form">
            <div class="form-group <?= $errors['form'] ? 'has-error' : ''; ?>">
                <?php if(!empty($errors['form'])): ?>
                    <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center form-control" id="connectionError"><?= $errors['form'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php if(isset($_POST['username'])) {echo $_POST['username'];} ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary py-3 px-5 btn-login" value="Log In" name="send_data">
                <input type="reset" class="btn btn-primary py-3 px-5 btn-login" value="Reset">
            </div>
            <p>Not a member?
                <a href="/registration">Register</a>
            </p>
        </form>

        <a href="/">
            <button class="btn btn-primary mt-3">&laquo; Back to the posts</button>
        </a>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>