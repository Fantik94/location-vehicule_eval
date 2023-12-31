<?php
// src/Controller/ReservationController.php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Membre;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation')]
    public function index(VehiculeRepository $vehiculeRepository, int $id, Request $request, SessionInterface $session): Response
    {
        if (!$this->getUser()) {
            $session->set('redirect_url', $request->getRequestUri());
            return $this->redirectToRoute('app_login');
        }

        $vehicule = $vehiculeRepository->find($id);
        if (!$vehicule) {
            throw $this->createNotFoundException('Véhicule non trouvé.');
        }

        return $this->render('reservation/index.html.twig', [
            'vehicle' => $vehicule,
            'start_date' => $request->query->get('start_date'),
            'end_date' => $request->query->get('end_date')
        ]);
    }

    #[Route('/process_reservation/{id}', name: 'app_process_reservation', methods: ['POST'])]
    public function processReservation(Request $request, VehiculeRepository $vehiculeRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Membre) {
            throw new \LogicException('Utilisateur non autorisé.');
        }

        $vehicule = $vehiculeRepository->find($id);
        if (!$vehicule) {
            throw $this->createNotFoundException('Véhicule non trouvé.');
        }

        $dateDebut = new \DateTime($request->request->get('start_date'));
        $dateFin = new \DateTime($request->request->get('end_date'));
        $interval = $dateDebut->diff($dateFin);
        $jours = $interval->days;
        $prixTotal = $jours * $vehicule->getPrixJournalier();

        $commande = new Commande();
        $commande->setMembre($user); // Assurez-vous que cette méthode existe dans l'entité Commande
        $commande->setVehicule($vehicule);
        $commande->setDateHeureDepart($dateDebut);
        $commande->setDateHeureFin($dateFin);
        $commande->setPrixTotal($prixTotal);

        $entityManager->persist($commande);
        $entityManager->flush();

        return $this->redirectToRoute('confirmation_page', ['id' => $commande->getIdCommande()]);
    }

    #[Route('/confirmation/{id}', name: 'confirmation_page')]
    public function confirmation(int $id, EntityManagerInterface $entityManager): Response
    {
        $commande = $entityManager->getRepository(Commande::class)->find($id);
        if (!$commande) {
            throw $this->createNotFoundException('Commande non trouvée.');
        }

        $vehicule = $entityManager->getRepository(Vehicule::class)->find($commande->getVehicule()->getIdVehicule());

        return $this->render('confirmation/index.html.twig', [
            'reservation' => $commande,
            'vehicle' => $vehicule,
            'user' => $this->getUser()
        ]);
    }
}
