<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SunshineCommand extends Command
{
    protected static $defaultName = 'app:sunshine';
    private $logger;

    //function obligatoire pour le lancement de la commande
    public function __construct(LoggerInterface $variablelogger)
    {
        $this->logger = $variablelogger;

        //il est necessaire d'appeler le constructeur parent
        //operateur de resolution de porté parent::__construct(); appel le constructeur du parent, dans le vendor
        parent::__construct();
    }
    
    //function obligatoire pour le lancement de la commande
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->info('Walking up the sun');
        return 1;
    }

    //Function optionnelle pour ajouter du texte (decription, message d'aide ..... )
    protected function configure()
    {
        $this
            ->setDescription('Sunshine');
    }
}
