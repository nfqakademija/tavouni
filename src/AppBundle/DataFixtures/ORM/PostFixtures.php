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

class PostFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setSubject($this->getReference('KompArch'));
        $post->setTitle('Paskaitos nebuvimas');
        $post->setAuthor($this->getReference('Mitasiunas'));
        $post->setContent('2017-11-28 Kompiterių architektūros paskaitos nebus, laukių pasiūlymų, kada būtų galima atidirbti paskaitą');
        $post->setPublishedAt(new \DateTime());
        $manager->persist($post);
        $manager->flush();
        $this->addReference('KAnebuvimas', $post);
    }
    public function getDependencies()
    {
        return [
            SubjectFixtures::class,
            LecturerFixtures::class,
        ];
    }
}
