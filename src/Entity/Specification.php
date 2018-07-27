<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecificationsRepository")
 */
class Specification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sp1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sp2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sp3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sp4;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sp5;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sp6;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Division", inversedBy="specifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $division;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Annonce", inversedBy="specifications")
     *
     */
    private $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSp1(): ?string
    {
        return $this->sp1;
    }

    public function setSp1(?string $sp1): self
    {
        $this->sp1 = $sp1;

        return $this;
    }

    public function getSp2(): ?string
    {
        return $this->sp2;
    }

    public function setSp2(?string $sp2): self
    {
        $this->sp2 = $sp2;

        return $this;
    }

    public function getSp3(): ?string
    {
        return $this->sp3;
    }

    public function setSp3(?string $sp3): self
    {
        $this->sp3 = $sp3;

        return $this;
    }

    public function getSp4(): ?string
    {
        return $this->sp4;
    }

    public function setSp4(?string $sp4): self
    {
        $this->sp4 = $sp4;

        return $this;
    }

    public function getSp5(): ?float
    {
        return $this->sp5;
    }

    public function setSp5(?float $sp5): self
    {
        $this->sp5 = $sp5;

        return $this;
    }

    public function getSp6(): ?float
    {
        return $this->sp6;
    }

    public function setSp6(?float $sp6): self
    {
        $this->sp6 = $sp6;

        return $this;
    }

    public function getDivision(): ?Division
    {
        return $this->division;
    }

    public function setDivision(?Division $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
    public function __toString()
    {
        return $this->getDivision()->getName();
    }
}
