<?php

namespace AppBundle\Tests\DomainManager\Blog;

use AppBundle\DomainManager\Gallery\ImageManager;
use AppBundle\Tests\WebTestCase;

class ImageManagerFunctionalTest extends WebTestCase
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    public function setUp()
    {
        parent::setUp();
        $paginator = $this->getContainer()->get('knp_paginator');
        $this->imageManager = new ImageManager($this->em, $paginator, 10);
    }

    public function testGetPaginatedImagesByAlbum()
    {
        $fixtures = $this->fixtures;
        $album = $fixtures['album_1'];

        $paginatedImages = $this->imageManager->getPaginatedImagesByAlbum($album);

        $this->assertInstanceOf('\Knp\Component\Pager\Pagination\PaginationInterface', $paginatedImages);
        $this->assertInstanceOf('\AppBundle\Entity\Gallery\Image', $paginatedImages[0]);
        $this->assertEquals(5, count($paginatedImages));
    }
}
