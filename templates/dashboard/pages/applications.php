<?php

use App\Entity\CreditApplication;

?>
<?= $loadTemplate("dashboard/components/head_data.php") ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Aplicarile mele</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tip credit</th>
                <th scope="col">Suma solicitata</th>
                <th scope="col">Data aplicare</th>
                <th scope="col">Status aplicare</th>
                <th scope="col">Actiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($applications as $application) { ?>
                <tr>
                    <th scope="row"><?= $application->getId() ?></th>
                    <th scope="row"><?= $application->getCreditType()->getName() ?></th>
                    <th scope="row"><?= $application->getCreditApplicationInformations()->getAmountMoneyRequested() ?>
                        RON
                    </th>
                    <td><?= $application->getCreated()->format('d/m/Y') ?></td>
                    <td><?= CreditApplication::STATUSES_LABELS[$application->getStatus()] ?></td>
                    <td>
                        <a href="/dashboard/applications/show?id=<?=$application->getId()?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?= $loadTemplate("dashboard/components/bottom.php") ?>
