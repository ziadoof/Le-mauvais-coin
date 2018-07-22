<?php

namespace App\Controller;

use App\Entity\Division;
use App\Form\DivisionType;
use App\Repository\DivisionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/division")
 */
class DivisionController extends Controller
{
    /**
     * @Route("/", name="division_index", methods="GET")
     */
    public function index(DivisionRepository $divisionRepository): Response
    {
        return $this->render('division/index.html.twig', ['divisions' => $divisionRepository->findAll()]);
    }

    /**
     * @Route("/new", name="division_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $division = new Division();
        $form = $this->createForm(DivisionType::class, $division);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($division);
            $em->flush();

            return $this->redirectToRoute('division_index');
        }

        return $this->render('division/new.html.twig', [
            'division' => $division,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="division_show", methods="GET")
     */
    public function show(Division $division): Response
    {
        return $this->render('division/show.html.twig', ['division' => $division]);
    }

    /**
     * @Route("/{id}/edit", name="division_edit", methods="GET|POST")
     */
    public function edit(Request $request, Division $division): Response
    {
        $form = $this->createForm(DivisionType::class, $division);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('division_edit', ['id' => $division->getId()]);
        }

        return $this->render('division/edit.html.twig', [
            'division' => $division,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="division_delete", methods="DELETE")
     */
    public function delete(Request $request, Division $division): Response
    {
        if ($this->isCsrfTokenValid('delete'.$division->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($division);
            $em->flush();
        }

        return $this->redirectToRoute('division_index');
    }
}
