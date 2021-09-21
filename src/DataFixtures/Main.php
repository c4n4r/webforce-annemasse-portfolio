<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Skill;
use App\Entity\Techno;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
class Main extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();
        for ($s = 0; $s < 15; $s++){
            $skill = new Skill();
            $skill->setTitle($faker->words(4, true))
                ->setContent($faker->realText(250, 2))
                ->setImage("https://picsum.photos/seed/". rand(0, 5000) ."/800/400");
            $manager->persist($skill);
            $manager->flush();
        }

        for ($t = 0; $t < 5; $t++) {
            $techno = new Techno();
            $techno->setTitle($faker->words(4, true))
                ->setContent($faker->realText(250, 2))
                ->setImage("https://picsum.photos/seed/". rand(0, 5000) ."/800/400")
                ->addSkill($manager->getRepository(Skill::class)->find(rand(1,15)));
            $manager->persist($techno);
            $manager->flush();
        }

        for ($c = 0; $c < 4; $c++) {
            $category = new Category();
            $category->setTitle($faker->words(4, true))
                ->addTechno($manager->getRepository(Techno::class)->find(rand(1,5)));
            $manager->persist($category);
            $manager->flush();
        }
        $manager->flush();
    }
}
