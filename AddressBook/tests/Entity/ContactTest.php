<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /** @var Contact */
    protected $contact;

    public function setUp()
    {
        $this->contact = new Contact();
    }

    public function testInitialProperties()
    {
        $this->assertNull($this->contact->getFirstName());
        $this->assertNull($this->contact->getCompany());
        $this->assertNull($this->contact->getLastName());
        $this->assertNull($this->contact->getEmail());
        $this->assertNull($this->contact->getId());
        $this->assertNull($this->contact->getPhone());
        $this->assertNull($this->contact->getUpdateAt());
    }

    public function testGetSetFirstName()
    {
        $this->contact->setFirstName('Romain');
        $this->assertEquals('Romain', $this->contact->getFirstName());
    }

    public function testGetSetLastName()
    {
        $this->contact->setLastName('Dupont');
        $this->assertEquals('Dupont', $this->contact->getLastName());
    }
}
