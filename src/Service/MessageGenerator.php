<?php

namespace App\Service;

Class MessageGenerator
{
    public $messageGenerator;

    public function _contruct($messageGenerator)
    {
        echo $messageGenerator;
    }
    
    public function getMessage(): string
    {
        $message = [
            'bienvenu',
            'salut',
            'bye',
        ];

        $index = array_rand($message);
        return $message[$index];
    }
}