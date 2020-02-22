<?php $title = "Billets pour l'Alaska"; ?>

<?php ob_start(); ?>

<!--CONTENU PRINCIPAL-->
  <section id="content">
<!--SLIDER-->
    <div id="slider" class="carousel slide container p-0" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#slider" data-slide-to="0" <="" li="" class="active"></li>
        <li data-target="#slider" data-slide-to="1" <="" li="" class=""></li>
        <li data-target="#slider" data-slide-to="2" <="" li="" class=""> </li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/public/images/slider/slider-picture1.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Bienvenue sur Evasion Littéraire</h5>
            <p>Profitez de livres en accès gratuit et d'une réelle communauté ! </p>
            <a class="btn btn-outline-light" href="#">Je consulte la liste des livres
              accessibles</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="/public/images/slider/slider-picture2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>L'alaska, ce pays magnifique</h5>
            <p>J'y ai trouvé mon inspiration </p>
            <a class="btn btn-outline-light" href="https://fr.wikipedia.org/wiki/Alaska">Je veux en savoir plus sur ce
              pays !</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="/public/images/slider/slider-picture3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Une aurore boréale</h5>
            <p>Le dernier chapitre de 'Billet simple pour l'Alaska' </p>
            <a class="btn btn-outline-light" href="#">Cliquez ici pour le lire</a>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
<!--EXTRAITS DES CHAPITRES-->
    <div id="latest-chapters" class="container">
      <h2 class="row justify-content-center text-center mt-4">Les derniers chapitres postés</h2>
      <div class="row justify-content-center">
<?php
while ($data = $posts->fetch())
{
    ?>
        <div class="card m-3" style="width: 20.5rem; height:20.5rem">
          <img src="<?= $data['post_picture'] ?>" class="card-img-top"
               alt="Image du chapitre intitulé Une aurore boréale">
          <div class="card-body">
            <h4><?= htmlspecialchars($data['post_title']) ?></h4>
            <h5 class="card-title"><?= htmlspecialchars($data['creation_date_fr']) ?></h5>
            <p class="card-text"><?= substr(nl2br(htmlspecialchars($data['post_content'])), 0, 50) ?></p>
            <a href="/post/<?= $data['post_id'] ?>" class="btn btn-primary">Lire la suite</a>
          </div>
        </div>
    <?php
}
$posts->closeCursor();
?>
      </div>
    </div>

  </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>