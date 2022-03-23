<?php

namespace App\Models\Maps;

class MapUserPermission
{
    protected int $idUser;
    protected int $idPermission;
    protected bool $isEnabled;

    /**
     * @return int
     */
    public function getIdUser(): ?int
    {
        return $this->idUser ?? null;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdPermission(): ?int
    {
        return $this->idPermission ?? null;
    }

    /**
     * @param int $idPermission
     */
    public function setIdPermission(int $idPermission): void
    {
        $this->idPermission = $idPermission;
    }

    /**
     * @return bool
     */
    public function isEnabled(): ?bool
    {
        return $this->isEnabled ?? null;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }
}