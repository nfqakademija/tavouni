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

class PostFixtures extends Fixture
{
    private $generator;
    public function __construct()
    {
        $this->generator = Factory::create();
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setSubject($this->getReference('KompArch'));
            $post->setTitle($this->generator->text(30));
            $post->setAuthor($this->getReference('Mitasiunas'));
            $post->setContent($this->generator->text(250));
            $post->setPublishedAt(new \DateTime($this->generator->date()));
            $manager->persist($post);
            //$this->addReference('KAnebuvimas', $post);
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
