<?php

namespace App\Tests\Controller;

use App\Entity\Contact;
use App\Manager\ContactManager;
use App\Repository\ContactRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testListContactWithDatabase()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contacts/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des contacts', $crawler->filter('h2')->text());

        // ça fonctionne jusqu'au jour on insère un contact
        $this->assertCount(2, $crawler->filter('h2 + table tr'));
    }

//    public function testListContactWithoutDatabase()
//    {
//        $client = static::createClient();
//
//        // remplacer le vrai objet par le faux (ContactRepository et sa méthode findAll)
//
//        $contacts = [
//            (new Contact())->setFirstName('Jean')->setLastName('Dupont')->setId(123),
//        ];
//
//        $mockRepo = $this->prophesize(ContactRepository::class);
//        $mockRepo->findBy([], ['firstName' => 'ASC'], 100)->willReturn($contacts)->shouldBeCalledOnce();
//
//        $mockRegistry = $this->prophesize(ManagerRegistry::class);
//        $mockRegistry->getManagerNames()->shouldBeCalledOnce();
//        $mockRegistry->getConnectionNames()->shouldBeCalledOnce();
//        $mockRegistry->getRepository(Contact::class)->willReturn($mockRepo->reveal())->shouldBeCalledOnce();
//
//        self::$container->set('doctrine', $mockRegistry->reveal());
//
//        $crawler = $client->request('GET', '/contacts/');
//
//        $this->assertSame(200, $client->getResponse()->getStatusCode());
//        $this->assertContains('Liste des contacts', $crawler->filter('h2')->text());
//
//        // ça fonctionne toujours et c'est plus performant
//        $this->assertCount(1, $crawler->filter('h2 + table tr'));
//    }

    public function testListContactWithoutDatabase()
    {
        $client = static::createClient();

        // remplacer le vrai objet par le faux (ContactManager et sa méthode getAll)
        $contacts = [
            (new Contact())->setFirstName('Jean')->setLastName('Dupont')->setId(123),
        ];

        $mockManager = $this->prophesize(ContactManager::class);
        $mockManager->getAll()->willReturn($contacts)->shouldBeCalledOnce();

        self::$container->set(ContactManager::class, $mockManager->reveal());

        $crawler = $client->request('GET', '/contacts/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des contacts', $crawler->filter('h2')->text());

        // ça fonctionne toujours et c'est plus performant
        $this->assertCount(1, $crawler->filter('h2 + table tr'));
    }
}
