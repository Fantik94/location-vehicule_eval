<?php
namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\CommandeRepository;
use App\Repository\MembreRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    private $entityManager;
    private $membreRepository;
    private $commandeRepository;
    private $vehiculeRepository;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, MembreRepository $membreRepository, CommandeRepository $commandeRepository, VehiculeRepository $vehiculeRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->membreRepository = $membreRepository;
        $this->commandeRepository = $commandeRepository;
        $this->vehiculeRepository = $vehiculeRepository;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/profil', name: 'app_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Membre) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(MembreType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si le mot de passe a été modifié
            $newPassword = $form->get('mdp')->getData();
            if ($newPassword) {
                $hashedPassword = $this->passwordHasher->hashPassword($user, $newPassword);
                $user->setMdp($hashedPassword);
            }

            $this->entityManager->flush();
            // Redirection ou message flash après la sauvegarde
        }

        $commandes = $this->commandeRepository->findBy(['membre' => $user]);
        foreach ($commandes as $commande) {
            $vehicule = $commande->getVehicule(); // Accéder directement à l'objet Vehicule associé
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'commandes' => $commandes
        ]);
    }
}
