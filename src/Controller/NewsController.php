<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function index(): Response
    {
        return $this->render('news/index.html.twig', [
            'news' => 'Hello News'
        ]);
    }


    /**
     * @Route("/finder", name="finder")
     */
    public function customFinder(): Response
    {
        $finder = new Finder();

        $finder->files()->in(__DIR__);

        foreach ($finder as $file) {
            echo $file ."<br/>";
            echo $file->getRealPath() ."<br/>";
            echo $file->getRelativePathname() ."<br/>";
        }
        return new Response();
    }



}




