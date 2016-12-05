<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 12/11/2016
 * Time: 14:00
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Genus;
use AppBundle\Entity\SubFamily;
use Doctrine\ORM\EntityRepository;

class SubFamilyRepository extends EntityRepository
{
    public function createAlphabeticalQueryBuilder()
    {
        return $this->createQueryBuilder('sub_family')
            ->orderBy('sub_family.name', 'ASC');
    }
}