<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DivisionRepository")
 */
class Division
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="divisions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoey;

    public function getId()
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

    public function getCategoey(): ?Category
    {
        return $this->categoey;
    }

    public function setCategoey(?Category $categoey): self
    {
        $this->categoey = $categoey;

        return $this;
    }
}
