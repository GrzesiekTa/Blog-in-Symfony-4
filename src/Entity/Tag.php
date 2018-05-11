<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=70)
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3,max=70)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $slug;

	public function getId() {
		return $this->id;
	}

	public function getName():  ? string {
		return $this->name;
	}

	public function setName(string $name) : self{
		$this->name = $name;

		return $this;
	}

	public function getSlug():  ? string {
		return $this->slug;
	}

	public function setSlug(string $slug) : self{
		$this->slug = $slug;

		return $this;
	}
}