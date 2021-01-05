<?php


namespace App\Repository;


use App\Entity\Address;
use App\Entity\CreditApplication;
use App\Entity\CreditApplicationInformations;
use App\Entity\CreditType;
use App\Entity\FinancialInstitution;
use App\Entity\FinancialInstitutionLegalInformations;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserRole;
use MySqlCommunicator\Database\DatabaseRepository;

class CreditApplicationRepository
{
    private DatabaseRepository $dbRepo;
    private array $mapProps = [];

    public function __construct()
    {
        $this->dbRepo = new DatabaseRepository(CreditApplication::class);
    }

    public function findOneApplication(int $applicationId): ?CreditApplication
    {
        $query = $this->getQueryForApplications();
        $query .= ' WHERE ' . $this->mapProps[CreditApplication::class] . '.id = :applicationId ';

        $results = $this->dbRepo->fetchEntities($query, [':applicationId' => $applicationId], $this->mapProps);
        return count($results) ? $results[0] : null;
    }

    public function findApplicationsForUser(int $userId)
    {
        $query = $this->getQueryForApplications();
        $query .= ' WHERE ' . $this->mapProps[User::class] . '.id = :userId ';

        return $this->dbRepo->fetchEntities($query, [':userId' => $userId], $this->mapProps);
    }

    public function findApplicationsForFinancialInstitution(int $financialInstitutionId)
    {
        $query = $this->getQueryForApplications();
        $query .= ' LEFT JOIN credit_application_financial_institution ON credit_application_financial_institution.credit_application_id = ' . $this->mapProps[CreditApplication::class] . '.id ';
        $query .= ' WHERE credit_application_financial_institution.financial_institution_id = :financialInstitutionId';

        return $this->dbRepo->fetchEntities($query, [':financialInstitutionId' => $financialInstitutionId], $this->mapProps);
    }

    protected function getQueryForApplications(): string
    {
        $select = $this->dbRepo->getSelect(CreditApplication::class, md5(CreditApplication::class), $this->mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM credit_application AS ' . $this->mapProps[CreditApplication::class] . ' ';
        $query .= 'LEFT JOIN user AS ' . $this->mapProps[User::class] . ' ON ' . $this->mapProps[User::class] . '.id = ' . $this->mapProps[CreditApplication::class] . '.applicant_id ';
        $query .= 'LEFT JOIN credit_type AS ' . $this->mapProps[CreditType::class] . ' ON ' . $this->mapProps[CreditType::class] . '.id = ' . $this->mapProps[CreditApplication::class] . '.credit_type_id ';
        $query .= 'LEFT JOIN user_role AS ' . $this->mapProps[UserRole::class] . ' ON ' . $this->mapProps[User::class] . '.role_id = ' . $this->mapProps[UserRole::class] . '.id ';
        $query .= 'LEFT JOIN user_profile AS ' . $this->mapProps[UserProfile::class] . ' ON ' . $this->mapProps[User::class] . '.user_profile_id = ' . $this->mapProps[UserProfile::class] . '.id ';
        $query .= 'LEFT JOIN credit_application_informations AS ' . $this->mapProps[CreditApplicationInformations::class] . ' ON ' . $this->mapProps[CreditApplication::class] . '.credit_application_informations_id = ' . $this->mapProps[CreditApplicationInformations::class] . '.id ';
        $query .= ' LEFT JOIN financial_institution AS ' . $this->mapProps[FinancialInstitution::class] . ' ON ' . $this->mapProps[User::class] . '.financial_institution_id = ' . $this->mapProps[FinancialInstitution::class] . '.id ';
        $query .= ' LEFT JOIN financial_institution_legal_informations AS ' . $this->mapProps[FinancialInstitutionLegalInformations::class] . ' ON ' . $this->mapProps[FinancialInstitution::class] . '.financial_institution_legal_informations_id = ' . $this->mapProps[FinancialInstitutionLegalInformations::class] . '.id ';
        $query .= ' LEFT JOIN address AS ' . $this->mapProps[Address::class] . ' ON ' . $this->mapProps[FinancialInstitution::class] . '.address_id = ' . $this->mapProps[Address::class] . '.id ';

        return $query;
    }

    /**
     * @param CreditApplication $creditApplication
     * @param int[] $financialInstitutionsIds
     * @return CreditApplication
     */
    public function persist(CreditApplication $creditApplication, array $financialInstitutionsIds): CreditApplication
    {
        $conn = $this->dbRepo->getConnection();

        $sql = 'INSERT INTO credit_application_informations (amount_money_requested, repayment_period_requested, message, created, updated) VALUES(:money, :months, :message, :created, :updated)';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':money', $creditApplication->getCreditApplicationInformations()->getAmountMoneyRequested());
        $stmt->bindValue(':months', $creditApplication->getCreditApplicationInformations()->getRepaymentPeriodRequested());
        $stmt->bindValue(':message', $creditApplication->getCreditApplicationInformations()->getMessage());
        $stmt->bindValue(':updated', $creditApplication->getCreditApplicationInformations()->getUpdated()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':created', $creditApplication->getCreditApplicationInformations()->getCreated()->format('Y-m-d H:i:s'));
        $stmt->execute();

        $creditApplication->getCreditApplicationInformations()->setId($conn->lastInsertId());

        $sql = 'INSERT INTO credit_application (credit_application_informations_id, credit_type_id, status, applicant_id, created, updated) VALUES(:credit_application_informations_id, :credit_type_id, :status, :applicant_id, :created, :updated)';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':credit_application_informations_id', $creditApplication->getCreditApplicationInformations()->getId());
        $stmt->bindValue(':credit_type_id', $creditApplication->getCreditType()->getId());
        $stmt->bindValue(':status', $creditApplication->getStatus());
        $stmt->bindValue(':applicant_id', $creditApplication->getApplicant()->getId());
        $stmt->bindValue(':created', $creditApplication->getCreated()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':updated', $creditApplication->getUpdated()->format('Y-m-d H:i:s'));
        $stmt->execute();
        $creditApplication->setId($conn->lastInsertId());

        $sql = 'INSERT INTO credit_application_financial_institution(credit_application_id, financial_institution_id) VALUES ';
        $pairs = [];
        for ($i = 0; $i < count($financialInstitutionsIds); ++$i) {
            $sql .= '(?, ?), ';
            $pairs[] = $creditApplication->getId();
            $pairs[] = intval($financialInstitutionsIds[$i]);
        }
        $sql = rtrim($sql, ', ');
        $stmt = $conn->prepare($sql);
        $stmt->execute($pairs);

        return $creditApplication;
    }

    //TODO: De refacut partea de ORM
//    public function findOneById(int $id): User
//    {
//        return $this->dbRepo->fetchEntity($id, [
//            'join' => [
//                'credit_type_id' => CreditType::class,
//                'applicant_id' => User::class
//            ]
//        ]);
//    }
}