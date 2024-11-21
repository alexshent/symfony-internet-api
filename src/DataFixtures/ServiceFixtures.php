<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $service = new Service();
        $service
            ->setType('internet')
            ->setValue('Unlim 1000');
        $manager->persist($service);
        $this->addReference('service_1', $service);

        $service = new Service();
        $service
            ->setType('tv')
            ->setValue('omega 60');
        $manager->persist($service);
        $this->addReference('service_2', $service);

        $service = new Service();
        $service
            ->setType('ip')
            ->setValue('10.10.10.10');
        $manager->persist($service);
        $this->addReference('service_3', $service);

        $manager->flush();
    }
}
