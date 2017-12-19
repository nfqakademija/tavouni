<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Assignment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AssignmentFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
    }

    private function createAssignment(
        string $name,
        string $subjectRef,
        int $weight,
        string $reference,
        \DateTime $date,
        string $typeRef
    ): Assignment {
        $assignment = new Assignment(
            $this->getReference($subjectRef),
            $weight,
            $name,
            $typeRef,
            $date
        );
        $this->addReference($reference, $assignment);

        return $assignment;
    }

    public function getDependencies(): array
    {
        return [
            SubjectFixtures::class,
        ];
    }
}
