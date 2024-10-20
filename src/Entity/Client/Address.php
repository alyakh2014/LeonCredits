<?php

namespace App\Entity\Client;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\IdTrait;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: Address::class)]
class Address
{
    use IdTrait;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $state;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $city;

    #[ORM\Column(type: 'string', length: 5, nullable: false)]
    private string $zip;

    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'address', orphanRemoval: true)]
    private ArrayCollection $clients;

    #[Pure] public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip): void
    {
        $this->zip = $zip;
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