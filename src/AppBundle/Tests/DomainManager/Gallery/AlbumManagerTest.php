<?php

namespace AppBundle\Tests\DomainManager\Gallery;

use AppBundle\DomainManager\Gallery\AlbumManager;
use AppBundle\Entity\Gallery\Repository\AlbumRepository;
use Doctrine\ORM\EntityManager;

class AlbumManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AlbumManager
     */
    private $albumManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $albumRepo;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $em;

    public function setUp()
    {
        $this->albumRepo = $this
            ->getMockBuilder(AlbumRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->em = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->em
            ->expects($this->once())
            ->method('getRepository')
            ->with('AppBundle:Gallery\Album')
            ->will($this->returnValue($this->albumRepo));

        $this->albumManager = new AlbumManager($this->em);
    }

    public function testGetAlbumsList()
    {
        $this->albumRepo
            ->expects($this->once())
            ->method('getAlbums');

        $this->albumManager->getAlbumsList();
    }
}
