<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use App\Repository\OrderPaidRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderPaidRepository::class)
 */
class OrderPaid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="order_paids")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="order_paid")
     */
    private $order_details;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $total;

    public function __construct()
    {
        $this->order_details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    /**
     * @return Collection|OrderDetail[]
     */
    public function getOrderDetails(): Collection
    {
        return $this->order_details;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self
    {
        if (!$this->order_details->contains($orderDetail)) {
            $this->order_details[] = $orderDetail;
            $orderDetail->setMember($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->order_details->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getMember() === $this) {
                $orderDetail->setMember(null);
            }
        }

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }
}
