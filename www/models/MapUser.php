<?php

namespace App\Models\Maps;

class MapUser
{
    protected int $id;
    protected int $idRole;
    protected string $username;
    protected string $hash;
    protected string $firstName;
    protected string $lastName;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdRole(): ?int
    {
        return $this->idRole ?? null;
    }

    /**
     * @param int $idRole
     */
    public function setIdRole(int $idRole): void
    {
        $this->idRole = $idRole;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username ?? null;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getHash(): ?string
    {
        return $this->hash ?? null;
    }

    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName ?? null;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName ?? null;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
}