<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $location1 = $this->getReference('location_1');
        $location2 = $this->getReference('location_2');

        $customer = new Customer();
        $customer
            ->setUsername('domo00000')
            ->setPhone('000000000')
            ->setEmail('test@test.ua')
            ->setLanguage('uk')
            ->setTheme('light')
            ->addLocation($location1)
            ->addLocation($location2);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $customer,
            '12345678'
        );
        $customer->setPassword($hashedPassword);

        $manager->persist($customer);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LocationFixtures::class,
        ];
    }
}
