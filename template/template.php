<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <!-- icones fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="listPostsView.php">
            <img src="public\images\logo.png" class="d-inline-block align-center text-white">
            Billet simple pour l'Alaska
        </a>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="listPostsView.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
            <div>
                <button type="button" class="btn btn-outline-light" data-toggle="modal"
                        data-target="#subscribeForm">S'inscrire</button>
                <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#connexionForm">Se connecter</button>

                <!-- Modal Subscription-->
                <div class="modal fade" id="subscribeForm" tabindex="-1" role="dialog" aria-labelledby="subscribeFormTitle"
                     style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subscribeFormTitle">Formulaire d'inscription</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="messages-subscription"></div>
                                <form action="#" method="post" id="subscribe-form">
                                    <div class="form-group">
                                        <label for="username">Pseudo</label>
                                        <input type="text" class="form-control" name="subscribe-username" value="">
                                        <small id="passwordHelp" class="form-text text-muted">Votre login doit être composé de 6
                                            caractères minimum.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="subscribe-password">Mot de passe</label>
                                        <input type="password" class="form-control" name="subscribe-password"
                                               aria-describedby="passwordHelp">
                                        <small id="passwordHelp" class="form-text text-muted">Votre mot de passe doit être composé de 8
                                            caractères dont à minima un chiffre et une lettre majuscule.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirmation">Confirmer votre mot de passe</label>
                                        <input type="password" class="form-control" name="password-confirmation">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Nom</label>
                                        <input type="text" class="form-control" name="lastname" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">Prénom</label>
                                        <input type="text" class="form-control" name="firstname" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile-picture">Sélectionner votre photo de profil</label>
                                        <input type="file" class="form-control-file" name="profile-picture"
                                               aria-describedby="select-profile-picture-help">
                                        <small id="select-profile-picture-help" class="form-text text-muted">Votre photo de profil ne doit
                                            pas dépasser 2 Mo et doit respecter le ratio 150*150px.</small>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" id="subscribe-button" class="btn btn-primary"
                                        form="subscribe-form">S'inscrire</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Connexion-->
                <div class="modal fade" id="connexionForm" tabindex="-1" role="dialog" aria-labelledby="connexionFormTitle"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="connexionFormTitle">Formulaire de connexion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="messages"></div>
                                <form action="#" method="post" id="connexion-form">
                                    <div class="form-group">
                                        <label for="username">Pseudo</label>
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" form="connexion-form" id="connect-button">Se
                                    connecter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </nav>

    <div id="modalPassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Forgot password</h3>
                    <button type="button" class="close font-weight-light" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Reset your password..</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</header>

<?= $content ?>

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
                            <img src="public/images/social_networks/facebook-icon.png" alt="Lien vers le compte Facebook">
                        </a>
                    </div>
                    <div class="social-link">
                        <a href="#">
                            <img src="public/images/social_networks/twitter-icon.png" alt="Lien vers le compte Twitter">
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