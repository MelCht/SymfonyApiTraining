<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PossessionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PossessionRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: [
                'groups' => ['possession:read', 'possession:item:get'],
            ],
        ),
        new GetCollection(),
    ],
    normalizationContext: [
        'groups' => ['possession:read'],
    ],
    denormalizationContext: [
        'groups' => ['possession:write'],
    ]
)]
class Possession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Groups(['possession:read', 'possession:write', 'user:read'])]
    private ?string $nom = null;

    #[ORM\Column]
    #[Groups(['possession:read', 'user:read'])]
    private ?float $valeur = null;

    #[ORM\Column(length: 40)]
    #[Groups(['possession:read', 'user:read'])]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'possessions')]
    #[Groups(['possession:read'])]
    private ?User $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
