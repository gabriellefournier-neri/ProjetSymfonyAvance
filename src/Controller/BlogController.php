<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Actu;
use App\Repository\ArticleRepository;
use Psr\Log\LoggerInterface;
use App\Service\MessageGenerator;
use App\Service\DisplayMessage;
use App\DependencyInjection\Compiler\ChainDebugger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(LoggerInterface $logger, ArticleRepository $repository)
    {
        // on créé le repo doctrine qui gere l'entity article 
        //remplacé par l'injection de dependance au dessu (ArticleRepository $repository)
        // $repository = $this->getDoctrine()->getRepository(Article::class);
        // on utilise le repo pour recuperer tous les articles
        $articles = $repository->findAll();

        return $this->render('blog/index.html.twig', [
            'articles' => $articles // on passe la variable articles à twig
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home(LoggerInterface $logger, DisplayMessage $displayMessage): Response
    {

        // var_dump($logger);
        $logger->info('L\'utilisateur est sur la home page');

        // $message = $messageGenerator->getMessage();
        // On passe à présent par le service enfant DisplayMessage qui appellera le service
        // parent MessageGenerator
        $message = $displayMessage->getMessage();
        $this->addFlash('success', $message);

        return $this->render('blog/home.html.twig', [
            'title' => 'HELLOOOOOOO',
        ]);
    }


    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id)
    {
        //on crée le repo doctrine qui genere l'entity article
        $repository = $this->getDoctrine()->getRepository(Article::class);

        //on utilise le repo pour recuperer un article passé en parametre
        $article = $repository->find($id);

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'id' => $id
        ]);
    }





    /**
     * @Route("/Ajouter-un-article", name="create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();

        //on crée un objet formulaire lié à l'article et on ajoute les champs souhaités
        $form = $this->createFormBuilder($article)
            ->add('title')
            ->add('content')
            ->add('image')
            ->add('save', SubmitType::class, ['label' => 'Envoyer mon article'])
            ->getForm();

        $form->handleRequest($request); //on recupere les données du formulaire
        if ($form->isSubmitted() && $form->isValid()) { //si le formulaire est soumis et valide

            //on recupere les données du formulaire
            $article -> setCreatedAt(new \DateTime()); //on ajoute la date de creation

            //on enregistre l'article dans la bdd

            // $entityManager = $this->getDoctrine()->getManager();   ==> remplacé par l'injection de dependance (EntityManagerInterface $entityManager) au dessus.
            $entityManager->persist($article);
            $entityManager->flush();

            //on redirige vers l'article crée
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }



        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView() // on passe à twig le resultat via la function creatview()
        ]);
    }







    /**
     * @Route("/Actus", name="actus")
     */
    public function actu(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Actu::class);

        $actus = $repository->findAll();

        return $this->render('blog/actus.html.twig', [
            'actus' => $actus
        ]);
    }

    /**
     * @Route("/debug", name="blog_debug")
     */
    public function __invoke(ChainDebugger $chainDebugger): Response
    {
        $array = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => ['valeur3.1' => 'valeur3.1.1', 'valeur3.2' => 'valeur3.2.1'],
        ];

        try {
            $yaml = Yaml::dump($array);
            file_put_contents('../config/test.yaml', $yaml);
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }


        // $chainDebugger->debug();

        // try{
        //     $value = Yaml::parseFile('../config/routes/annotations.yaml');
        //     print_r($value);
        // } catch (ParseException $e) {
        //     printf("Unable to parse the YAML string: %s", $e->getMessage());
        // }

        return new Response();
    }



    /**
     * @Route("/process", name="process")
     */
    public function process(LoggerInterface $logger): Response
    {
        //on instancie un process $process
        $process = new Process(['date']);

        try {
            //on lance le process
            $process->mustRun();

            //si on a pas d'erreur => on affiche les données en sortie
            echo $process->getOutput();
        } catch (ProcessFailedException $exception) {
            //si on a une erreur => on affiche les données en sortie
            echo $exception->getMessage();
        }

        // on logue les données en sortie (rappel : src/var/log)
        $logger->info('L\'utilisateur est sur la page process');
        $logger->info('Contenu du directory');
        $logger->info($process->getOutput());
        $logger->info('.............................');

        return new Response();
    }
}
