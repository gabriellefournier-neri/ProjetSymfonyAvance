<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actu;

class ActuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; $i++) { //pour chaque actu
            $actu = new Actu(); //on crée un nouvel actu
            $actu->setTitle('Titre de l\'actu n°' . $i); //on lui donne un titre
            $actu->setContent('Contenu de l\'article n°' . $i . 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia beatae unde modi maiores earum sunt atque tempore? Vero vitae repellendus numquam eligendi quam, voluptas in, maiores, eaque pariatur cupiditate reiciendis aut ad. Nostrum distinctio nemo voluptas commodi dolore fugit sed vel minima quidem, dolorem labore dignissimos officiis. Provident nam, soluta sit, ipsum, error commodi veniam totam facere optio labore quis? Quidem ad eos nisi asperiores voluptates, nostrum atque, corrupti enim ex illum dignissimos in laudantium, explicabo doloribus consequuntur aliquam ea. Autem laborum quam nihil temporibus inventore ut, maiores eaque sed minus ea asperiores doloribus nam iusto laboriosam in alias? Animi.'); //on lui donne un contenu
            $actu->setImage('http://placehold.it/350x350'); //on lui donne une image
            $actu->setCreatedAt(new \DateTimeImmutable()); //on lui donne la date de création
            $manager->persist($actu); //on persiste l'article
        }

        $manager->flush(); //on flush
    }
}

