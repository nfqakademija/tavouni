<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.22
 * Time: 23.59
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Grade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GradeFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $egzGrade = new Grade();
        $egzGrade->setAssignment($this->getReference('KompArchEgz'));
        $egzGrade->setStudent($this->getReference('StudentIgnas'));
        $egzGrade->setValue(9);
        $manager->persist($egzGrade);

        $kontGrade = new Grade();
        $kontGrade->setAssignment($this->getReference('KompArchKont'));
        $kontGrade->setStudent($this->getReference('StudentIgnas'));
        $kontGrade->setValue(8);
        $manager->persist($kontGrade);

        $egzGrade = new Grade();
        $egzGrade->setAssignment($this->getReference('KompArchEgz'));
        $egzGrade->setStudent($this->getReference('StudentAurimas'));
        $egzGrade->setValue(2);
        $manager->persist($egzGrade);

        $kontGrade = new Grade();
        $kontGrade->setAssignment($this->getReference('KompArchKont'));
        $kontGrade->setStudent($this->getReference('StudentAurimas'));
        $kontGrade->setValue(3);
        $manager->persist($kontGrade);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            AssignmentFixtures::class,
            StudentFixtures::class,
        ];
    }
}