<?php

namespace App\Models\Maps;

class MapCandidature
{
    protected int $idOffre;
    protected int $idUser;
    protected bool $isInWishlist;
    protected int $statutReponse;
    protected float $evaluation;
    protected string $cv;
    protected string $lettreMotivation;
    protected string $ficheValidation;
    protected string $conventionStage;

    /**
     * @return int
     */
    public function getIdOffre(): int
    {
        return $this->idOffre;
    }

    /**
     * @param int $idOffre
     */
    public function setIdOffre(int $idOffre): void
    {
        $this->idOffre = $idOffre;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return bool
     */
    public function isInWishlist(): bool
    {
        return $this->isInWishlist;
    }

    /**
     * @param bool $isInWishlist
     */
    public function setIsInWishlist(bool $isInWishlist): void
    {
        $this->isInWishlist = $isInWishlist;
    }

    /**
     * @return int
     */
    public function getStatutReponse(): int
    {
        return $this->statutReponse;
    }

    /**
     * @param int $statutReponse
     */
    public function setStatutReponse(int $statutReponse): void
    {
        $this->statutReponse = $statutReponse;
    }

    /**
     * @return float
     */
    public function getEvaluation(): float
    {
        return $this->evaluation;
    }

    /**
     * @param float $evaluation
     */
    public function setEvaluation(float $evaluation): void
    {
        $this->evaluation = $evaluation;
    }

    /**
     * @return string
     */
    public function getCv(): string
    {
        return $this->cv;
    }

    /**
     * @param string $cv
     */
    public function setCv(string $cv): void
    {
        $this->cv = $cv;
    }

    /**
     * @return string
     */
    public function getLettreMotivation(): string
    {
        return $this->lettreMotivation;
    }

    /**
     * @param string $lettreMotivation
     */
    public function setLettreMotivation(string $lettreMotivation): void
    {
        $this->lettreMotivation = $lettreMotivation;
    }

    /**
     * @return string
     */
    public function getFicheValidation(): string
    {
        return $this->ficheValidation;
    }

    /**
     * @param string $ficheValidation
     */
    public function setFicheValidation(string $ficheValidation): void
    {
        $this->ficheValidation = $ficheValidation;
    }

    /**
     * @return string
     */
    public function getConventionStage(): string
    {
        return $this->conventionStage;
    }

    /**
     * @param string $conventionStage
     */
    public function setConventionStage(string $conventionStage): void
    {
        $this->conventionStage = $conventionStage;
    }
}