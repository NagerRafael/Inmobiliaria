<?php

namespace App\Controller;

use App\Entity\Peticion;
use App\Form\PeticionType;
use App\Repository\PeticionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/peticion')]
class PeticionController extends AbstractController
{
    #[Route('/', name: 'app_peticion_index', methods: ['GET'])]
    public function index(PeticionRepository $peticionRepository): Response
    {
        return $this->render('peticion/index.html.twig', [
            'peticions' => $peticionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_peticion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PeticionRepository $peticionRepository): Response
    {
        $peticion = new Peticion();
        $form = $this->createForm(PeticionType::class, $peticion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $peticion->setCondicion('Alquiler');
            $peticion->setEstado('A');
            $peticionRepository->save($peticion, true);

            return $this->redirectToRoute('app_peticion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('peticion/new.html.twig', [
            'peticion' => $peticion,
            'form' => $form,
        ]);
    }

    #[Route('/{idPeticion}', name: 'app_peticion_show', methods: ['GET'])]
    public function show(Peticion $peticion): Response
    {
        return $this->render('peticion/show.html.twig', [
            'peticion' => $peticion,
        ]);
    }

    #[Route('/{idPeticion}/edit', name: 'app_peticion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Peticion $peticion, PeticionRepository $peticionRepository): Response
    {
        $form = $this->createForm(PeticionType::class, $peticion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $peticionRepository->save($peticion, true);

            return $this->redirectToRoute('app_peticion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('peticion/edit.html.twig', [
            'peticion' => $peticion,
            'form' => $form,
        ]);
    }

    #[Route('/{idPeticion}', name: 'app_peticion_delete', methods: ['POST'])]
    public function delete(Request $request, Peticion $peticion, PeticionRepository $peticionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$peticion->getIdPeticion(), $request->request->get('_token'))) {
            $peticionRepository->remove($peticion, true);
        }

        return $this->redirectToRoute('app_peticion_index', [], Response::HTTP_SEE_OTHER);
    }
}
