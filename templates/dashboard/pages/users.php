<?php

use App\Entity\CreditApplication;

?>
<?= $loadTemplate("dashboard/components/head_data.php") ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Utilizatorii platformei</h1>
    <a href="/dashboard/users/form" class="btn btn-xs btn-primary">Adauga</a>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Numar aplicatii credit</th>
                <th scope="col">Data inregistrare</th>
                <th scope="col">Actiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) {
                $userCreditApplicationNo = count($usersApplicationsMap[$user->getId()]);
                ?>
                <tr>
                    <th scope="row"><?= $user->getId() ?></th>
                    <th scope="row"><?= $user->getEmail() ?></th>
                    <th scope="row"><?= $user->getRole()->getName() ?></th>
                    <th scope="row"><?= $userCreditApplicationNo ?> aplicatii</th>
                    <td><?= $user->getCreated()->format('d/m/Y') ?></td>
                    <td>
                        <a href="/dashboard/users/form?id=<?= $user->getId() ?>" class="btn btn-primary btn-sm"><i
                                    class="fa fa-eye"></i></a>
                        <?php if (!$userCreditApplicationNo) { ?>
                            <a href="/dashboard/users/delete?id=<?= $user->getId() ?>" class="btn btn-danger btn-sm"><i
                                        class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?= $loadTemplate("dashboard/components/bottom.php") ?>
