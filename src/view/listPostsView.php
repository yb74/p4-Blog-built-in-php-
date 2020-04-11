<?php $title = "Chapter list";
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Homepage';
if ($_SESSION):
$subheadingPage ='Welcome ' . $_SESSION['username'] . ' !';
else:
    $subheadingPage = "";
endif;
?>

<?php ob_start(); ?>

<!--MAIN CONTENT-->
  <section id="content">
<!--EXTRACT OF CHAPTERS-->
    <div id="latest-chapters" class="container">
      <h2 class="row justify-content-center text-center mt-4">Latest posted chapters</h2>
      <div class="row justify-content-center">
<?php
foreach ($posts as $post)
{
    ?>
        <a href="/chapter<?= $post->getId() ?>" class="chapter_block">
            <div class="card m-3 inside_block" style="width: 20.5rem; height:20.5rem">
              <img src="<?= $post->getPictureUrl() ?>" class="card-img-top"
                   alt="Image du chapitre intitulé Une aurore boréale">
              <div class="card-body">
                <h4><?= htmlspecialchars($post->getTitle()) ?></h4>
                <h5 class="card-title"><?= htmlspecialchars($post->getCreationDateFr()); ?></h5>
                <p class="card-text"><?= substr(nl2br($post->getContent()), 0, 50) ?></p>
                  <span class="btn btn-primary">Read more</span>
              </div>
            </div>
        </a>
    <?php
}
?>
      </div>
    </div>
  </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>