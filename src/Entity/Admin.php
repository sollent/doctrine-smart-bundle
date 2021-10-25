<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Admin
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer", unique=true)
	 */
	private int $id;

	/** @ORM\Column(type="array", nullable=false) */
	private $roles;

	/** @ORM\Column(type="string", nullable=false) */
	private $firstName;

	/** @ORM\Column(type="string", nullable=false) */
	private $lastName;

	/** @ORM\Column(type="string", nullable=false) */
	private $email;


	public function getId(): int
	{
		return $this->id;
	}


	public function setId($id): self
	{
		$this->id = $id;
		return $this;
	}


	public function getRoles()
	{
		return $this->roles;
	}


	public function setRoles($roles): self
	{
		$this->roles = $roles;
		return $this;
	}


	public function getFirstName()
	{
		return $this->firstName;
	}


	public function setFirstName($firstName): self
	{
		$this->firstName = $firstName;
		return $this;
	}


	public function getLastName()
	{
		return $this->lastName;
	}


	public function setLastName($lastName): self
	{
		$this->lastName = $lastName;
		return $this;
	}


	public function getEmail()
	{
		return $this->email;
	}


	public function setEmail($email): self
	{
		$this->email = $email;
		return $this;
	}
}
