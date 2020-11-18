<?php

use App\Entity\CreditApplication;

?>
<?= $loadTemplate("dashboard/components/head_data.php") ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $user->getId() ? "Editeaza utilizatorul #" . $user->getId() : "Adauga utilizator nou" ?></h1>
</div>
<div class="row">
    <div class="col-md-12">
        <form method="post" action="/dashboard/users/form<?= $user ? '?id=' . $user->getId() : '' ?>">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?= $user->getId() ? $user->getEmail() : "" ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Parola:</label>
                    <input type="password" class="form-control" name="password"
                           value="">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Rol</label>
                    <select class="form-control" name="role">
                        <?php foreach ($userRoles as $role) { ?>
                            <option value="<?= $role->getId() ?>" <?= $user->getId() && $role->getId() === $user->getRole()->getId() ? 'selected' : '' ?>><?= $role->getName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">Nume de familie:</label>
                    <input type="text" class="form-control" name="last_name"
                           value="<?=  $user->getUserProfile() ? $user->getUserProfile()->getLastName() : '' ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">Prenume:</label>
                    <input type="text" class="form-control" name="first_name"
                           value="<?= $user->getUserProfile() ? $user->getUserProfile()->getFirstName() : '' ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">Numar de telefon:</label>
                    <input type="tel" class="form-control" name="phone"
                           value="<?= $user->getUserProfile() ? $user->getUserProfile()->getPhoneNumber() : '' ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">CNP:</label>
                    <input type="text" class="form-control" name="nin"
                           value="<?= $user->getUserProfile() ? $user->getUserProfile()->getNin() : '' ?>">
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg">Salveaza</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $loadTemplate("dashboard/components/bottom.php") ?>
