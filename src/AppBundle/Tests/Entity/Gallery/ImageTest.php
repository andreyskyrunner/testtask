<?php

namespace AppBundle\Tests\Entity\Gallery;

use AppBundle\Entity\Gallery\Image;


class ImageTest extends \PHPUnit_Framework_TestCase
{
    public function testImagePath()
    {
        $image = new Image();
        $this->assertNull($image->getImagePath());
        $image->setImagePath('http://test.com');
        $this->assertEquals('http://test.com', $image->getImagePath());
    }
}
