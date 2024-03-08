<?php

namespace App\Controller;

use App\Entity\Fighter;
use App\Entity\Categories;
use App\Form\Fighter1Type;
use App\Entity\Organisation;
use App\Repository\FighterRepository;
use App\Repository\OrganisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/fighter')]
class FighterController extends AbstractController

{
    /**
     * Undocumented function
     *
     * @param FighterRepository $fighterRepository
     * @param OrganisationRepository $organisationRepository
     * @return Response
     */

    #[Route('/', name: 'app_fighter_index', methods: ['GET'])]
    public function index(FighterRepository $fighterRepository, OrganisationRepository $organisationRepository): Response
    {
        return $this->render('fighter/index.html.twig', [
            'fighters' => $fighterRepository->findAll(),
            'organisation' => $organisationRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_fighter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fighter = new Fighter();
        $form = $this->createForm(Fighter1Type::class, $fighter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fighter);
            $entityManager->flush();

            return $this->redirectToRoute('app_fighter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fighter/new.html.twig', [
            'fighter' => $fighter,
            'form' => $form,
        ]);
    }

    #[Route('/fighter-api', name: 'app_fighter_api')]
    public function fighterApi( FighterRepository $fighterRepository, SerializerInterface $serializer): JsonResponse {
        $fighters = $fighterRepository->findAll();
        $fighters_to_json = $serializer->serialize($fighters, 'json', ['groups' => 'figther']);
        return new JsonResponse($fighters_to_json, Response::HTTP_OK, [], true);
    }

    #[Route('/fighter-json', name: 'app_fighter_json')]
    public function fighterJson(): Response {
        return $this->render('fighter/fighter_json.html.twig');
    }

    

    #[Route('/{id}/edit', name: 'app_fighter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fighter $fighter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Fighter1Type::class, $fighter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fighter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fighter/edit.html.twig', [
            'fighter' => $fighter,
            'form' => $form,
        ]);
    }

    

    #[Route("/fighter-organisation", name: "app_fighter_organisation")]
    /**
     * @param FighterRepository $fighterRepository
     */

    public function getFighterByOrganisation(Request $request, FighterRepository $fighterRepository): Response {
        $organisationID = $request->request->get('organisation_id');
        return $this->render('fighter/fighter-organisation.html.twig', [
            'fighters' => $fighterRepository->fighterByOrganisation($organisationID)
        ]);
    }
    
    #[Route('/{id}', name: 'app_fighter_show', methods: ['GET'])]
    public function show(Fighter $fighter): Response
    {
        return $this->render('fighter/show.html.twig', [
            'fighter' => $fighter,
        ]);
    }

    #[Route('/{id}', name: 'app_fighter_delete', methods: ['POST'])]
    public function delete(Request $request, Fighter $fighter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fighter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fighter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fighter_index', [], Response::HTTP_SEE_OTHER);
    }
}
