<?php

namespace AppBundle\Entity\Gallery;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * Album
 *
 * @ORM\Table(name="Album")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Gallery\Repository\AlbumRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @JMS\Expose()
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Gallery\Image", mappedBy="album", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $images;

    /**
     * Album constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Album
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
     * Add images
     *
     * @param \AppBundle\Entity\Gallery\Image $images
     * @return Album
     */
    public function addImage(\AppBundle\Entity\Gallery\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \AppBundle\Entity\Gallery\Image $images
     */
    public function removeImage(\AppBundle\Entity\Gallery\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
