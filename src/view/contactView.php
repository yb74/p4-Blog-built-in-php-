<?php $title = "Contact";
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage= 'Contact me';
$subheadingPage='';
?>

<?php ob_start(); ?>



    <section>
        <form action="/contact" method="post" class="bg-light p-4 p-md-5 contact-form">
            <p class="text-center h4 mb-4"><?= $successMessage ?> </p>
            <div class="form-group <?= $errors['form'] ? 'has-error' : ''; ?>">
                <?php if(!empty($errors['form'])): ?>
                    <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center form-control" id="contactError"><?= $errors['form'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="fullname">Name</label><br />
                <input type="text" name="fullname" class="form-control" value="<?php if(isset($_POST['fullname'])) {echo $_POST['fullname'];} ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label><br />
                <input type="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label><br />
                <input type="text" name="subject" class="form-control">
            </div>
            <div class="text-center form-group">
                <label for="message" class="text-center">Message</label><br />
                <textarea id="message" name="message" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-contact py-3 px-5" value="Send message" name="send_data">
                <input type="reset" class="btn btn-primary btn-contact py-3 px-5" value="Reset">
            </div>
        </form>

        <a href="/">
            <button class="btn btn-primary mt-3">&laquo; Back to the posts</button>
        </a>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>