<?php
// src/Controller/CommandeController.php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType; // Assurez-vous que ce formulaire existe et est correctement configuré
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/gestion_commandes', name: 'gestion_commandes')]
    public function gestion(CommandeRepository $commandeRepository): Response
    {
        $commandes = $commandeRepository->findAll();

        return $this->render('commande/gestion.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    #[Route('/supprimer_commande/{id}', name: 'supprimer_commande')]
    public function supprimer(Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if (!$commande) {
            throw $this->createNotFoundException('Commande non trouvée.');
        }

        $entityManager->remove($commande);
        $entityManager->flush();

        $this->addFlash('success', 'La commande a été supprimée avec succès.');

        return $this->redirectToRoute('gestion_commandes');
    }

    #[Route('/modifier_commande/{id}', name: 'modifier_commande')]
    public function modifier(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if (!$commande) {
            throw $this->createNotFoundException('Commande non trouvée.');
        }

        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'La commande a été modifiée avec succès.');

            return $this->redirectToRoute('gestion_commandes');
        }

        return $this->render('commande/modifier_commande.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
