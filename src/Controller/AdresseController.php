<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\AssoAdresseUser;
use App\Repository\AdresseRepository;
use App\Repository\AssoAdresseUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

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
                "https://api-adresse.data.gouv.fr/search/?q=$q&type=housenumber&limit=25&autocomplete=1")->toArray();
        }
        else{
            $res=null;
        }

        return $this->render('adresse/index.html.twig', [
            'controller_name' => 'AdresseController',
            'adresses'=>$res
        ]);
    }
    #[Route('/create', name: 'app_create')]
    public function create(Request $request,EntityManagerInterface $manager, AdresseRepository $adresseRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $rue=$request->query->get('rue');
        $postCode=$request->query->get('postCode');
        $ville=$request->query->get('city');
        $posX=floatval($request->query->get('positionX'));
        $posY=floatval($request->query->get('positionY'));
        $request=$adresseRepository->findByAdresse($rue,strval($postCode),$ville,$posX,$posY);

        if(empty($request)){
            $adresse= new Adresse();
            $adresse->setRue($rue);
            $adresse->setCodePostal($postCode);
            $adresse->setVille($ville);
            $adresse->setPositionX($posX);
            $adresse->setPositionY($posY);
            $manager->persist($adresse);
            $manager->flush();
        }
        else{
            $adresse= $request[0];
        }

        $user=$this->getUser();
        $jointure= new AssoAdresseUser();
        $jointure->setUser($user);
        $jointure->setAdresse($adresse);
        $manager->persist($jointure);
        $manager->flush();

        return $this->redirectToRoute('app_index');
    }

    #[Route('/delete/{id}', name: 'app_delete',requirements: ['id' => '\d+'])]
    public function delete($id,AdresseRepository$adresseRepository,AssoAdresseUserRepository $adresseUserRepository,EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $user=$this->getUser();
        $adresse= $adresseRepository->find($id);
        $asso=$adresseUserRepository->findBy(['user'=>$user,'adresse'=>$adresse]);
        $manager->remove($asso[0]);
        $manager->flush();
        return $this->redirectToRoute('app_index');
    }


}
