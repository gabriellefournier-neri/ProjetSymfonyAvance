<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DomCrawler\Crawler;

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

    /**
     * @Route("/crawler", name="crawler")
     */
    // public function customCrawler()
    // {
    //     // $html ='Hello Crawler !';

    //     // $crawler = new Crawler($html);

    //     // foreach ($crawler as $domElement) {
    //     //     print_r($domElement);
    //     // }
    //     // return new Response();

    //     $html = <<<'HTML'
    //     <!DOCTYPE html>
    //     <html>
    //         <body>
    //             <div id="container">
    //                 <h1>Hello Crawler !</h1>
    //                 <p>This is a paragraph.</p>
    //                 <ul>
    //                     <li>List item 1</li>
    //                     <li>List item 2</li>
    //                 </ul>
    //             </div>
    //         </body>
    //     </html>
    //     HTML;

    //     $crawler = new Crawler($html);
    //     //filter tous les endant et lui meme qui sont dans le body et qui sont paragraphe
    //     $crawler = $crawler->filterXPath('descendant-or-self::body/p');

    //     //equivalent au filtre ci-dessous en utilisant les selecteurs css : 
    //     // $crawler = $crawler->filter('body > p');

    //     return new Response();
    // }

    
    
}




