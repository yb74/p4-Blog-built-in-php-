<?php $title = "Contact";
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage= 'Contact me';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <section>

        <form class="text-center border border-light p-5" action="/contact" method="post">
            <p class="h4 mb-4"><?= $successMessage ?> </p>
            <div class="form-group <?= $errors['form'] ? 'has-error' : ''; ?>">
                <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center"><?= $errors['form'] ?></span>
            </div>
            <input type="text" id="fullname" name="fullname" class="form-control mb-4" placeholder="Your name">
            <div class="form-group <?= $errors['fullname'] ? 'has-error' : ''; ?>">
                <span class="help-block text-danger"><?= $errors['fullname'] ?></span>
            </div>
            <input type="email" id="password" name="email" class="form-control mb-4" placeholder="Your email">
            <div class="form-group <?= $errors['email'] ? 'has-error' : ''; ?>">
                <span class="help-block text-danger"><?= $errors['email'] ?></span>
            </div>
            <div class="form-group <?= $errors['message'] ? 'has-error' : ''; ?>">
                <label for="message">Comment</label><br />
                <textarea id="message" name="message" cols="30" rows="5" class="form-control"></textarea>
                <span class="help-block text-danger"><?= $errors['message'] ?></span>
            </div>

            <button class="btn btn-info btn-block my-4" type="submit" name="send_data">Send message</button>

        </form>

        <a href="/">
            <button class="btn btn-primary">&laquo; Back to the posts</button>
        </a>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>