<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Obtine creditul tau acum</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <!-- Custom styles for this template -->
    <link href="<?= $getFileSrc("dashboard/css/auth.css") ?>" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" action="/register" method="POST">
    <img class="mb-4" src="<?= $getFileSrc("img/logo-black.png") ?>" alt="">
    <h1 class="h3 mb-3 font-weight-normal">Inregistrare</h1>
    <?php if (isset($errors['general'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $errors['general'] ?>
        </div>
    <?php } ?>
    <label for="email" class="sr-only">Email</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
    <?php if (isset($errors['email'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $errors['email'] ?>
        </div>
    <?php } ?>
    <br />
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Parola" required>
    <?php if (isset($errors['password'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $errors['password'] ?>
        </div>
    <?php } ?>
    <label for="confirm_password" class="sr-only">Confirma parola</label>
    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirma parola" required>
    <input type="hidden" value="<?=getCsrfToken()?>" name="token" />
    <button class="btn btn-lg btn-primary btn-block" type="submit">Creeaza contul</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
</form>
</body>
</html>
