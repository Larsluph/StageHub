<?php

namespace App\Models\Maps;

use DateTime;
//
class MapOffreStage
{
    protected int $id;
    protected int $idEntreprise;
    protected string $nomPoste;
    protected int $dureeStage;
    protected float $baseRemuneration;
    protected DateTime $dateStage;
    protected int $nbrPlaces;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getIdEntreprise(): int
    {
        return $this->idEntreprise;
    }

    /**
     * @param int $idEntreprise
     */
    public function setIdEntreprise(int $idEntreprise): void
    {
        $this->idEntreprise = $idEntreprise;
    }

    /**
     * @return string
     */
    public function getNomPoste(): string
    {
        return $this->nomPoste;
    }

    /**
     * @param string $nomPoste
     */
    public function setNomPoste(string $nomPoste): void
    {
        $this->nomPoste = $nomPoste;
    }

    /**
     * @return int
     */
    public function getDureeStage(): int
    {
        return $this->dureeStage;
    }

    /**
     * @param int $dureeStage
     */
    public function setDureeStage(int $dureeStage): void
    {
        $this->dureeStage = $dureeStage;
    }

    /**
     * @return float
     */
    public function getBaseRemuneration(): float
    {
        return $this->baseRemuneration;
    }

    /**
     * @param float $baseRemuneration
     */
    public function setBaseRemuneration(float $baseRemuneration): void
    {
        $this->baseRemuneration = $baseRemuneration;
    }

    /**
     * @return DateTime
     */
    public function getDateStage(): DateTime
    {
        return $this->dateStage;
    }

    /**
     * @param DateTime $dateStage
     */
    public function setDateStage(DateTime $dateStage): void
    {
        $this->dateStage = $dateStage;
    }

    /**
     * @return int
     */
    public function getNbrPlaces(): int
    {
        return $this->nbrPlaces;
    }

    /**
     * @param int $nbrPlaces
     */
    public function setNbrPlaces(int $nbrPlaces): void
    {
        $this->nbrPlaces = $nbrPlaces;
    }


}