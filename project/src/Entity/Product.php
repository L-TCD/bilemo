<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(
 *      normalizationContext = {"groups" = {"product:read"}},
 *      paginationItemsPerPage = 4,
 *      paginationClientItemsPerPage = true,
 *      maximumItemsPerPage = 4,
 * )
 * 
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
     * @Assert\Range(
     *      min = 9.99,
     *      max = 999.99,
     *      notInRangeMessage = "Price must be between {{ min }} and {{ max }}"
     * )
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
