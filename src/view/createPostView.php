<?php $title = 'Create a post'; ?>

<?php ob_start(); ?>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ftco-animate">
                    <form action="index.php?action=sendPost" method="post" class="p-5 bg-light">
                        <div class="form-group">
                            <label for="title">Title</label><br/>
                            <input type="text" name="title" id="title" cols="30" rows="10"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label><br/>
                            <textarea type="text" name="content" id="content" cols="160" rows="30" id="adminform"
                                      class="form-control"></textarea>
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