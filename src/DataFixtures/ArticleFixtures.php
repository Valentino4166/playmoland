<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        for($j=1; $j <= 3; $j++){
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph()); 
            $manager->persist($category); 


        for($i = 1; $i = 10; $i++){
            $article = new Article();

        
            $content = '<p>' . join($faker->paragraphs(5),'</p><p>') . '</p>';

            $article->setTitle($faker->sentence())
            ->setContent($content)
            ->setImage($faker->imageUrl())
            ->setCreatedAt($faker->dateTimeBetween('_6 months'))
            ->setPrix("15")
            ->setCategory($category);

            $manager->persist($article); 
             
             for($k = 1; $k <= 5; $k++){
                $comment = new Comment();

                 $content = '<p>' . join($faker->paragraphs(2),'</p><p>') . '</p>';

                 $comment->setAuthor($faker->name)
                       ->setContent($content)
                       ->setNote("5")
                       ->setArticle($article);

                
                        $manager->persist($comment);
             }
            }
        

            
        
            

        $manager->flush();
        }
    }

}
