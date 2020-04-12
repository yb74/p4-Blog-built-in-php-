<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/public/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/public/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Blog of Jean Forteroche">
    <meta name="author" content="Jean Forteroche">
    <title><?= $title ?></title>

    <!-- FB Open Graph data -->
    <meta property="og:title" content="Single ticket for Alaska by Jean Forteroche" />
    <meta property="og:type" content="Online novel" />
    <meta property="og:url" content="http://www.jeanforteroche.webagencypro.fr" />
    <meta property="og:image" content="public/img/logo.jpg" />
    <meta property="og:description" content="Come and take a tour to Alaska through the latest online novel by Jean Forteroche"/>

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="Online novel" />
    <meta name="twitter:title" content="Single ticket for Alaska by Jean Forteroche" />
    <meta name="twitter:image:src" content="http://www.jeanforteroche.webagencypro.fr/public/images/logo.png" />
    <meta name="twitter:description" content="Come and to take a tour to Alaska through the latest online novel by Jean Forteroche"/>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/j7edr96twwloguzfrtwtxsez5j6jx7gbta70ac6v012jsl6z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'#adminForm',});</script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- icones fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
<!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <img src="/public/images/logo.png" alt="logo" title="logo of the website" class="d-inline-block align-center text-white mr-2" style="width:50px;height:50px;">
            Single ticket for Alaska
        </a>

        <!-- Left menu -->
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 left-menu-homepage">
            <li class="nav-item">
                <a class="nav-link" href="/">Homepage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
        </ul>

        <!-- Right menu -->
        <div class="right-menu-homepage">
            <?php if (!$_SESSION): ?>
                <a class="btn btn-primary mx-2 right-menu-homepage-btn" href="/connection">Log In</a>
            <?php else: ?>
                <?php if ($_SESSION['id']): ?>
                    <a class="btn btn-primary mx-2 right-menu-homepage-btn" href="/logout">Log Out</a>
                <?php endif; ?>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a class="btn btn-primary mx-2 right-menu-homepage-btn" href="/admin">Dashboard</a>
                <?php elseif ($_SESSION['role'] === 'user'): ?>
                    <li class="nav-item" style="list-style-type:none";><a href="/" class="nav-link"></a></li>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </nav>

    <!-- HEADER -->
<header class="masthead mb-5" style="background-image: url('<?=$picture ?>'); background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading mt-5">
                    <h1 class="main-title h1-responsive font-weight-bold text-center my-4"><?= $titlePage ?></h1>
                    <p class="subheading text-center"><?= $subheadingPage ?></p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- MAIN CONTENT -->
<div class="container flex-grow-1">
    <?= $content ?>
</div>

<!-- FOOTER -->
<footer class="footer mt-5 py-3 bg-dark">
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

<!-- SCRIPTS -->
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