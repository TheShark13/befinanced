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
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Ai aplicat pentru creditul: <?= $application->getCreditType()->getName() ?></h1>
                <p class="lead"><?= $application->getCreditType()->getDescription() ?></p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ai aplicat la un numar de <?= count($financialInstitutions) ?>
                                    institutii financiare</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ai solicitat un credit in valoare de
                                    de <?= $application->getCreditApplicationInformations()->getAmountMoneyRequested() ?>
                                    RON</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Doresti o perioada de rambursare
                                    de <?= $application->getCreditApplicationInformations()->getRepaymentPeriodRequested() ?>
                                    luni</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <h3>Ai aplicat la urmatoarele institutii:</h3>
        <div class="row">
            <?php foreach ($financialInstitutions as $financialInstitution) { ?>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <?= FinancialInstitution::TYPES_LABELS[$financialInstitution->getType()] ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $financialInstitution->getName() ?></h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        <div class="card-footer text-muted">
                            2 days ago
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $loadTemplate("dashboard/components/bottom.php") ?>
