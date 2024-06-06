<?php

namespace App\Controller;

use App\Entity\Tipos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tipos', name: 'app_tipos_ivan')]
class TiposController extends AbstractController
{
    #[Route('/insertar/{nombre}', name: 'insertar-nombre')]
    public function insertarTipos(ManagerRegistry $doctrine, string $nombre): Response
    {
        $gestorEntidades = $doctrine->getManager();
        $tipo = new Tipos();
        $tipo->setNombre($nombre);

        $gestorEntidades->persist($tipo);
        $gestorEntidades->flush();

        
        return new Response("Tipo insertado!");
    }
}
