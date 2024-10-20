<?php

namespace App\Entity\Client;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\IdTrait;

//History of the loan value change for clients
#[ORM\Entity(repositoryClass: FicoHistory::class)]
class FicoHistory
{
    use IdTrait;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'history')]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\Column(type: 'smallint', nullable: false)]
    private int $fico;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTime $dtChange;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return int
     */
    public function getFico(): int
    {
        return $this->fico;
    }

    /**
     * @param int $fico
     */
    public function setFico(int $fico): void
    {
        $this->fico = $fico;
    }

    /**
     * @return \DateTime
     */
    public function getDtChange(): \DateTime
    {
        return $this->dtChange;
    }

    /**
     * @param \DateTime $dtChange
     */
    public function setDtChange(\DateTime $dtChange): void
    {
        $this->dtChange = $dtChange;
    }


}