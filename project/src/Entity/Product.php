<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("product:read")
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     * @Assert\Length(max=254)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("product:read")
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     * @Assert\Length(max=2000)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups("product:read")
     * @Assert\NotBlank
     * @Assert\Length(min=0)
     * @Assert\Length(max=999.99)
     */
    private $price;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
