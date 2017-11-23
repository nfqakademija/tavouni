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
        $manager->persist($this->createUser('Ignas', 'ROLE_STUDENT', 'UserIgnas'));
        $manager->persist($this->createUser('Aurimas', 'ROLE_STUDENT', 'UserAurimas'));
        $manager->persist($this->createUser('Antanas', 'ROLE_LECTURER', 'UserAntanas'));
        $manager->persist($this->createUser('Olga', 'ROLE_LECTURER', 'UserOlga'));
        $manager->flush();
    }
    private function createUser($username, $role, $reference) {
        $user = new User();
        $user->setUsername($username);
        $user->setPlainPassword('test');
        $user->setRoles([$role]);
        $user->setEnabled(true);
        $user->setEmail($username.'@asd.asd');
        $this->addReference($reference, $user);
        return $user;
    }
}
