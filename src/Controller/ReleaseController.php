<?php

namespace App\Controller;

use App\Entity\Release;
use App\Form\ReleaseType;
use App\Repository\ReleaseRepository;
use App\Security\Voter\ReleaseVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/release')]
final class ReleaseController extends AbstractController{
    #[Route(name: 'app_release_index', methods: ['GET'])]
    public function index(ReleaseRepository $releaseRepository): Response
    {
        $user = $this->getUser();
        return $this->render('release/index.html.twig', [
            'releases' => $releaseRepository->findBy(['owner' => $user]),
        ]);
    }

    #[Route('/new', name: 'app_release_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $release = new Release();
        $form = $this->createForm(ReleaseType::class, $release);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $release->setOwner($this->getUser());
            $entityManager->persist($release);
            $entityManager->flush();

            return $this->redirectToRoute('app_release_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('release/new.html.twig', [
            'release' => $release,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_release_show', methods: ['GET'])]
    #[IsGranted(ReleaseVoter::VIEW, subject:'release' )]
    public function show(Release $release): Response
    {
        return $this->render('release/show.html.twig', [
            'release' => $release,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_release_edit', methods: ['GET', 'POST'])]
    #[IsGranted(ReleaseVoter::EDIT, subject:'release' )]
    public function edit(Request $request, Release $release, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReleaseType::class, $release);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_release_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('release/edit.html.twig', [
            'release' => $release,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_release_delete', methods: ['POST'])]
    #[IsGranted(ReleaseVoter::EDIT, subject:'release' )]
    public function delete(Request $request, Release $release, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$release->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($release);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_release_index', [], Response::HTTP_SEE_OTHER);
    }
}
