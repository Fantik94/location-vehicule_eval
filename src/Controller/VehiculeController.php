<?php
// src/Controller/VehiculeController.php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\AjouterVehiculeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\Response;

class VehiculeController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter_vehicule')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(AjouterVehiculeType::class, $vehicule);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicule);
            $entityManager->flush();

            $this->addFlash('success', 'Voiture bien ajoutée dans la base de données.');
            return $this->redirectToRoute('gestion_vehicules');
        }

        return $this->render('ajouter-vehicule/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/gestion', name: 'gestion_vehicules')]
    public function gestion(VehiculeRepository $vehiculeRepository): Response
    {
        $vehicules = $vehiculeRepository->findAll();

        return $this->render('vehicule/gestion.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier_vehicule')]
    public function modifier(Request $request, Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AjouterVehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Véhicule mis à jour avec succès.');
            return $this->redirectToRoute('gestion_vehicules');
        }

        return $this->render('vehicule/modifier.html.twig', [
            'form' => $form->createView(),
            'vehicule' => $vehicule
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer_vehicule')]
    public function supprimer(Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        if (!$vehicule) {
            $this->addFlash('error', 'Véhicule introuvable.');
            return $this->redirectToRoute('gestion_vehicules');
        }

        $entityManager->remove($vehicule);
        $entityManager->flush();

        $this->addFlash('success', 'Le véhicule a été supprimé avec succès.');
        return $this->redirectToRoute('gestion_vehicules');
    }
}
