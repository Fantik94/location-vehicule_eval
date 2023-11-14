<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request): Response
    {
        $startDate = $request->query->get('start_date');
        $endDate = $request->query->get('end_date');
    
        $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAvailableVehicles($startDate, $endDate);
    
        return $this->render('search/index.html.twig', [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'vehicule' => $vehicule, // Les véhicules disponibles
        ]);
    }
}
