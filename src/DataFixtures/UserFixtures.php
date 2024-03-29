<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email'=>'test@exemple.com',
            'firstname'=>'Arthur',
            'lastname'=>'Parent',
            'password'=>'test',
            'roles'=>['ROLE_ADMIN']
        ]);

        $manager->flush();
    }
}
