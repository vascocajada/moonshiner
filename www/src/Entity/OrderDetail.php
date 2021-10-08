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
     * @ORM\Column(type="integer")
     */
    private $id_order;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOrder(): ?int
    {
        return $this->id_order;
    }

    public function setIdOrder(int $id_order): self
    {
        $this->id_order = $id_order;

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
}
