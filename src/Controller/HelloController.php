<?php

namespace App\Controller;

use App\Service\HelloService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hello', name: 'hello')]
class HelloController extends AbstractController
{
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    #[Route('/say', name: 'say')]
    public function say(): Response
    {
        return new Response(
            $this->helloService->getMessage()
        );
    }
}