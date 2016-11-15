<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 08/11/2016
 * Time: 11:04
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use AppBundle\Entity\Genus;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // FOR ONE USER ROR
//        $user = new User();
//        $user->setLogin('admin');
//        $user->setEmail('bemben@ds.pl');
//        $user->setFirstName('mich');
//        $user->setLastName('smig');
//        $user->setPassword('pass');
//        $user->setOrganizationRole(2);
//
//        $manager->persist($user);
//        $manager->flush();

        $objects = Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers'=>[$this]
            ]
        );
    }
    public function projectRoleName()
    {
        $values =[
            'project leader',
            'project secretary',
            'project treasurer',
            'project member'
        ];
        return $values[array_rand($values)];
    }

    public function roleName()
    {
        $names = [
            'student',
            'admin',
            'lecturer'
        ];
        $key = array_rand($names);
        return $names[$key];
    }

    public function genus()
    {
        $genera = [
            'Octopus',
            'Balaena',
            'Orcinus',
            'Hippocampus',
            'Asterias',
            'Amphiprion',
            'Carcharodon',
            'Aurelia',
            'Cucumaria',
            'Balistoides',
            'Paralithodes',
            'Chelonia',
            'Trichechus',
            'Eumetopias'
        ];
        $key = array_rand($genera);
        return $genera[$key];

    }
}