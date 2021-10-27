<?php

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DebuggerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        //On recupere ChainDebugger depuis le container
        $chainDebuggerDefinition = $container->findDefinition(ChainDebugger::class);

        //le container appelle cette methode a l'aide de son id, le tags qu'on a defini
        //on recupere le service debug via son tag 'app.custom_debug'
        $debuggers = $container->findTaggedServiceIds('app.custom_debug');

        // on appelle la methode qui prend en parametre addDebugger, et on lui passe une reference vers le service

        //$debugger est la clé qui identifie chaque ligne
        //$id est la valeur qui est la valeur de la clé
        foreach ($debuggers as $debugger => $id) {
            $chainDebuggerDefinition->addMethodCall('addDebugger', [new Reference($debugger)]);
        }
    }
}
