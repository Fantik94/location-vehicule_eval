<?php
// src/Controller/VehiculeController.php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\AjouterVehiculeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter_vehicule')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager)
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(AjouterVehiculeType::class, $vehicule);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicule);
            $entityManager->flush();

            $this->addFlash('success', 'Voiture bien ajoutée dans la bdd.');

            
            return $this->render('ajouter-vehicule/index.html.twig', [
                'form' => $form->createView(),
                'success' => true // Indicateur pour le template pour activer le script de redirection
            ]);
        }

        return $this->render('ajouter-vehicule/index.html.twig', [
            'form' => $form->createView(),
            'success' => false 
        ]);
    }
}
