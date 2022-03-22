<?php

class Entreprise
{
    protected int $id_entreprise;
    protected string $nom_entreprise;
    protected bool $hidden;

    public function __construct($id, $nom, $hidden) {
        $this->id_entreprise = $id;
        $this->nom_entreprise = $nom;
        $this->hidden = $hidden;
    }

    public function get_id(): int
    {
        return $this->id_entreprise;
    }

    public function get_name(): string
    {
        return $this->nom_entreprise;
    }

    public function is_hidden(): bool
    {
        return $this->hidden;
    }
}
