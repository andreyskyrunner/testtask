<?php

namespace AppBundle\Entity\Gallery\Repository;

use AppBundle\Entity\Gallery\Album;
use Doctrine\ORM\EntityRepository;

class AlbumRepository extends EntityRepository
{
    /**
     * @return Album[]
     */
    public function getAlbums()
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.title', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
