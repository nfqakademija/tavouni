<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Generator;

class PostFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $generator = $this->container->get(Generator::class);
        $references = $this->referenceRepository->getReferences();

        foreach (LectureFixtures::$lectures as $lecture) {
            for ($i = 0; $i < 5; $i++) {
                $post = new Post(
                    $generator->text(30),
                    $generator->text(250),
                    $this->getReference($lecture['reference']),
                    $this->getReference($lecture['lecturerRef'])
                );
                $manager->persist($post);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LectureFixtures::class,
            LecturerFixtures::class,
        ];
    }
}
