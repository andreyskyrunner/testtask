<?php

namespace AppBundle\Entity\Gallery;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Image
 *
 * @ORM\Table(name="Image")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Gallery\Repository\ImageRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Image
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
     * @ORM\Column(name="image_path", type="string", length=255)
     * @JMS\Expose()
     */
    private $imagePath;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gallery\Album", inversedBy="images")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $album;

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
     * Set imagePath
     *
     * @param string $imagePath
     * @return Image
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set album
     *
     * @param \AppBundle\Entity\Gallery\Album $album
     * @return Image
     */
    public function setAlbum(\AppBundle\Entity\Gallery\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \AppBundle\Entity\Gallery\Album 
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
