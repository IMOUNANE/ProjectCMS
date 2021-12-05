<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?= $title; ?></title>
</head>

<body>

<header class="p-3 bg-white text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <nav class="navbar navbar-expand-lg  bg-white">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/" class="nav-link px-2 text-primary">Home</a></li>
                        <li><a href="/write-article" class="nav-link px-2 text-primary">Write article</a></li>
                        <li><a href="/userlist" class="nav-link px-2 text-primary">User List</a></li>
                    </ul>
                </div>
            </nav>

            <div class="text-end">
                <?php if (\Controller\SecurityController::isAuthenticated()) : ?>
                    <a type="button" href="/admin" class="btn btn-primary me-2">Admin</a>
                    <a type="button" href="/logout" class="btn btn-secondary">Logout</a>
                <?php else : ?>
                    <a type="button" href="/login" class="btn btn-primary me-2">Login</a>
                    <a type="button" href="/signup" class="btn btn-secondary">Sign-up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<?php if (\Vendor\App\MessageTrigger::hasMessage()) : ?>
    <div class="alert alert-warning" role="alert">
        <?= \Vendor\App\MessageTrigger::getMessage(); ?>
    </div>
<?php endif; ?>

<div class="container py-5">
    <?= $content; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
