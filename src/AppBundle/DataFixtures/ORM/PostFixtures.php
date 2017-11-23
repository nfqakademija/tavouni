<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 13.49
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
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

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setSubject($this->getReference('KompArch'));
            $post->setTitle($generator->text(30));
            $post->setAuthor($this->getReference('Mitasiunas'));
            $post->setContent($generator->text(250));
            $post->setPublishedAt(new \DateTime($generator->date()));
            $manager->persist($post);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            SubjectFixtures::class,
            LecturerFixtures::class,
        ];
    }
}
