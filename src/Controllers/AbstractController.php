<?php

namespace App\Controllers;

use App\Services\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{

    protected Request $request;
    protected Logger $logger;
    protected ?array $config;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->logger = new Logger();
        $config = require __DIR__ . '/../../config/app.php';
        $this->config = $config;
    }

    protected function render(string $view, array $params = []): string
    {
        $view = preg_replace('/[^a-zA-Z\/]/', '', $view);
        extract($params);
        require_once __DIR__ . '/../Views/' . $view . '.php';
        return ob_get_clean();
    }

    protected function error(string $message, int $code = 404): Response
    {
        $this->logger->log($message, Logger::LOG_ERROR);
        $response = new Response($this->render('Error/index', [
            'message' => $message
        ]), $code);
        return $response->send();
    }
}