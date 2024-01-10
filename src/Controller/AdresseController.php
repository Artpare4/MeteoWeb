<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AdresseController extends AbstractController

{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client=$client;
    }
    #[Route('/search', name: 'app_adresse')]
    public function index(Request $request): Response
    {
        $q='';
        $rue=$request->query->get('rue');
        if($rue != null){
            $rue= str_replace(' ','%20',$rue);
            $q=$q.$rue;
        }
        else{
            $rue='';
        }

        $ville=$request->query->get('ville');
        if($ville == null){
            $ville='';
        }
        else{
            $q=$q.'%20'.$ville;
        }

        $cp=$request->query->get('cp');
        if($cp == null){
            $cp='';
        }
        else{
            $q=$q.'%20'.$cp;
        }


        if($q!=''){
            $res=$this->client->request(
                'GET',
                "https://api-adresse.data.gouv.fr/search/?q=$q&type=housenumber&autocomplete=1")->toArray();
            var_dump($res);
        }
        else{
            $res=null;
        }

        return $this->render('adresse/index.html.twig', [
            'controller_name' => 'AdresseController',
            'adresses'=>$res
        ]);
    }
}
