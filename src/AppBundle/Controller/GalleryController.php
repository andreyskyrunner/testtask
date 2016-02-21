<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gallery\Album;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class GalleryController extends Controller
{
    /**
     * @View()
     * @Get("/albums")
     * @return \AppBundle\Entity\Gallery\Album[]
     */
    public function getAlbumsListAction()
    {
        $albumManager = $this->get('album.domain.manager');
        $albums = $albumManager->getAlbumsList();

        return $albums;
    }

    /**
     * @View()
     * @Get("/albums/{id}")
     * @QueryParam(name="page", requirements="\d+", description="page number", default=1)
     * @ParamConverter("album", class="AppBundle:Gallery\Album")
     * @param Album $album
     * @param ParamFetcher $paramFetcher
     * @return array
     */
    public function getImagesByAlbumAction(Album $album, ParamFetcher $paramFetcher)
    {
        $page = $paramFetcher->get('page');
        $imageManager = $this->get('image.domain.manager');
        $images = $imageManager->getPaginatedImagesByAlbum($album, $page);
        $paginationData = $images->getPaginationData();

        return array('album' => $album, 'images' => $images, 'paginationData' => $paginationData);
    }
}
