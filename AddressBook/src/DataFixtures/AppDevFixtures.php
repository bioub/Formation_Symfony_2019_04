<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppDevFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /* APPLE */
        $company = new Company();
        $company->setName('Apple')->setCity('Cupertino');
        $manager->persist($company);

        $contact = new Contact();
        $contact->setFirstName('Steve')->setLastName('Jobs')->setCompany($company);
        $manager->persist($contact);

        /* MICROSOFT */
        $company = new Company();
        $company->setName('Microsoft')->setCity('Seattle');
        $manager->persist($company);

        $contact = new Contact();
        $contact->setFirstName('Bill')->setLastName('Gates')->setCompany($company);
        $manager->persist($contact);

        $manager->flush();
    }
}
