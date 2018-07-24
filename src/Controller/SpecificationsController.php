<?php

namespace App\Controller;

use App\Entity\Specifications;
use App\Form\SpecificationsType;
use App\Repository\SpecificationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specifications")
 */
class SpecificationsController extends Controller
{
    /**
     * @Route("/", name="specifications_index", methods="GET")
     */
    public function index(SpecificationsRepository $specificationsRepository): Response
    {
        return $this->render('specifications/index.html.twig', ['specifications' => $specificationsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="specifications_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $specification = new Specifications();
        $form = $this->createForm(SpecificationsType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specification);
            $em->flush();

            return $this->redirectToRoute('specifications_index');
        }

        return $this->render('specifications/new.html.twig', [
            'specification' => $specification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specifications_show", methods="GET")
     */
    public function show(Specifications $specification): Response
    {
        return $this->render('specifications/show.html.twig', ['specification' => $specification]);
    }

    /**
     * @Route("/{id}/edit", name="specifications_edit", methods="GET|POST")
     */
    public function edit(Request $request, Specifications $specification): Response
    {
        $form = $this->createForm(SpecificationsType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specifications_edit', ['id' => $specification->getId()]);
        }

        return $this->render('specifications/edit.html.twig', [
            'specification' => $specification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specifications_delete", methods="DELETE")
     */
    public function delete(Request $request, Specifications $specification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specification->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($specification);
            $em->flush();
        }

        return $this->redirectToRoute('specifications_index');
    }
}
