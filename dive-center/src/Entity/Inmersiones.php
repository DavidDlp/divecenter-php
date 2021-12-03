<?php

namespace App\Entity;

use App\Repository\InmersionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InmersionesRepository::class)
 */
class Inmersiones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
    private $lugar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ciudad;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="evento")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Divecenter::class, mappedBy="ruta")
     */
    private $divecenters;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->divecenters = new ArrayCollection();
    }

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

    public function getLugar(): ?string
    {
        return $this->lugar;
    }

    public function setLugar(?string $lugar): self
    {
        $this->lugar = $lugar;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(?string $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEvento($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEvento() === $this) {
                $user->setEvento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Divecenter[]
     */
    public function getDivecenters(): Collection
    {
        return $this->divecenters;
    }

    public function addDivecenter(Divecenter $divecenter): self
    {
        if (!$this->divecenters->contains($divecenter)) {
            $this->divecenters[] = $divecenter;
            $divecenter->addRutum($this);
        }

        return $this;
    }

    public function removeDivecenter(Divecenter $divecenter): self
    {
        if ($this->divecenters->removeElement($divecenter)) {
            $divecenter->removeRutum($this);
        }

        return $this;
    }
}
