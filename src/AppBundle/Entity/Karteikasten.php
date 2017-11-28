<?php
/**
 * Created by PhpStorm.
 * User: worky
 * Date: 21.11.2017
 * Time: 19:45
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * class Karteikasten
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="KarteikastenRepository")
 * @ORM\Table (name="karteikasten")
 */
class Karteikasten {
    /**
     * @ORM\Column (type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue (strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="karteikasten")
     */
    private $user;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Fach
     */
    public function getFach() {
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
     * @return mixed
     */
    public function getFachListe()
    {
        return $this->fachListe;
    }

    /**
     * @param mixed $fachListe
     */
    public function setFachListe($fachListe)
    {
        $this->fachListe = $fachListe;
    }

    /**
     * @ORM\OneToMany(targetEntity="Fach", mappedBy="karteikasten")
     */
    private $fach;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @ORM\Column (type="json_array")
     */
    private $fachListe = [];

    /**
     * Karteikasten constructor.
     */
    public function __construct()
    {
        $this->fachListe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var TYPE_NAME $faecher
     * @return mixed
     */
    public function printFaecher() {
        $newFach = new Fach();
        foreach ($this->getFachListe() as $faecher) {
            $fachinhalt = $newFach->getId($faecher) . ' | '. $newFach->printKarten($faecher);
            return $fachinhalt;
        }
    }

    /**
     *
     */
    public function load() {

    }

    public function save() {

    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Karteikasten
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @param \AppBundle\Entity\Fach $fach
     *
     * @return Karteikasten
     */
    public function addFach(\AppBundle\Entity\Fach $fach)
    {
        $this->fachliste[] = $fach;

        return $this;
    }

    /**
     * Remove fach
     *
     * @param \AppBundle\Entity\Fach $fach
     */
    public function removeFach(\AppBundle\Entity\Fach $fach)
    {
        $this->fachListe->removeElement($fach);
    }
}
