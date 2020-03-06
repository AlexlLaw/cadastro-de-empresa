<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Empresa
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\EmpresaRepository")
 */
class Empresa implements \JsonSerializable
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
    private $nomeDaEmpresa;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $cnpj;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Socio", mappedBy="empresaId", orphanRemoval=true)
     */
    private $socios;

    /**
     * Empresa constructor.
     */
    public function __construct()
    {
        $this->socios = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getNomeDaEmpresa(): ?string
    {
        return $this->nomeDaEmpresa;
    }

    /**
     * @param string $nomeDaEmpresa
     * @return $this
     */
    public function setNomeDaEmpresa(string $nomeDaEmpresa): self
    {
        $this->nomeDaEmpresa = $nomeDaEmpresa;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    /**
     * @param string $cnpj
     * @return $this
     */
    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return $this
     */
    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     * @return $this
     */
    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return Collection|Socio[]
     */
    public function getSocios(): Collection
    {
        return $this->socios;
    }

    /**
     * @param Socio $socio
     * @return $this
     */
    public function addSocio(Socio $socio): self
    {
        if (!$this->socios->contains($socio)) {
            $this->socios[] = $socio;
            $socio->setEmpresaId($this);
        }

        return $this;
    }

    /**
     * @param Socio $socio
     * @return $this
     */
    public function removeSocio(Socio $socio): self
    {
        if ($this->socios->contains($socio)) {
            $this->socios->removeElement($socio);
            // set the owning side to null (unless already changed)
            if ($socio->getEmpresaId() === $this) {
                $socio->setEmpresaId(null);
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nomeDaEmpresa' => $this->getNomeDaEmpresa(),
            'telefone' => $this->getTelefone(),
            'cnpj' => $this->getCnpj(),
            'endereco' => $this->getEndereco()
        ];
    }
}
