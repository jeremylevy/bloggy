<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
 
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
            
        $user->setFullName('Jérémy Levy');
        $user->setEmail('jje.levy@gmail.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, '123456'));

        $manager->persist($user);

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            
            $post->setTitle('title ' . $i);
            $post->setSubtitle('subtitle ' . $i);
            $post->setContent('content ' . $i);
            $post->setAuthor($user);
            
            $manager->persist($post);
        }
        
        $manager->flush();
    }
}