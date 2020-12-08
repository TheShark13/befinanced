<?php


namespace App\Service;


use App\Entity\CreditApplication;
use Fpdf\Fpdf;

class PdfMaker extends Fpdf
{
    /**
     * @param string[] $header
     * @param CreditApplication[] $data
     */
    public function getTable(array $header, array $data)
    {
        foreach ($header as $col) {
            $this->Cell(40, 7, $col, 1);
        }

        $this->Ln();

        foreach ($data as $application) {
            $this->Cell(40, 6, $application->getId(), 1);
            $this->Cell(40, 6, $application->getCreditType()->getName(), 1);
            $this->Cell(40, 6, $application->getCreditApplicationInformations()->getAmountMoneyRequested().' RON', 1);
            $this->Cell(40, 6, $application->getCreated()->format("d/m/Y H:i"), 1);
            $this->Cell(40, 6, CreditApplication::STATUSES_LABELS[$application->getStatus()], 1);

            $this->Ln();
        }
    }

    public function getTableDynamic(array $data)
    {
        $keys = array_keys($data[0]);
        foreach ($keys as $col) {
            $this->Cell(20, 7, $col, 1);
        }

        $this->Ln();

        foreach ($data as $item) {
            foreach($item as $key => $value) {
                $this->Cell(20, 6, $value, 1);
            }
            $this->Ln();
        }
    }
}