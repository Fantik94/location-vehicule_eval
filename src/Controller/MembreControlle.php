<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MembreControlle extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/membres', name: 'gestion_membres')]
    public function index(MembreRepository $membreRepository): Response
    {
        $membres = $membreRepository->findAll();

        return $this->render('membre/gestion_membres.html.twig', [
            'membres' => $membres,
        ]);
    }

    #[Route('/membre/ajouter', name: 'membre_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $membre = new Membre();
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hache le mot de passe
            $hashedPassword = $this->passwordHasher->hashPassword(
                $membre,
                $form->get('mdp')->getData()
            );
            $membre->setMdp($hashedPassword);

            $entityManager->persist($membre);
            $entityManager->flush();

            $this->addFlash('success', 'Membre ajouté avec succès.');

            return $this->redirectToRoute('gestion_membres');
        }

        return $this->render('membre/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/membre/modifier/{id}', name: 'membre_modifier')]
    public function modifier(Request $request, Membre $membre, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
{
    $form = $this->createForm(MembreType::class, $membre);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        // Hachage du mot de passe si modifié
        $plainPassword = $form['mdp']->getData();
        if ($plainPassword) {
            $hashedPassword = $passwordHasher->hashPassword($membre, $plainPassword);
            $membre->setMdp($hashedPassword);
        }

        $entityManager->flush();
        $this->addFlash('success', 'Membre modifié avec succès.');

        return $this->redirectToRoute('gestion_membres');
    }

    return $this->render('membre/modifier.html.twig', [
        'membre' => $membre,
        'form' => $form->createView(),
    ]);
}

    #[Route('/membre/supprimer/{id}', name: 'membre_supprimer', methods: ['POST'])]
    public function supprimer(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getIdMembre(), $request->request->get('_token'))) {
            $entityManager->remove($membre);
            $entityManager->flush();

            $this->addFlash('success', 'Membre supprimé avec succès.');
        }

        return $this->redirectToRoute('gestion_membres');
    }
}
