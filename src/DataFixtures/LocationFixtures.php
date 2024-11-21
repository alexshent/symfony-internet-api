<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $service1 = $this->getReference('service_1');
        $service2 = $this->getReference('service_2');
        $service3 = $this->getReference('service_3');

        $location = new Location();
        $location
            ->setAddress('34 кв. Академіка Ломоносова, 36')
            ->setStatus('active')
            ->setTariff('Unlim 1000')
            ->setBalance('230.00')
            ->addService($service1)
            ->addService($service2)
            ->addService($service3);
        $manager->persist($location);
        $this->addReference('location_1', $location);

        $location = new Location();
        $location
            ->setAddress('25 кв. Богдана Хмельницького, 12')
            ->setStatus('disabled')
            ->setTariff('Unlim 1000')
            ->setBalance('0.00')
            ->addService($service1)
            ->addService($service2)
            ->addService($service3);
        $manager->persist($location);
        $this->addReference('location_2', $location);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ServiceFixtures::class,
        ];
    }
}
