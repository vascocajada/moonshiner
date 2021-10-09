<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailRepository::class)
 */
class OrderDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=OrderPaid::class, inversedBy="order_details")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_paid;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="order_details")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderPaid(): ?OrderPaid
    {
        return $this->order_paid;
    }

    public function setOrderPaid(?OrderPaid $orderPaid): self
    {
        $this->order_paid = $orderPaid;

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

}
