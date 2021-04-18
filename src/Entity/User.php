<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Velo::class, mappedBy="user")
     */
    private $velo;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="userAmis")
     */
    private $amis;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="amis")
     */
    private $userAmis;

    /**
     * @ORM\ManyToMany(targetEntity=Sortie::class, mappedBy="users")
     */
    private $sorties;

    public function __construct()
    {
        $this->velo = new ArrayCollection();
        $this->amis = new ArrayCollection();
        $this->userAmis = new ArrayCollection();
        $this->sorties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Velo[]
     */
    public function getVelo(): Collection
    {
        return $this->velo;
    }

    public function addVelo(Velo $velo): self
    {
        if (!$this->velo->contains($velo)) {
            $this->velo[] = $velo;
            $velo->setUser($this);
        }

        return $this;
    }

    public function removeVelo(Velo $velo): self
    {
        if ($this->velo->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getUser() === $this) {
                $velo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAmis(): Collection
    {
        return $this->amis;
    }

    public function addAmi(self $ami): self
    {
        if (!$this->amis->contains($ami)) {
            $this->amis[] = $ami;
        }

        return $this;
    }

    public function removeAmi(self $ami): self
    {
        $this->amis->removeElement($ami);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUserAmis(): Collection
    {
        return $this->userAmis;
    }

    public function addUserAmi(self $userAmi): self
    {
        if (!$this->userAmis->contains($userAmi)) {
            $this->userAmis[] = $userAmi;
            $userAmi->addAmi($this);
        }

        return $this;
    }

    public function removeUserAmi(self $userAmi): self
    {
        if ($this->userAmis->removeElement($userAmi)) {
            $userAmi->removeAmi($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorty(Sortie $sorty): self
    {
        if (!$this->sorties->contains($sorty)) {
            $this->sorties[] = $sorty;
            $sorty->addUser($this);
        }

        return $this;
    }

    public function removeSorty(Sortie $sorty): self
    {
        if ($this->sorties->removeElement($sorty)) {
            $sorty->removeUser($this);
        }

        return $this;
    }


    public function __toString(): string
    {
        return $this->username;
    }
}