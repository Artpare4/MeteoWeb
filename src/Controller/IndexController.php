<?php

namespace App\Controller;

use App\Repository\AssoAdresseUserRepository;
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
    public function index(AssoAdresseUserRepository $adresseUserRepository): Response
    {

        $request=$this->client->request(
            'GET',
            'https://api.open-meteo.com/v1/forecast?latitude=49.2653&longitude=4.0285&current=temperature_2m,precipitation,weather_code');
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $res=$adresseUserRepository->findBy(['user'=>$this->getUser()]);
            $weatherAdr=[];

            foreach ($res as $asso){
                $positionX=$asso->getAdresse()->getPositionX();
                $positionY=$asso->getAdresse()->getPositionY();
                $request=$this->client->request(
                    'GET',
                    "https://api.open-meteo.com/v1/forecast?latitude=$positionX&longitude=$positionY&daily=weather_code,temperature_2m_max,precipitation_probability_max");
                $weatherAdr[]=$request->toArray();
            }
        }
        else{
            $weatherAdr=null;
        }
        return $this->render('index/index.html.twig', [
            'tmp'=>$request->toArray(),
            'MétéoAdr'=>$weatherAdr
        ]);
    }
}
