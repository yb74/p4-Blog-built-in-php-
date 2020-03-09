<!doctype html>
<html lang="en" xmlns:list-style-type="http://www.w3.org/1999/xhtml">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/j7edr96twwloguzfrtwtxsez5j6jx7gbta70ac6v012jsl6z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'#adminForm'});</script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- icones fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!--<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">-->
        <a class="navbar-brand" href="/">
            <img src="/public/images/logo.png" class="d-inline-block align-center text-white" style="width:50px;height:50px;">
            Billet simple pour l'Alaska
        </a>

        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/">Homepage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
        </ul>

        <div class = "d-flex">
            <?php if (!$_SESSION): ?>
                <a class="nav-link" href="/connection">
                    <button type="button" class="btn btn-primary">Log In</button>
                </a>
            <?php else: ?>
                <?php if ($_SESSION['id']): ?>
                    <a class="nav-link" href="/logout">
                        <button type="button" class="btn btn-primary">Log Out</button>
                    </a>
                <?php endif; ?>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a class="nav-link" href="/admin">
                        <button type="button" class="btn btn-primary">Dashboard</button>
                    </a>
                <?php elseif ($_SESSION['role'] === 'user'): ?>
                    <li class="nav-item" style="list-style-type:none";><a href="/" class="nav-link"></a></li>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </nav>
</header>

<div class="container flex-grow-1">
    <?= $content ?>
</div>

<!--PIED DE PAGE-->
<footer class="footer mt-auto py-3 bg-dark">
    <div class="container">
        <div class="row align-items-center">
            <a class="col-md-3 text-white" href="#">Politique de confidentialité</a>
            <a class="col-md-3 text-white" href="#">Mentions Légales</a>
            <a class="col-md-3 text-white" href="#">Site Map</a>
            <div class="social-media col-md-3">
                <div class="row justify-content-center">
                    <div class="social-link">
                        <a href="#">
                            <img src="/public/images/social_networks/facebook-icon.png" alt="Lien vers le compte Facebook">
                        </a>
                    </div>
                    <div class="social-link">
                        <a href="#">
                            <img src="/public/images/social_networks/twitter-icon.png" alt="Lien vers le compte Twitter">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="copyright text-muted col-md-12">Younes Bouaziz | 2019 © Tous droits réservés </p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
</body>
</html>