<?php $title = "Connection";
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Log In space';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <section>

        <!-- Default form login -->
        <form class="text-center border border-light p-5" action="/connection" method="post">
            <p class="h4 mb-4">Log In</p>
            <div class="form-group <?= $errors['form'] ? 'has-error' : ''; ?>">
                <?php if(!empty($errors['form'])): ?>
                    <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center"><?= $errors['form'] ?></span>
                <?php endif; ?>
            </div>
            <input type="text" id="username" name="username" class="form-control mb-4" placeholder="Username" value="<?php if(isset($_POST['username'])) {echo $_POST['username'];} ?>">
            <div class="form-group <?= $errors['username'] ? 'has-error' : ''; ?>">
                <span class="help-block text-danger"><?= $errors['username'] ?></span>
            </div>
            <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password">
            <div class="form-group <?= $errors['password'] ? 'has-error' : ''; ?>">
                <span class="help-block text-danger"><?= $errors['password'] ?></span>
            </div>

            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4" type="submit" name="send_data">Log In</button>

            <!-- Register -->
            <p>Not a member?
                <a href="/registration">Register</a>
            </p>

        </form>

        <a href="/">
            <button class="btn btn-primary">&laquo; Back to the posts</button>
        </a>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>