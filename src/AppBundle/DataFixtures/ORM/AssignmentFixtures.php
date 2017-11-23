<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.22
 * Time: 23.58
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Assignment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AssignmentFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $egzaminas = new Assignment();
        $egzaminas->setName("Egzaminas");
        $egzaminas->setLectureType($this->getReference('Teorija'));
        $egzaminas->setSubject($this->getReference('KompArch'));
        $egzaminas->setWeight(60);
        $manager->persist($egzaminas);
        $this->addReference('KompArchEgz', $egzaminas);
        $kontrolinis = new Assignment();
        $kontrolinis->setName("Kontrolinis");
        $kontrolinis->setLectureType($this->getReference('Teorija'));
        $kontrolinis->setSubject($this->getReference('KompArch'));
        $kontrolinis->setWeight(40);
        $manager->persist($kontrolinis);
        $this->addReference('KompArchKont', $kontrolinis);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            LectureTypeFixtures::class,
            SubjectFixtures::class,
        ];
    }
}