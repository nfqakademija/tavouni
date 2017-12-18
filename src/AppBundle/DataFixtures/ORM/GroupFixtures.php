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
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createGroup('PS1k', 0, 'PS1k'));
        $manager->persist($this->createGroup('SM', 0, 'SM'));
        $manager->persist($this->createGroup('PS1k1g', 1, 'PS1k1g'));
        $manager->persist($this->createGroup('PS1k2g', 2, 'PS1k2g'));
        $manager->flush();
    }

    private function createGroup(string $name, int $number, string $reference): Group
    {
        $group = new Group($name, $number);
        $group->setName($name);
        $this->addReference($reference, $group);

        return $group;
    }
}
