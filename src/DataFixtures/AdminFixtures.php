<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    
        private $passwordEncoder;

        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
            $this->passwordEncoder = $passwordEncoder;
        }
       public function load(ObjectManager $manager)
       {
           // $product = new Product();
           // $manager->persist($product);
   
           $admun = new Admin();
         
       
 
   $agent->setEmail("");
   
              $agent->setPassword($this->passwordEncoder->encodePassword(
                $agent,
                'the_new_password'
            ));
   
   
     
           $manager->flush();
       }
    }

