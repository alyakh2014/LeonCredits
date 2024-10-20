<?php

namespace App\Entity\Client;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\IdTrait;

//History of users' income - necessary to calculate fico
#[ORM\Entity(repositoryClass: UserIncomeHistory::class)]
class UserIncomeHistory
{
    use IdTrait;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'history')]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $income;

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
     * @return float
     */
    public function getIncome(): float
    {
        return $this->income;
    }

    /**
     * @param float $income
     */
    public function setIncome(float $income): void
    {
        $this->income = $income;
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