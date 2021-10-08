<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer")
     */
    private $id_member;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="order_paids")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

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

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }
}
