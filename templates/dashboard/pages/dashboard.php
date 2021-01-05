<?php

use App\Entity\CreditApplication;
use App\Entity\FinancialInstitution;

?>
<?= $loadTemplate("dashboard/components/head_data.php") ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"></h1>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        if (!$getUser()->getUserProfile()) { ?>
            <div class="jumbotron">
                <h1 class="display-4">Inainte de a aplica, trebuie sa stim cateva lucruri despre tine</h1>
                <hr class="my-4">
                <a class="btn btn-primary btn-lg" href="/dashboard/edit-profile" role="button">Completeaza acum</a>
            </div>
        <?php } else { ?>
            <div class="jumbotron">
                <h1 class="display-4">Salut, <?= $getUser()->getUserProfile()->getFirstName() ?></h1>
                <p class="lead">Vrei sa obtii un credit nou?</p>
                <hr class="my-4">
                <a class="btn btn-primary btn-lg" href="/dashboard/apply-credit" role="button">Aplica acum</a>
                <a class="btn btn-light btn-lg" href="/dashboard/applications" role="button">Vezi aplicarile mele</a>
            </div>
        <?php } ?>
    </div>
</div>
<?= $loadTemplate("dashboard/components/bottom.php") ?>
