<?php

namespace AppBundle\DomainManager;

use Doctrine\ORM\EntityManager;

class BaseDomainManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function update($object, $doFlush = true)
    {
        $this->em->persist($object);
        if ($doFlush) {
            $this->em->flush();
        }
    }
    
    public function remove($object, $doFlush = true)
    {
        $this->em->remove($object);
        if ($doFlush) {
            $this->em->flush();
        }
    }
    
    public function flush()
    {
        $this->em->flush();
    }
    
    public function closeConnection()
    {
        $this->em->getConnection()->close();
    }
}
