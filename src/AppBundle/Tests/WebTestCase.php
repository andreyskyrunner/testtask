<?php

namespace AppBundle\Tests;

use Doctrine\ORM\Tools\SchemaTool;
use Liip\FunctionalTestBundle\Test\WebTestCase as BaseWebTestCase;

class WebTestCase extends BaseWebTestCase
{
    protected $em;
    protected $fixtures;

    protected function setUp()
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
        if (!isset($metadatas)) {
            $metadatas = $this->em->getMetadataFactory()->getAllMetadata();
        }
        $schemaTool = new SchemaTool($this->em);
        $schemaTool->dropDatabase();
        if (!empty($metadatas)) {
            $schemaTool->createSchema($metadatas);
        }
        $this->postFixtureSetup();

        $files = array(
            '@AppBundle/DataFixtures/ORM/Album.yml',
            '@AppBundle/DataFixtures/ORM/Image.yml',
        );

        $this->fixtures = $this->loadFixtureFiles($files);//->getReferenceRepository();
    }
}
