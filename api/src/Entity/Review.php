<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(mercure: true)]
#[ORM\Entity]
class Review
{
    /**
     * The entity ID
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    /** The rating of this review (between 0 and 5). */
    #[ORM\Column(type: 'smallint')]
    #[Assert\Range(min: 0, max: 10)]
    public int $rating = 0;

    /** The body of the review. */
    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    public string $body = '';


    /** The related car this review is about. */
    #[ORM\ManyToOne(targetEntity: 'Car', inversedBy: 'reviews')]
    public ?Car $car = null;
    public function getId(): ?int
    {
        return $this->id;
    }
}
