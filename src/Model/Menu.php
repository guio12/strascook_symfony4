<?php

namespace Model;

class Menu
{
    private $titre;
    private $image;
    private $introduction;
    private $entree;
    private $plat;
    private $dessert;
    private $prix;

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * @param mixed $introduction
     */
    public function setIntroduction($introduction): void
    {
        $this->introduction = $introduction;
    }

    /**
     * @return mixed
     */
    public function getEntree()
    {
        return $this->entree;
    }

    /**
     * @param mixed $entree
     */
    public function setEntree($entree): void
    {
        $this->entree = $entree;
    }

    /**
     * @return mixed
     */
    public function getPlat()
    {
        return $this->plat;
    }

    /**
     * @param mixed $plat
     */
    public function setPlat($plat): void
    {
        $this->plat = $plat;
    }

    /**
     * @return mixed
     */
    public function getDessert()
    {
        return $this->dessert;
    }

    /**
     * @param mixed $dessert
     */
    public function setDessert($dessert): void
    {
        $this->dessert = $dessert;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix): void
    {
        $this->prix = $prix;
    }

}
