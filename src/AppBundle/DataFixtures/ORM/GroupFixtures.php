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
        $group = new Group();
        //$group->addStudent($this->getReference('StudentIgnas'));
        $group->setName('PS1k');
        $manager->persist($group);
        $manager->flush();
        $this->addReference('PS1k', $group);
    }
}
