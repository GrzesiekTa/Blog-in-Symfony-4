<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $shortcontent;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=71)
     */
    private $headtitle;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $keyworks;

    /**
     * @ORM\Column(type="string", length=278)
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getShortContent(): ?string
    {
        return $this->shortcontent;
    }

    public function setShortContent(string $shortcontent): self
    {
        $this->shortcontent = $shortcontent;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeadtitle(): ?string
    {
        return $this->headtitle;
    }

    public function setHeadtitle(string $headtitle): self
    {
        $this->headtitle = $headtitle;

        return $this;
    }

    public function getKeyworks(): ?string
    {
        return $this->keyworks;
    }

    public function setKeyworks(string $keyworks): self
    {
        $this->keyworks = $keyworks;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
