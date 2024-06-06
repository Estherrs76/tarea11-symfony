<?php

namespace App\Controller;

use App\Entity\Coches;
use App\Entity\Tipos;
use App\Repository\CochesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Json;

#[Route('/coches', name: 'app_coches_')]
class CochesController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('coches/index.html.twig', [
            'controller_name' => 'CochesController',
        ]);
    }

    #[Route('/insertar-coches', name: 'insertar-coches')]
    public function InsertarCoches(ManagerRegistry $doctrine): Response
    {
        $gestorEntidades = $doctrine->getManager();
        $coches = [
            ["modelo"=>"Kona", "potencia"=>156, "precio"=> 39650.45, "stock"=> true, "tipo"=> 1],
            ["modelo"=>"Kona", "potencia"=>214, "precio"=> 44850.45, "stock"=> false, "tipo"=> 2],
            ["modelo"=>"Kona", "potencia"=>125, "precio"=> 29650.45, "stock"=> true, "tipo"=> 3],
        ];

        foreach ($coches as $coche) {
           $nuevoCoche = new Coches();
           $nuevoCoche->setModelo($coche["modelo"]);
           $nuevoCoche->setPotencia($coche["potencia"]);
           $nuevoCoche->setPrecio($coche["precio"]);
           $nuevoCoche->setStock($coche["stock"]); 

           //Introducimos el tipo(FK)
           $tipo = new Tipos();
           $repoTipo = $gestorEntidades->getRepository(Tipos::class);
           $tipo =$repoTipo->find($coche["tipo"]);
           $nuevoCoche->setIdTipo($tipo);

           $gestorEntidades->persist($nuevoCoche);
           $gestorEntidades->flush();
        }

        return new Response("Coches insertados");
    }


    #[Route('/ver-cochesJSON', name: 'ver-cochesJSON')]
    public function vercochesJSON(
        CochesRepository $repoCoches): Response
    {
        $coches = $repoCoches->findAll();
        $json = [];
        foreach ($coches as $coche) {
            $json[]=[
                "id"=>$coche->getId(),
                "modelo"=>$coche->getModelo(),
                "potencia"=>$coche->getPotencia(),
                "precio"=>$coche->getPrecio(),
                "stock"=>$coche->isStock()?"SI":"NO",
                "Tipo"=>$coche->getIdTipo()->getNombre(),                
            ];
        }

        return new JsonResponse($json);
    }


    //La ruta va en el routes.yaml
    //#[Route('/ver-coches', name: 'ver-coches')]
    public function vercoches(
        CochesRepository $repoCoches): Response
    {
        $coches = $repoCoches->findAll();
        $datos = [];
        foreach ($coches as $coche) {
            $datos[]=[
                "id"=>$coche->getId(),
                "modelo"=>$coche->getModelo(),
                "potencia"=>$coche->getPotencia(),
                "precio"=>$coche->getPrecio(),
                "stock"=>$coche->isStock()?"SI":"NO",
                "tipo"=>$coche->getIdTipo()->getNombre(),                
            ];
        }

        return $this->render('coches/index.html.twig', [
            'controller_name' => 'CochesController',
            "coches" => $datos,
        ]);
    }

    //12
    #[Route('/cambia-coche/{id}/{potencia}/{precio}', name: 'cambiaCoche')]
    public function cambiaCoche(
        int $id, int $potencia, float $precio, EntityManagerInterface $gestorEntidades, CochesRepository $repoCoches
    ): Response
    {
        $coche = $repoCoches->find($id);
        $coche->setPotencia($potencia);
        $coche->setPrecio($precio);
        $gestorEntidades->Flush();
        return $this->redirectToRoute("app-coches_ver-coches");
    }

    //13.
    #[Route('/elimina-coche/{id}', name: 'eliminaCoche')]
    public function eliminaCoche(
        int $id, EntityManagerInterface $gestorEntidades, CochesRepository $repoCoches
    ): Response
    {
        $coche = $repoCoches->find($id);
        $gestorEntidades->remove($coche);
        $gestorEntidades->Flush();
        return $this->redirectToRoute("app-coches_ver-coches");
    }


}
