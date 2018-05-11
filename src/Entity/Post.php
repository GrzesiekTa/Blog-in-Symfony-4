<?php

namespace App\Entity;

// use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=100)

	 * @Assert\NotBlank()
	 * @Assert\Length(min=3,max=100)
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 */

	private $slug;
	/**
	 * @ORM\Column(type="text", length=16777215)


	 * @Assert\NotBlank()
	 * @Assert\Length(min=30,max=16777215)
	 */
	private $content;

	/**
	 * @ORM\Column(type="string", length=500)

	 * @Assert\NotBlank()
	 * @Assert\Length(min=10,max=500)
	 */
	private $shortcontent;

	/**
	 *
	 * @ORM\Column(type="datetime")
	 * @Assert\NotBlank()
	 * @Assert\DateTime
	 */
	private $publishedAt;

	/**
	 * @ORM\Column(type="string", length=71)


	 * @Assert\NotBlank()
	 * @Assert\Length(min=10,max=71)
	 */
	private $headtitle;

	/**
	 * @ORM\Column(type="string", length=200)


	 * @Assert\NotBlank()
	 * @Assert\Length(min=10,max=200)
	 */
	private $keyworks;

	/**
	 * @ORM\Column(type="string", length=278)


	 * @Assert\NotBlank()
	 * @Assert\Length(min=10,max=278)
	 */
	private $description;

	/**
	 * @var Tag[]|ArrayCollection
	 *
	 * @ORM\ManyToMany(targetEntity="App\Entity\Tag", cascade={"persist"})
	 * @ORM\JoinTable(name="blog_post_tag")
	 * @ORM\OrderBy({"name": "ASC"})
	 * @Assert\Count(max="5", maxMessage="to many tags max 5")
	 */
	private $tags;

	public function __construct() {
		$this->publishedAt = new \DateTime();
		$this->tags = new ArrayCollection();

	}

	public function getId() {
		return $this->id;
	}

	public function getTitle():  ? string {
		return $this->title;
	}

	public function setTitle(string $title) : self{
		$this->title = $title;

		return $this;
	}

	public function getSlug():  ? string {
		return $this->slug;
	}

	public function setSlug( ? string $slug) : void{
		$this->slug = $slug;
	}

	public function getContent() :  ? string {
		return $this->content;
	}

	public function setContent(string $content) : self{
		$this->content = $content;

		return $this;
	}

	public function getShortContent():  ? string {
		return $this->shortcontent;
	}

	public function setShortContent(string $shortcontent) : self{
		$this->shortcontent = $shortcontent;

		return $this;
	}

	public function getPublishedAt(): \DateTime {
		return $this->publishedAt;
	}

	public function setPublishedAt( ? \DateTime $publishedAt) : void{
		$this->publishedAt = $publishedAt;
	}

	public function getHeadtitle():  ? string {
		return $this->headtitle;
	}

	public function setHeadtitle(string $headtitle) : self{
		$this->headtitle = $headtitle;

		return $this;
	}

	public function getKeyworks():  ? string {
		return $this->keyworks;
	}

	public function setKeyworks(string $keyworks) : self{
		$this->keyworks = $keyworks;

		return $this;
	}

	public function getDescription():  ? string {
		return $this->description;
	}

	public function setDescription(string $description) : self{
		$this->description = $description;

		return $this;
	}

	public function addTag( ? Tag...$tags) : void {
		foreach ($tags as $tag) {
			if (!$this->tags->contains($tag)) {
				$this->tags->add($tag);
			}
		}
	}

	public function removeTag(Tag $tag): void{
		$this->tags->removeElement($tag);
	}

	public function getTags(): Collection {
		return $this->tags;
	}

}
