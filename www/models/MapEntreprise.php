<?php

namespace App\Models\Maps;

class MapEntreprise
{
    protected int $id;
    protected string $name;
    protected bool $hidden;

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getHidden(): ?bool
    {
        return $this->hidden ?? null;
    }

    public function setHidden(bool $isHidden) {
        $this->hidden = $isHidden;
    }
}
