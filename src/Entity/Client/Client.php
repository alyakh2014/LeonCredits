<?php

namespace App\Entity\Client;

use App\Entity\Traits\IdTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

#[ORM\Entity(repositoryClass: Client::class)]
class Client
{
    use IdTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $lastName;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTime $birth;

    #[ORM\Column(type: 'string', length: 11, nullable: false)]
    private string $ssn;

    #[ORM\Column(type: 'string', unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $phone;

    #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    private Address $address;

    #[JoinTable(name: 'client_product')]
    #[JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'product_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'clients', cascade: ["persist"])]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getBirth(): \DateTime
    {
        return $this->birth;
    }

    /**
     * @param \DateTime $birth
     */
    public function setBirth(\DateTime $birth): void
    {
        $this->birth = $birth;
    }

    public function getAgeOfClient(): int
    {
        return date_diff(new DateTime(), $this->birth)->y;
    }

    /**
     * @return string
     */
    public function getSsn(): string
    {
        return $this->ssn;
    }

    /**
     * @param string $ssn
     */
    public function setSsn(string $ssn): void
    {
        $this->ssn = $ssn;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

}
