<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(mercure: true)]
#[ORM\Entity]
#[UniqueEntity(['brand', 'model' , 'color'], 'Duplicated')]
class Car
{
    /**
     * The entity ID
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    public string $brand = '';

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    public string $model = '';

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    public string $color = '';

    /** @var Review[] Available reviews for this car. */
    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Review::class, cascade: ['persist', 'remove'])]
    public iterable $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
