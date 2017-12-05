<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 14.06
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createGroup('PS1k', 'PS1k'));
        $manager->persist($this->createGroup('SM', 'SM'));
        $manager->persist($this->createGroup('PS1k1g', 'PS1k1g'));
        $manager->persist($this->createGroup('PS1k2g', 'PS1k2g'));
        $manager->flush();
    }
    private function createGroup($name, $reference)
    {
        $group = new Group();
        $group->setName($name);
        $this->addReference($reference, $group);
        return $group;
    }
}
