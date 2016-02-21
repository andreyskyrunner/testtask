<?php

namespace AppBundle\Tests\DomainManager\Blog;

use AppBundle\DomainManager\Gallery\AlbumManager;
use AppBundle\Entity\Gallery\Album;
use AppBundle\Tests\WebTestCase;

class AlbumManagerFunctionalTest extends WebTestCase
{
    /**
     * @var AlbumManager
     */
    private $albumManager;

    public function setUp()
    {
        parent::setUp();
        $this->albumManager = new AlbumManager($this->em);
    }

    public function testGetAlbumsList()
    {
        /** @var Album[] $albums */
        $albums = $this->albumManager->getAlbumsList();

        $this->assertInstanceOf('\AppBundle\Entity\Gallery\Album', $albums[0]);
        $this->assertEquals(5, count($albums));
    }
}
