<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController
{
    #[Route('/hello/say')]
    public function say(): Response
    {
        return new Response(
            "Hello World!"
        );
    }
}