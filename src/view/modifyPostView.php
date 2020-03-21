<?php $title = 'Modify a post'; ?>

<?php ob_start(); ?>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ftco-animate"> <?php var_dump($post->getId()) ?>
                <form action="/modifyPost<?= $post->getId(); ?>" method="post"
                      class="p-5 bg-light">
                    <div class="form-group <?= $modifyTitle_help ? 'has-error' : ''; ?>">
                        <label for="title">Title</label><br/>
                        <input type="text" name="title" id="title" cols="30" rows="10"
                               class="form-control" value="<?= $post->getTitle() ?>">
                        <span class="help-block"><?= $modifyTitle_help; ?></span>
                    </div>
                    <div class="form-group <?= $modifyContent_help ? 'has-error' : ''; ?>">
                        <label for="content">Content</label><br/>
                        <textarea type="text" name="content" id="adminForm" cols="160" rows="30"
                                  class="form-control"><?= $post->getContent() ?></textarea>
                        <span class="help-block"><?= $modifyContent_help; ?></span>
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
