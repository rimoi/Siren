<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SireneRepository")
 * @ORM\Table(name="sirene",
 * indexes={
 *      @ORM\Index(name="index_siren", columns={"siren"})
 * })
 */
class Sirene
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
    private $siren;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organization;

    public function __toString()
    {
        return $this->siren;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiren(): ?int
    {
        return $this->siren;
    }

    public function setSiren(int $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getNic(): ?int
    {
        return $this->nic;
    }

    public function setNic(?int $nic): self
    {
        $this->nic = $nic;

        return $this;
    }

    public function getOrganization(): ?string
    {
        return $this->organization;
    }

    public function setOrganization(string $organization): self
    {
        $this->organization = $organization;

        return $this;
    }


}
