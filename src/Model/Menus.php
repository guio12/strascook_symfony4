<?php

namespace Model;

class Menus
{
    private $id;
    private $type;
    private $titre;
    private $image;
    private $introduction;
    private $entree;
    private $d_entree;
    private $plat;
    private $d_plat;
    private $dessert;
    private $d_dessert;
    private $prix;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
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
    public function getDEntree()
    {
        return $this->d_entree;
    }

    /**
     * @param mixed $d_entree
     */
    public function setDEntree($d_entree): void
    {
        $this->d_entree = $d_entree;
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
    public function getDPlat()
    {
        return $this->d_plat;
    }

    /**
     * @param mixed $d_plat
     */
    public function setDPlat($d_plat): void
    {
        $this->d_plat = $d_plat;
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
    public function getDDessert()
    {
        return $this->d_dessert;
    }

    /**
     * @param mixed $d_dessert
     */
    public function setDDessert($d_dessert): void
    {
        $this->d_dessert = $d_dessert;
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
