<?php

namespace App\DependencyInjection\Compiler;

Class ChainDebugger
{
    //declaration symfony pour chaque variable

    /** 
    *Function addDebugger for add a new debugger in the array $debbugers
    *
    *@var  iterable<DebuggerInterface> $debuggers
    */

    private $debuggers; // visibilité private = La proprieté n'est visible que dans le namespace

    public function addDebugger($variable):void
    {
        // on ajoute $variable dans le tableau (array) $debuggers
        $this->debuggers[] = $variable;
    }

    public function debug():void
    {
        // on boucle sur le tableau $debuggers et pour chaque $debugger on appelle la methode debug()
        foreach ($this->debuggers as $debugger) {
        $debugger->debug();
        }

        echo 'on débuggue';
    }
}
