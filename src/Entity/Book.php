<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 * @ORM\Table(name="books")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $title;

    /**
     * @ORM\Column(type="string", length=13, options={"fixed"=true})
     */
    public string $isbn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public ?string $description = null;

    /**
     * @ORM\ManyToMany(targetEntity="Genre", fetch="EAGER")
     * @ORM\JoinTable(
     *     name="books_genres",
     *     joinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="genre_id", referencedColumnName="id")},
     * )
     *
     * @var Collection|Genre[]
     */
    public Collection $genres;

    /**
     * @ORM\ManyToMany(targetEntity="Author", fetch="EAGER")
     * @ORM\JoinTable(
     *     name="authors_books",
     *     joinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="author_id", referencedColumnName="id")},
     * )
     *
     * @var Collection|Author[]
     */
    public Collection $authors;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }
}
