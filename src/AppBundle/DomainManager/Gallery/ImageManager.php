<?php

namespace AppBundle\DomainManager\Gallery;

use AppBundle\Entity\Gallery\Album;
use AppBundle\Entity\Gallery\Repository\ImageRepository;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use AppBundle\DomainManager\BaseDomainManager;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Service("image.domain.manager")
 */
class ImageManager extends BaseDomainManager
{    
    /**
     * @var ImageRepository
     */
    private $imageRepo;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * @var int
     */
    private $numImagesPerPage;

    /**
     * @InjectParams({
     *     "em" = @Inject("doctrine.orm.entity_manager"),
     *     "paginator" = @Inject("knp_paginator"),
     *     "numImagesPerPage" = @Inject("%num_images_per_page%")
     * })
     * @param EntityManager $em
     * @param PaginatorInterface $paginator
     * @param int $numImagesPerPage
     */
    public function __construct(EntityManager $em, PaginatorInterface $paginator, $numImagesPerPage)
    {
        parent::__construct($em);
        $this->imageRepo = $em->getRepository('AppBundle:Gallery\Image');
        $this->paginator = $paginator;
        $this->numImagesPerPage = $numImagesPerPage;
    }

    /**
     * @param Album $album
     * @param int $page
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getPaginatedImagesByAlbum(Album $album, $page = 1)
    {
        $query = $this->imageRepo->getImagesByAlbumQuery($album);

        return $this->paginator->paginate(
            $query,
            $page,
            $this->numImagesPerPage
        );
    }
}
