<?php

use App\Entity\CreditApplication;
use App\Entity\FinancialInstitution;

?>
<?= $loadTemplate("dashboard/components/head_data.php") ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Aplica pentru un credit</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <form method="post" action="/dashboard/register-application">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Tip credit solicitat</label>
                    <select class="form-control" name="credit_type">
                        <?php foreach ($creditTypes as $creditType) { ?>
                            <option value="<?= $creditType->getId() ?>"><?= $creditType->getName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Suma solicitata (RON)</label>
                    <input type="number" class="form-control" name="sum">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Perioada rambursare (luni)</label>
                    <input type="number" class="form-control" name="reimbursement_period">
                </div>
                <div class="form-group col-md-12">
                    <label for="message">Alege institutiile financiare la care doresti sa aplici</label>
                    <div class="form-group col-md-12">
                        <div class="row">
                            <?php foreach ($financialInstitutions as $financialInstitution) { ?>
                                <div class="col-md-3">
                                    <input type="checkbox" class="form-check-input" name="financial_institutions[]"
                                           value="<?= $financialInstitution->getId() ?>">
                                    <label class="form-check-label"
                                           for="exampleCheck1">
                                        <img src="<?=$financialInstitution->getLogo()?>"
                                           height="150px"  />
                                        <b><?= $financialInstitution->getName() ?></b>
                                    </label>
                                </div>

                            <?php } ?>
                        </div>

                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="message">Mesajul tau</label>
                    <textarea class="form-control" name="message" rows="5"></textarea>
                    <small id="messageinfo" class="form-text text-muted">Completeaza date despre motivul pentru care
                        doresti
                        acest credit cat si despre experienta ta actuala</small>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg">Aplica acum</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $loadTemplate("dashboard/components/bottom.php") ?>
