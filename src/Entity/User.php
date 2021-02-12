<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="manager")
     */
    private $manageOrders;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="driver")
     */
    private $shippedOrders;

    /**
     * @ORM\OneToMany(targetEntity=ProduceOrderProduct::class, mappedBy="performer")
     */
    private $produceOrderProducts;

    public function __construct()
    {
        $this->manageOrders = new ArrayCollection();
        $this->shippedOrders = new ArrayCollection();
        $this->produceOrderProducts = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getEmail();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Order[]
     */
    public function getManageOrders(): Collection
    {
        return $this->manageOrders;
    }

    public function addManageOrder(Order $manageOrder): self
    {
        if (!$this->manageOrders->contains($manageOrder)) {
            $this->manageOrders[] = $manageOrder;
            $manageOrder->setManager($this);
        }

        return $this;
    }

    public function removeManageOrder(Order $manageOrder): self
    {
        if ($this->manageOrders->removeElement($manageOrder)) {
            // set the owning side to null (unless already changed)
            if ($manageOrder->getManager() === $this) {
                $manageOrder->setManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getShippedOrders(): Collection
    {
        return $this->shippedOrders;
    }

    public function addShippedOrder(Order $shippedOrder): self
    {
        if (!$this->shippedOrders->contains($shippedOrder)) {
            $this->shippedOrders[] = $shippedOrder;
            $shippedOrder->setDriver($this);
        }

        return $this;
    }

    public function removeShippedOrder(Order $shippedOrder): self
    {
        if ($this->shippedOrders->removeElement($shippedOrder)) {
            // set the owning side to null (unless already changed)
            if ($shippedOrder->getDriver() === $this) {
                $shippedOrder->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProduceOrderProduct[]
     */
    public function getProduceOrderProducts(): Collection
    {
        return $this->produceOrderProducts;
    }

    public function addProduceOrderProducts(ProduceOrderProduct $produceOrderProducts): self
    {
        if (!$this->produceOrderProducts->contains($produceOrderProducts)) {
            $this->produceOrderProducts[] = $produceOrderProducts;
            $produceOrderProducts->setPerformer($this);
        }

        return $this;
    }

    public function removeProduceOrderProducts(ProduceOrderProduct $produceOrderProducts): self
    {
        if ($this->produceOrderProducts->removeElement($produceOrderProducts)) {
            // set the owning side to null (unless already changed)
            if ($produceOrderProducts->getPerformer() === $this) {
                $produceOrderProducts->setPerformer(null);
            }
        }

        return $this;
    }
}
