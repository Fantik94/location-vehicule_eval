<?php
namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\CommandeRepository;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    private $entityManager;
    private $membreRepository;
    private $commandeRepository;

    public function __construct(EntityManagerInterface $entityManager, MembreRepository $membreRepository, CommandeRepository $commandeRepository)
    {
        $this->entityManager = $entityManager;
        $this->membreRepository = $membreRepository;
        $this->commandeRepository = $commandeRepository;
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
            $this->entityManager->flush();
            // Ajoutez un message flash ou une redirection si nécessaire
        }

        $commandes = $this->commandeRepository->findBy(['id_membre' => $user]);

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'commandes' => $commandes
        ]);
    }
}
