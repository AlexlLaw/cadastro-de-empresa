<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Socio
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SocioRepository")
 */
class Socio implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Empresa", inversedBy="socios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empresaId;


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
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @param string|null $nome
     * @return $this
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    /**
     * @param string|null $cpf
     * @return $this
     */
    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;

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
     * @return string|null
     */
    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    /**
     * @param string|null $cargo
     * @return $this
     */
    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * @return Empresa|null
     */
    public function getEmpresaId(): ?Empresa
    {
        return $this->empresaId;
    }

    /**
     * @param Empresa|null $empresaId
     * @return $this
     */
    public function setEmpresaId(?Empresa $empresaId): self
    {
        $this->empresaId = $empresaId;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'endereco' => $this->getEndereco(),
            'cargo' => $this->getCargo(),
            'cpf' => $this->getCpf(),
            'telefone' => $this->getTelefone(),
            'empresa' => $this->getEmpresaId()
        ];
    }
}
