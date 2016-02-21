<?php

namespace AppBundle\DomainManager\Gallery;

use AppBundle\Entity\Gallery\Repository\AlbumRepository;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use AppBundle\DomainManager\BaseDomainManager;
use Doctrine\ORM\EntityManager;

/**
 * @Service("album.domain.manager")
 */
class AlbumManager extends BaseDomainManager
{    
    /**
     * @var AlbumRepository
     */
    private $albumRepo;

    /**
     * @InjectParams({
     *     "em" = @Inject("doctrine.orm.entity_manager")
     * })
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->albumRepo = $em->getRepository('AppBundle:Gallery\Album');
    }

    /**
     * Get albums list
     *
     * @return \AppBundle\Entity\Gallery\Album[]
     */
    public function getAlbumsList()
    {
        return $this->albumRepo->getAlbums();
    }
}
