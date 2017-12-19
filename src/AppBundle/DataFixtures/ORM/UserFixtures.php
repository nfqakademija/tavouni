<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createUser('Ignas', 'ROLE_STUDENT', 'UserIgnas', 'ignas'));
        $manager->persist($this->createUser('Aurimas', 'ROLE_STUDENT', 'UserAurimas', 'aurimas'));
        $manager->persist($this->createUser('Antanas', 'ROLE_LECTURER', 'UserAntanas', 'antanas'));
        $manager->persist($this->createUser('Olga', 'ROLE_LECTURER', 'UserOlga', 'olga'));
        $manager->persist($this->createUser('Linas', 'ROLE_LECTURER', 'UserLinas', 'linas'));
        $manager->flush();
    }

    private function createUser(string $username, string $role, string $reference, string $apiKey): User
    {
        $user = new User(
            $username,
            'test',
            [$role],
            true,
            $username,
            $apiKey
        );
        $this->addReference($reference, $user);

        return $user;
    }
}
