<?php

namespace AppBundle\Tests\DomainManager\Gallery;

use AppBundle\DomainManager\Gallery\ImageManager;
use AppBundle\Entity\Gallery\Album;
use AppBundle\Entity\Gallery\Repository\ImageRepository;
use Doctrine\ORM\EntityManager;

class ImageManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $imageRepo;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $em;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $paginator;

    public function setUp()
    {
        $this->imageRepo = $this
            ->getMockBuilder(ImageRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->em = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->em
            ->expects($this->once())
            ->method('getRepository')
            ->with('AppBundle:Gallery\Image')
            ->will($this->returnValue($this->imageRepo));

        $this->paginator = $this->getMock('Knp\Component\Pager\PaginatorInterface');
        $numImagesPerPage = 10;

        $this->imageManager = new ImageManager($this->em, $this->paginator, $numImagesPerPage);
    }

    public function testGetPaginatedImagesByAlbum()
    {
        $album = new Album();

        $this->imageRepo
            ->expects($this->exactly(2))
            ->method('getImagesByAlbumQuery')
            ->with($album);

        $this->paginator
            ->expects($this->exactly(2))
            ->method('paginate')
            ->with(
                $this->anything(),
                $this->greaterThan(0),
                $this->greaterThan(0)
            );

        $this->imageManager->getPaginatedImagesByAlbum($album);
        $page = 2;
        $this->imageManager->getPaginatedImagesByAlbum($album, $page);
    }
}
