<?php

namespace App\Models\Maps;

class MapSecteurActivite
{
    protected int $id;
    protected string $name;

    public function getId(): ?int {
        return $this->id ?? null;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getName(): ?string {
        return $this->name ?? null;
    }

    public function setName(string $name) {
        $this->name = $name;
    }
}