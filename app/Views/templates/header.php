<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/style.css') ?>">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="/">Le Blog d'Aby et Roxanne</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <?php
                    if (isset($user)) {
                        if ($user->groups[0] === 'user' || $user->groups[0] === 'superadmin') {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/contents">Les derniers posts</a>
                            </li>
                        <?php
                        }
                        ?>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/about">En savoir plus</a>
                        </li>
                        <?php
                        if ($user->groups[0] === 'superadmin') {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/contents/add">Nouveau post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="/admin">Outils Admin</a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
                <a href=<?= isset($user) ? '/logout' : '/login' ?> title=<?= isset($user) ? 'Deconnexion' : 'Connexion' ?> class="btn btn-primary">
                    <?= isset($user) ? 'Deconnexion' : 'Connexion' ?>
                </a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="unicorn">
            <div class="face">
                <div class="cheek"></div>
                <div class="snoot">
                    <div class="nose">
                        <div class="nostril"></div>
                    </div>
                </div>
                <div class="eye">
                    <div class="eyelashes"></div>
                </div>
                <div class="ear"></div>
                <div class="horn"></div>
                <div class="mane top"></div>
                <div class="mane mid"></div>
            </div>
            <div class="neck">
                <div class="mane end"></div>
            </div>
        </div>