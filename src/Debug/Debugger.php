<?php

namespace App\Debug;

use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

Class Debugger implements DebuggerInterface{
    public function debug():void{
        echo(get_class($this));
        echo("<br>");
    }
}

