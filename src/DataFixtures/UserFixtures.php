<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        

        $roles[] = 'ROLE_USER';

        $user = new User();

        $user->setEmail('rien@coucou');
        $user->setRoles($roles);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'rien'
        ));
        $user->setUsername('rien');

        $manager->persist($user);

        $manager->flush();
    }
}
