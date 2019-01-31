<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
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
    private $idMovie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $myCritic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $myRating;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="movies")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;





    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getMyCritic(): ?string
    {
        return $this->myCritic;
    }

    public function setMyCritic(?string $myCritic): self
    {
        $this->myCritic = $myCritic;

        return $this;
    }

    public function getMyRating(): ?string
    {
        return $this->myRating;
    }

    public function setMyRating(?string $myRating): self
    {
        $this->myRating = $myRating;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    /**
     * @param mixed $idMovie
     */
    public function setIdMovie($idMovie): void
    {
        $this->idMovie = $idMovie;
    }


}
