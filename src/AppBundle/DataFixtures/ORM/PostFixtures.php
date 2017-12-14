<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Generator;

class PostFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $generator = $this->container->get(Generator::class);

        for ($i = 0; $i < 10; $i++) {
            $post = new Post(
                $generator->text(30),
                $generator->text(250),
                $this->getReference('KompArchTeor'),
                $this->getReference('LecturerAntanas')
            );
            $manager->persist($post);
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
