<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    public function index(): Response
    {
        $response = new Response(
            $this->render('Home/index')
        );

        return $response->send();
    }

    public function error404(): Response
    {
        return $this->error('404 - Page not found');
    }

}