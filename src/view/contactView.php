<?php $title = "Contact";
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage= 'Contact me';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <section>
        <form class="border border-light p-5" action="/contact" method="post">
            <p class="text-center h4 mb-4"><?= $successMessage ?> </p>
            <div class="form-group <?= $errors['form'] ? 'has-error' : ''; ?>">
                <?php if(!empty($errors['form'])): ?>
                    <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center"><?= $errors['form'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group <?= $errors['fullname'] ? 'has-error' : ''; ?>">
                <label for="fullname">Name</label><br />
                <input type="text" id="fullname" name="fullname" class="form-control mb-4" placeholder="Your name" value="<?php if(isset($_POST['fullname'])) {echo $_POST['fullname'];} ?>">
                <span class="help-block text-danger"><?= $errors['fullname'] ?></span>
            </div>
            <div class="form-group <?= $errors['email'] ? 'has-error' : ''; ?>">
                <label for="email">Email</label><br />
                <input type="email" id="email" name="email" class="form-control mb-4" placeholder="Your email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">
                <span class="help-block text-danger"><?= $errors['email'] ?></span>
            </div>
            <div class="form-group <?= $errors['subject'] ? 'has-error' : ''; ?>">
                <label for="subject">Subject</label><br />
                <input type="text" id="subject" name="subject" class="form-control mb-4" placeholder="Your subject" value="<?php if(isset($_POST['subject'])) {echo $_POST['subject'];} ?>">
                <span class="help-block text-danger"><?= $errors['subject'] ?></span>
            </div>
            <div class="text-center form-group <?= $errors['message'] ? 'has-error' : ''; ?>">
                <label for="message" class="text-center">Message</label><br />
                <textarea id="message" name="message" cols="30" rows="5" class="form-control"><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
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