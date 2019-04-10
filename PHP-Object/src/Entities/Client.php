<?php


namespace Surf\Entities;


class Client extends Contact
{
    protected $clientId;

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     * @return Client
     */
    public function setClientId($clientId)
    {
        $this->

        $this->clientId = $clientId;
        return $this;
    }


}