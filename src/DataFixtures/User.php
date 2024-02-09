<?php

namespace App\DataFixtures;

use AllowDynamicProperties;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AllowDynamicProperties] class User extends Fixture
{

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // User is Redakteur

        $faker = Factory::create();
        $user = new \App\Entity\User();

        $user->setEmail('test@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        // Hash the password using the password hasher
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'test123');
        $user->setPassword($hashedPassword);
        $manager->persist($user);
        $manager->flush();
    }
}
