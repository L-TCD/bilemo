<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($p = 0; $p < 20; $p++) {
            $product = new Product();
            $product
                ->setName($faker->word())
                ->setDescription($faker->paragraph())
                ->setPrice($faker->randomFloat(2, 190, 1000));

            $manager->persist($product);
        }

        // for ($c = 0; $c < 3; $c++) {
        //     $customer = new Customer();
        //     $customer
        //         ->setName($faker->safeColorName());

		// 	for ($u = 0; $u < (mt_rand(0, 50)); $u++) {
        //         $user = new User;
        //         $user
        //             ->setEmail($faker->email())
        //             ->setPassword('password')
        //             ->setUsername($faker->userName())
        //             ->setCustomer($customer);
                
        //         $manager->persist($user);

        //         $customer->addUser($user);
        //     }

        //     $manager->persist($customer);        
        // }

        $manager->flush();
    }
}
