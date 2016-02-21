<?php

namespace AppBundle\Tests\Entity\Gallery;

use AppBundle\Entity\Gallery\Album;


class AlbumTest extends \PHPUnit_Framework_TestCase
{
    public function testTitle()
    {
        $album = new Album();
        $this->assertNull($album->getTitle());
        $album->setTitle('New Title');
        $this->assertEquals('New Title', $album->getTitle());
    }
}
