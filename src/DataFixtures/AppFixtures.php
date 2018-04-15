<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            
            $post->setTitle('title ' . $i);
            
            $post->setSubtitle('subtitle ' . $i);
            
            $post->setContent('content ' . $i);
            
            $manager->persist($post);
        }

        $manager->flush();
    }
}