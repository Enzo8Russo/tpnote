<?php
namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 175)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Datepublication = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Unechaine = null;

    #[ORM\ManyToOne(targetEntity: Chaine::class, inversedBy: "videos")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chaine $chaine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDatepublication(): ?\DateTimeInterface
    {
        return $this->Datepublication;
    }

    public function setDatepublication(\DateTimeInterface $Datepublication): static
    {
        $this->Datepublication = $Datepublication;

        return $this;
    }

    public function getUnechaine(): ?string
    {
        return $this->Unechaine;
    }

    public function setUnechaine(string $Unechaine): static
    {
        $this->Unechaine = $Unechaine;

        return $this;
    }

    public function getChaine(): ?Chaine
    {
        return $this->chaine;
    }

    public function setChaine(?Chaine $chaine): static
    {
        $this->chaine = $chaine;

        return $this;
    }
}
