<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_member;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_product;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="carts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="carts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMember(): ?int
    {
        return $this->id_member;
    }

    public function setIdMember(int $id_member): self
    {
        $this->id_member = $id_member;

        return $this;
    }

    public function getIdProduct(): ?int
    {
        return $this->id_product;
    }

    public function setIdProduct(int $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
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
