<?php

namespace AppBundle\Entity\Gallery\Repository;

use AppBundle\Entity\Gallery\Album;
use Doctrine\ORM\EntityRepository;

class ImageRepository extends EntityRepository
{
    /**
     * @param Album $album
     * @return \Doctrine\ORM\Query
     */
    public function getImagesByAlbumQuery(Album $album)
    {
        $qb = $this->createQueryBuilder('i')
            ->where('i.album = :album')
            ->setParameter('album', $album);

        return $qb->getQuery();
    }
}
