<?php $title = 'Manage users';
$picture ='/public/images/chapters/chapter-image1.jpg';
$titlePage='Manage the users !';
$subheadingPage='';
?>

<?php ob_start(); ?>

    <div class="container">
        <div class="row header-dashboard py-5">
            <div class="col-md-12 text-center dashboard_menu">
                <h2>Manage users</h2>
                <a href="/admin" class="btn btn-primary btn-dashboard">Manage posts</a>
                <a href="/createPost" class="btn btn-primary btn-dashboard">Create a post</a>
                <a href="/manageComments" class="btn btn-primary btn-dashboard">Reported comments</a>
            </div>
        </div>

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="case">
                            <div class="row">
                                <?php foreach ($users as $user) : ?>
                                    <div class="col-xl-4 col-lg-6 col-md-12 card py-5 card-dashboard">
                                        <div class="text w-100 pl-md-3">
                                            <p class="text-center">Username</p>
                                            <h3 class="text-center">
                                                <?= strip_tags($user->getUsername()) ?>
                                            </h3>
                                            <p class="text-center">Registration date</p>
                                            <h3 class="text-center">
                                                <?= $user->getRegistrationDate() ?>
                                            </h3>
                                            <p class="text-center">Id</p>
                                            <h3 class="text-center">
                                                <?= strip_tags($user->getId()) ?>
                                            </h3>
                                            <p class="text-center">Role</p>
                                            <h3 class="text-center">
                                                <?= $user->getRole() ?>
                                            </h3>
                                            <br>
                                            <p class="text-center">Available options</p>
                                            <div class="d-flex justify-content-center">
                                                <a href="/deleteUser<?= $user->getId() ?>"class="delete-button btn btn-danger btn-sm mx-2">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>