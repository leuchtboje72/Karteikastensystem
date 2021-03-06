<?php
/**
 * Created by PhpStorm.
 * User: worky
 * Date: 21.11.2017
 * Time: 18:12
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * class Karte
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table (name="karte")
 */
class Karte {
    /**
     * @ORM\Column (type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue (strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Category", cascade={"persist"})
     */
    private $category;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFrage()
    {
        return $this->frage;
    }

    /**
     * @param mixed $frage
     */
    public function setFrage($frage)
    {
        $this->frage = $frage;
    }

    /**
     * @return mixed
     */
    public function getAntwort()
    {
        return $this->antwort;
    }

    /**
     * @param mixed $antwort
     */
    public function setAntwort($antwort)
    {
        $this->antwort = $antwort;
    }

    /**
     * @return mixed
     */
    public function getFach()
    {
        return $this->fach;
    }

    /**
     * @param mixed $fach
     */
    public function setFach($fach)
    {
        $this->fach = $fach;
    }

    /**
     * @ORM\Column (type="string")
     */
    private $frage;

    /**
     * @ORM\Column (type="string")
     */
    private $antwort;

    /**
     * @ORM\ManyToOne(targetEntity="Fach", inversedBy="karte")
     */
    private $fach;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Karte
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }
}
