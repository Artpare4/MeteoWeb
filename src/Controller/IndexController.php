<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IndexController extends AbstractController
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client=$client;
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {

        $request=$this->client->request(
            'GET',
            'https://api.open-meteo.com/v1/forecast?latitude=49.2653&longitude=4.0285&current=temperature_2m,precipitation,weather_code');
        return $this->render('index/index.html.twig', [
            'tmp'=>$request->toArray()
        ]);
    }
}
