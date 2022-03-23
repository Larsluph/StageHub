<?php

namespace App\Models\Maps;

class MapLocalite
{
    protected int $id;
    protected string $name;

    public function getId(): ?int {
        return $this->id ?? null;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName(): ?string {
        return $this->name ?? null;
    }

    public function setName($name) {
        $this->name = $name;
    }
}