<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class MovieSearch
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce Champ")
     * @Assert\Type("string")
     */
    private $movieSearchByTitle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovieSearchByTitle(): ?string
    {
        return $this->movieSearchByTitle;
    }

    public function setMovieSearchByTitle(string $movieSearchByTitle): self
    {
        $this->movieSearchByTitle = $movieSearchByTitle;

        return $this;
    }
}
