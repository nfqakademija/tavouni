<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.7
 * Time: 14.01
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Ignas');
        $user->setPlainPassword('test');
        $user->setRoles(['ROLE_STUDENT']);
        $user->setEnabled(true);
        $user->setEmail('test@asd.asd');
        $manager->persist($user);
        $manager->flush();
        $this->addReference('UserIgnas', $user);

        $user = new User();
        $user->setUsername('aurimas');
        $user->setPlainPassword('test');
        $user->setRoles(['ROLE_STUDENT']);
        $user->setEnabled(true);
        $user->setEmail('test@gmail.com');
        $manager->persist($user);
        $manager->flush();
        $this->addReference('UserAurimas', $user);

        $user = new User();
        $user->setUsername('lecturer');
        $user->setPlainPassword('test');
        $user->setRoles(['ROLE_LECTURER']);
        $user->setEnabled(true);
        $user->setEmail('test2@asd.asd');
        $manager->persist($user);
        $manager->flush();
        $this->addReference('lecturer1', $user);
    }
}
