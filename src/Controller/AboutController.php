<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AboutController extends AbstractController
{
    /**
     * @Route("/", name="about")
     */
    public function index(Request $request): Response
    {
        $text = 'hello world';

        if ($request->get('hello')) {
            $text = '<h1>hello</h1>';
        }

        return new Response($text . '<img src="/images/construction.jpg">');
    }
}
