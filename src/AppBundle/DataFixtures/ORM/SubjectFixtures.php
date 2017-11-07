<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 13.54
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $subject = new Subject();
        $subject->setName('Kompiuterių architektūra');
        $subject->setSubjectType('Privalomas');
        $manager->persist($subject);
        $manager->flush();
        $this->addReference('KompArch', $subject);
    }
}
