<?php $title = 'Create a post';
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Post creation';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ftco-animate">
                    <!-- "enctype" is used to upload the files -->
                    <form action="/createPost" method="post" enctype="multipart/form-data" class="p-5 bg-light">
                        <div class="form-group <?= $errors['form'] ? 'has-error' : ''; ?>">
                            <?php if(!empty($errors['form'])): ?>
                                <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center form-control" id="createError"><?= $errors['form'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="picture_url">Picture</label><br/>
                            <input type="file" name="picture_url" id="picture_url" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label><br/>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label><br/>
                            <textarea name="content" id="adminForm" cols="160" rows="30" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Post" class="btn py-3 px-4 btn-primary">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>