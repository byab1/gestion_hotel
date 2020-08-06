<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroChambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $etage;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="chambres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambreHotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photochambre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Comodite::class, mappedBy="chambre")
     */
    private $comodites;

    public function __construct()
    {
        $this->comodites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroChambre(): ?int
    {
        return $this->numeroChambre;
    }

    public function setNumeroChambre(int $numeroChambre): self
    {
        $this->numeroChambre = $numeroChambre;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getChambreHotel(): ?Hotel
    {
        return $this->chambreHotel;
    }

    public function setChambreHotel(?Hotel $chambreHotel): self
    {
        $this->chambreHotel = $chambreHotel;

        return $this;
    }


    public function getPhotochambre()
    {
        return $this->photochambre;
    }
    public function setPhotochambre()
    {
        return $this->photochambre;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
    // public function setPhotochambre(UploadedFile $photochambre)
    // {
    //     $this->photochambre = $photochambre;

    //     if (null != $this->photochambre) {
    //         $this->tempFilename = $this->photochambre;
    //     }

    //     return $this;
    // }


    /**
     * @return Collection|Comodite[]
     */
    public function getComodites(): Collection
    {
        return $this->comodites;
    }

    public function addComodite(Comodite $comodite): self
    {
        if (!$this->comodites->contains($comodite)) {
            $this->comodites[] = $comodite;
            $comodite->setChambre($this);
        }

        return $this;
    }

    public function removeComodite(Comodite $comodite): self
    {
        if ($this->comodites->contains($comodite)) {
            $this->comodites->removeElement($comodite);
            // set the owning side to null (unless already changed)
            if ($comodite->getChambre() === $this) {
                $comodite->setChambre(null);
            }
        }

        return $this;
    }
}
