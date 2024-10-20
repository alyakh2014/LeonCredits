<?php

namespace App\Entity\History;

use App\Entity\Client\Client;
use App\Entity\Client\Product;
use App\Entity\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: History::class)]
class History
{
    use IdTrait;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'history')]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'history')]
    #[ORM\JoinColumn(nullable: false)]
    private Product $product;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTime $dt;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $loanBalance;

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
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return \DateTime
     */
    public function getDt(): \DateTime
    {
        return $this->dt;
    }

    /**
     * @param \DateTime $dt
     */
    public function setDt(\DateTime $dt): void
    {
        $this->dt = $dt;
    }

    /**
     * @return float
     */
    public function getLoanBalance(): float
    {
        return $this->loanBalance;
    }

    /**
     * @param float $loanBalance
     */
    public function setLoanBalance(float $loanBalance): void
    {
        $this->loanBalance = $loanBalance;
    }
}