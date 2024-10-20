<?php

namespace App\Entity\Client;

use App\Entity\Traits\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

#[ORM\Entity(repositoryClass: Product::class)]
class Product
{
    use IdTrait;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $name;

    //Days
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $period;

    #[ORM\Column(type: 'decimal', precision: 2, scale: 2, nullable: false)]
    private string $interestRate;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $sum;

    #[JoinTable(name: 'client_product')]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'client_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'products')]
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @param int $period
     */
    public function setPeriod(int $period): void
    {
        $this->period = $period;
    }

    /**
     * @return string
     */
    public function getIntervalRage(): string
    {
        return $this->interestRate;
    }

    /**
     * @param string $interestRate
     */
    public function setIntervalRage(string $interestRate): void
    {
        $this->interestRate = $interestRate;
    }

    /**
     * @return string
     */
    public function getSum(): string
    {
        return $this->sum;
    }

    /**
     * @param string $sum
     */
    public function setSum(string $sum): void
    {
        $this->sum = $sum;
    }

    /**
     * @return ArrayCollection
     */
    public function getClients(): ArrayCollection
    {
        return $this->clients;
    }

    /**
     * @param ArrayCollection $clients
     */
    public function setClients(ArrayCollection $clients): void
    {
        $this->clients = $clients;
    }
}