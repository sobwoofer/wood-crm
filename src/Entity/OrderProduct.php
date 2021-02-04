<?php

namespace App\Entity;

use App\Repository\OrderProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderProductRepository::class)
 */
class OrderProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="float")
     */
    private $fact_price;

    /**
     * @ORM\Column(type="float")
     */
    private $spent_itr;

    /**
     * @ORM\Column(type="float")
     */
    private $purchase;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderProducts")
     */
    private $product;

    /**
     * @ORM\OneToOne(targetEntity=ProduceOrderProduct::class, mappedBy="orderProduct", cascade={"persist", "remove"})
     */
    private $produceOrderProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFactPrice(): ?float
    {
        return $this->fact_price;
    }

    public function setFactPrice(float $fact_price): self
    {
        $this->fact_price = $fact_price;

        return $this;
    }

    public function getSpentItr(): ?float
    {
        return $this->spent_itr;
    }

    public function setSpentItr(float $spent_itr): self
    {
        $this->spent_itr = $spent_itr;

        return $this;
    }

    public function getPurchase(): ?float
    {
        return $this->purchase;
    }

    public function setPurchase(float $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->order_id;
    }

    public function setOrderId(?Order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProduceOrderProduct(): ?ProduceOrderProduct
    {
        return $this->produceOrderProduct;
    }

    public function setProduceOrderProduct(ProduceOrderProduct $produceOrderProduct): self
    {
        // set the owning side of the relation if necessary
        if ($produceOrderProduct->getOrderProduct() !== $this) {
            $produceOrderProduct->setOrderProduct($this);
        }

        $this->produceOrderProduct = $produceOrderProduct;

        return $this;
    }

}
