<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class AboutController
{
    public function index(): Response
    {
        $text = 'hello world';

        return new Response('<h1>' . $text . '</h1>');
    }
}
