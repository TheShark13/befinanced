<?php


namespace App\Repository;


use App\Entity\Address;
use App\Entity\CreditApplication;
use App\Entity\FinancialInstitution;
use App\Entity\FinancialInstitutionLegalInformations;
use MySqlCommunicator\Database\DatabaseRepository;

class FinancialInstitutionRepository
{
    private DatabaseRepository $dbRepo;
    private array $mapProps = [];

    public function __construct()
    {
        $this->dbRepo = new DatabaseRepository(FinancialInstitution::class);
    }

    /**
     * @return FinancialInstitution[]
     */
    public function findAll(): array
    {
        $query = $this->getQueryForFinancialInstitutions();

        return $this->dbRepo->fetchEntities($query, [], $this->mapProps);
    }

    /**
     * @param int $applicationId
     * @return FinancialInstitution[]
     */
    public function findFinancialInstitutionsForApplication(int $applicationId): array
    {
        $query = $this->getQueryForFinancialInstitutions();
        $query .= 'LEFT JOIN credit_application_financial_institution AS cafi ON cafi.financial_institution_id = ' . $this->mapProps[FinancialInstitution::class] . '.id ';
        $query .= 'WHERE cafi.credit_application_id = :applicationId';

        return $this->dbRepo->fetchEntities($query, [':applicationId' => $applicationId], $this->mapProps);
    }

    protected function getQueryForFinancialInstitutions(): string
    {
        $select = $this->dbRepo->getSelect(FinancialInstitution::class, md5(FinancialInstitution::class), $this->mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM financial_institution AS ' . $this->mapProps[FinancialInstitution::class] . ' ';
        $query .= 'LEFT JOIN address AS ' . $this->mapProps[Address::class] . ' ON ' . $this->mapProps[Address::class] . '.id = ' . $this->mapProps[FinancialInstitution::class] . '.address_id ';
        $query .= 'LEFT JOIN financial_institution_legal_informations AS ' . $this->mapProps[FinancialInstitutionLegalInformations::class] . ' ON ' . $this->mapProps[FinancialInstitution::class] . '.financial_institution_legal_informations_id = ' . $this->mapProps[FinancialInstitutionLegalInformations::class] . '.id ';

        return $query;
    }
}