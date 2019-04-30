<?php


namespace App\Manager;


use App\Entity\Contact;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class ContactManager
{
    /** @var ManagerRegistry */
    protected $doctrine;

    /**
     * ContactManager constructor
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getAll()
    {
        $repo = $this->doctrine->getRepository(Contact::class);

        return $repo->findBy([], ['firstName' => 'ASC'], 100);
    }

    public function getById($id)
    {
        $repo = $this->doctrine->getRepository(Contact::class);

        return $repo->findWithCompany($id);
        // return $repo->find($id); // pas de jointure (2 requete)
    }

    public function countByCompany()
    {
        // Apple  | 2
        // Google | 10

        $sql = "SELECT name as company, COUNT(ctc.id) as contact_count
                FROM contact ctc
                JOIN company cpn ON company_id = cpn.id 
                GROUP BY company_id";

        /** @var Connection $connect */
        $connect = $this->doctrine->getConnection();

        $stmt = $connect->query($sql);

        return $stmt->fetchAll(FetchMode::ASSOCIATIVE);
    }
}