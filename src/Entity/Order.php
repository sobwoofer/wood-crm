<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 * @ORM\HasLifecycleCallbacks()
 */
class Order
{
    use Timestamps;

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_DONE = 'done';
    public const STATUS_CANCELED = 'canceled';

    public const PAYMENT_STATUS_PAYED = 'payed';
    public const PAYMENT_STATUS_PREPAID = 'prepaid';
    public const PAYMENT_STATUS_NOT_PAYED = 'not_payed';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deadline;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $shipped_date;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $buyer_phone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $buyer_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $buyer_last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $buyer_address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shipping_id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payment_status;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prepaid;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accountant_comment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $manager_comment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $supervisor_comment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity=OrderProduct::class, mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $orderProducts;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="manageOrders")
     */
    private $manager;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shippedOrders")
     */
    private $driver;

    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getShippedDate(): ?\DateTimeInterface
    {
        return $this->shipped_date;
    }

    public function setShippedDate(\DateTimeInterface $shipped_date): self
    {
        $this->shipped_date = $shipped_date;

        return $this;
    }

    public function getBuyerPhone(): ?string
    {
        return $this->buyer_phone;
    }

    public function setBuyerPhone(?string $buyer_phone): self
    {
        $this->buyer_phone = $buyer_phone;

        return $this;
    }

    public function getBuyerName(): ?string
    {
        return $this->buyer_name;
    }

    public function setBuyerName(string $buyer_name): self
    {
        $this->buyer_name = $buyer_name;

        return $this;
    }

    public function getBuyerLastName(): ?string
    {
        return $this->buyer_last_name;
    }

    public function setBuyerLastName(?string $buyer_last_name): self
    {
        $this->buyer_last_name = $buyer_last_name;

        return $this;
    }

    public function getBuyerAddress(): ?string
    {
        return $this->buyer_address;
    }

    public function setBuyerAddress(?string $buyer_address): self
    {
        $this->buyer_address = $buyer_address;

        return $this;
    }

    public function getShippingId(): ?int
    {
        return $this->shipping_id;
    }

    public function setShippingId(int $shipping_id): self
    {
        $this->shipping_id = $shipping_id;

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

    public function getPaymentStatus(): ?string
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(string $payment_status): self
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    public function getPrepaid(): ?float
    {
        return $this->prepaid;
    }

    public function setPrepaid(?float $prepaid): self
    {
        $this->prepaid = $prepaid;

        return $this;
    }

    public function getAccountantComment(): ?string
    {
        return $this->accountant_comment;
    }

    public function setAccountantComment(?string $accountant_comment): self
    {
        $this->accountant_comment = $accountant_comment;

        return $this;
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

    public function getSupervisorComment(): ?string
    {
        return $this->supervisor_comment;
    }

    public function setSupervisorComment(?string $supervisor_comment): self
    {
        $this->supervisor_comment = $supervisor_comment;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|OrderProduct[]
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
            $orderProduct->setOrder($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getOrder() === $this) {
                $orderProduct->setOrder(null);
            }
        }

        return $this;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function getDriver(): ?User
    {
        return $this->driver;
    }

    public function setDriver(?User $driver): self
    {
        $this->driver = $driver;

        return $this;
    }
}
