<?php

namespace App\Entity;

use App\Repository\ProduceOrderProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduceOrderProductRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ProduceOrderProduct
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $manager_comment;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $spent_to_producing;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $spent_to_resources;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $spent_to_additional;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salary_status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $salary_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pro")
     */
    private $performer;

    /**
     * @ORM\OneToOne(targetEntity=OrderProduct::class, inversedBy="produceOrderProduct", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManagerComment(): ?string
    {
        return $this->manager_comment;
    }

    public function setManagerComment(?string $manager_comment): self
    {
        $this->manager_comment = $manager_comment;

        return $this;
    }

    public function getSpentToProducing(): ?float
    {
        return $this->spent_to_producing;
    }

    public function setSpentToProducing(?float $spent_to_producing): self
    {
        $this->spent_to_producing = $spent_to_producing;

        return $this;
    }

    public function getSpentToResources(): ?float
    {
        return $this->spent_to_resources;
    }

    public function setSpentToResources(?float $spent_to_resources): self
    {
        $this->spent_to_resources = $spent_to_resources;

        return $this;
    }

    public function getSpentToAdditional(): ?float
    {
        return $this->spent_to_additional;
    }

    public function setSpentToAdditional(?float $spent_to_additional): self
    {
        $this->spent_to_additional = $spent_to_additional;

        return $this;
    }

    public function getSalaryStatus(): ?string
    {
        return $this->salary_status;
    }

    public function setSalaryStatus(string $salary_status): self
    {
        $this->salary_status = $salary_status;

        return $this;
    }

    public function getSalaryDate(): ?\DateTimeInterface
    {
        return $this->salary_date;
    }

    public function setSalaryDate(?\DateTimeInterface $salary_date): self
    {
        $this->salary_date = $salary_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOrderProduct(): ?OrderProduct
    {
        return $this->orderProduct;
    }

    public function setOrderProduct(OrderProduct $orderProduct): self
    {
        $this->orderProduct = $orderProduct;

        return $this;
    }

    public function getPerformer(): ?User
    {
        return $this->performer;
    }

    public function setPerformer(?User $performer): self
    {
        $this->performer = $performer;

        return $this;
    }
}
