<?php
/**
 * Created by PhpStorm.
 * User: worky
 * Date: 21.11.2017
 * Time: 18:26
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * class Fach
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table (name="fach")
 */
class Fach
{
    /**
     * @ORM\Column (type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue (strategy="AUTO")
     */
    private $id;

    /**
     * @var karte
     * @ORM\OneToMany(targetEntity="Karte", mappedBy="fach")
     */
    private $karte;

    /**
     * @var array
     * @ORM\Column (type="json_array")
     */
    private $kartenListe = [];

    /**
     * @ORM\ManyToOne(targetEntity="Karteikasten", inversedBy="fach")
     */
    private $karteikasten;

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
    public function getKartenListe()
    {
        return $this->kartenListe;
    }

    /**
     * @var array
     * @param Karte $karte
     * @return array
     */
    public function addKarte(Karte $karte) {

        $this->kartenListe[] = $karte;
        return $this;
    }

    /**
     * @var TYPE_NAME $item
     *
     * @return TYPE_NAME $item
     */
    public function printKarten() {
        $kartenliste = $this->kartenListe;
        foreach ($kartenliste as $item) {

              return $item;
        }
    }

    /**
     * @param mixed $kartenListe
     */
    public function setKartenListe($kartenListe)
    {
        $this->kartenListe = $kartenListe;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kartenListe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add kartenId
     *
     * @param Karte $karte
     * @return Fach
     * @internal param Karte $kartenId
     *
     */
    public function addKarten(\AppBundle\Entity\Karte $karte)
    {
        $this->kartenListe = $karte;

        return $this;
    }

    /**
     * Remove kartenId
     *
     * @param \AppBundle\Entity\Karte $karte
     */
    public function removeKarten(\AppBundle\Entity\Karte $karte)
    {
        $this->kartenListe->removeElement($karte);
    }

    /**
     * Set karteikasten
     *
     * @param \AppBundle\Entity\Karteikasten $karteikasten
     *
     * @return Fach
     */
    public function setKarteikasten(\AppBundle\Entity\Karteikasten $karteikasten = null)
    {
        $this->karteikasten = $karteikasten;

        return $this;
    }

    /**
     * Get karteikasten
     *
     * @param \AppBundle\Entity\Karteikasten $karteikasten
     *
     * @return karteikasten
     */
    public function getKarteikasten()
    {
        return $this->karteikasten;
    }
}
