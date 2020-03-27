<?php $title = 'Modify a post';
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Modify a post';
$subheadingPage='';
?>

<?php ob_start(); ?>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ftco-animate">
                <form action="/modifyPost<?= $post->getId(); ?>" method="post"
                      class="p-5 bg-light">
                    <div class="form-group <?= $this->empty_inputs_err ? 'has-error' : ''; ?>">
                        <span class="col-lg-8 col-md-10 mx-auto alert alert-danger text-center"><?= $this->empty_inputs_err; ?></span>
                    </div>
                    <div class="form-group <?= $this->modifyTitle_help ? 'has-error' : ''; ?>">
                        <label for="title">Title</label><br/>
                        <span class="help-block text-danger"><?= $this->modifyTitle_help; ?></span>
                        <input type="text" name="title" id="title" cols="30" rows="10"
                               class="form-control" value="<?= $post->getTitle() ?>">
                    </div>
                    <div class="form-group <?= $this->modifyContent_help ? 'has-error' : ''; ?>">
                        <label for="content">Content</label><br/>
                        <span class="help-block text-danger"><?= $this->modifyContent_help; ?></span>
                        <textarea type="text" name="content" id="adminForm" cols="160" rows="30"
                                  class="form-control"><?= $post->getContent() ?></textarea>
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
