<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        for ($i = 1; $i < 10; $i++) { //pour chaque article
            $article = new Article(); //on crée un nouvel article
            $article->setTitle('Article n°' . $i); //on lui donne un titre
            $article->setContent('Contenu de l\'article n°' . $i . 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia beatae unde modi maiores earum sunt atque tempore? Vero vitae repellendus numquam eligendi quam, voluptas in, maiores, eaque pariatur cupiditate'); //on lui donne un contenu
            $article->setImage('http://placehold.it/350x150'); //on lui donne une image
            $article->setCreatedAt(new \DateTime()); //on lui donne la date de création
            $manager->persist($article); //on persiste l'article
        }

        $manager->flush(); //on flush
    }
}

