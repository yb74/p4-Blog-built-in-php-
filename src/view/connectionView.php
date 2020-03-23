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
            <div class="form-group <?= $this->empty_inputs_err ? 'has-error' : ''; ?>">
                <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center"><?= $this->empty_inputs_err; ?></span>
            </div>
            <input type="text" id="username" name="username" class="form-control mb-4" placeholder="Username">
            <div class="form-group <?= $this->username_err ? 'has-error' : ''; ?>">
                <span class="help-block"><?= $this->username_err; ?></span>
            </div>
            <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password">
            <div class="form-group <?= $this->password_err ? 'has-error' : ''; ?>">
                <span class="help-block"><?= $this->password_err; ?></span>
            </div>

            <div class="d-flex justify-content-around">
                <div>
                    <!-- Remember me -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                        <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                    </div>
                </div>
                <div>
                    <!-- Forgot password -->
                    <a href="">Forgot password?</a>
                </div>
            </div>

            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4" type="submit" name="send_data">Log In</button>

            <!-- Register -->
            <p>Not a member?
                <a href="/registration">Register</a>
            </p>

            <!-- Social login -->
            <p>or sign in with:</p>

            <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

        </form>

        <a href="/">
            <button class="btn btn-primary">&laquo; Back to the posts</button>
        </a>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>