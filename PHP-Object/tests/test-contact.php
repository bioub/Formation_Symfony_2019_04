<?php

use Surf\Entities\Company;
use Surf\Entities\Contact;

require_once __DIR__ . '/../vendor/autoload.php';

$contact = new Contact();
$contact->setFirstName('Romain')->setLastName('Bohdanowicz');

$company = new Company();
$company->setName('bioub up')->setCity('Paris');

// association :
$contact->setCompany($company);

// Page Fiche Contact
echo $contact->getFirstName() . ' ' . $contact->getLastName() . "\n";
echo $contact->getCompany()->getName() . "\n";


$client = new \Surf\Entities\Client();
