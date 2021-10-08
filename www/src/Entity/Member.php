<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 */
class Member
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="member")
     */
    private $carts;

    /**
     * @ORM\OneToMany(targetEntity=OrderPaid::class, mappedBy="member")
     */
    private $order_paids;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
        $this->order_paids = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setMember($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getMember() === $this) {
                $cart->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderPaid[]
     */
    public function getOrderPaids(): Collection
    {
        return $this->order_paids;
    }

    public function addOrderPaid(OrderPaid $orderPaid): self
    {
        if (!$this->order_paids->contains($orderPaid)) {
            $this->order_paids[] = $orderPaid;
            $orderPaid->setMember($this);
        }

        return $this;
    }

    public function removeOrderPaid(OrderPaid $orderPaid): self
    {
        if ($this->order_paids->removeElement($orderPaid)) {
            // set the owning side to null (unless already changed)
            if ($orderPaid->getMember() === $this) {
                $orderPaid->setMember(null);
            }
        }

        return $this;
    }
}
