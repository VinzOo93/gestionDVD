<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/serie")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("/serie/manager", name="serie_index", methods={"GET"})
     */
    public function index(SerieRepository $serieRepository): Response
    {
        return $this->render('serie/index.html.twig', [
            'series' => $serieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/serie/manager/new", name="serie_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageBackdrop = $form->get('backdrop')->getData();
            if ($imageBackdrop) {
                $data = pathinfo($imageBackdrop->getClientOriginalName(), PATHINFO_FILENAME);
                $safe = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $data);
                $newFilename = $safe . '-' . uniqid() . '.' . $imageBackdrop->guessExtension();
                try {
                    $imageBackdrop->move(
                        $this->getParameter('backdrop_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo($e);
                }
                $serie->setBackdrop($newFilename);
            }
            $imagePoster = $form->get('poster')->getData();

            if ($imagePoster) {
                $data = pathinfo($imagePoster->getClientOriginalName(), PATHINFO_FILENAME);
                $safe = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $data);
                $newFilename = $safe . '-' . uniqid() . '.' . $imagePoster->guessExtension();
                try {
                    $imagePoster->move(
                        $this->getParameter('poster_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo($e);
                }
                $serie->setPoster($newFilename);
            }
            $dateTime = new  DateTime('NOW');
            $serie->setDateCreated($dateTime);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($serie);
            $entityManager->flush();

            return $this->redirectToRoute('serie_index');
        }

        return $this->render('serie/new.html.twig', [
            'serie' => $serie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/serie/manager/{id}", name="serie_show", methods={"GET"})
     */
    public function show(Serie $serie): Response
    {
        return $this->render('serie/show.html.twig', [
            'serie' => $serie,
        ]);
    }

    /**
     * @Route("/serie/manager/{id}/edit", name="serie_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Serie $serie
     * @return Response
     */
    public function edit(Request $request, Serie $serie): Response
    {
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $imageBackdrop = $form->get('backdrop')->getData();
                if ($imageBackdrop) {
                    $data = pathinfo($imageBackdrop->getClientOriginalName(), PATHINFO_FILENAME);
                    $safe = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $data);
                    $newFilename = $safe . '-' . uniqid() . '.' . $imageBackdrop->guessExtension();
                    try {
                        $imageBackdrop->move(
                            $this->getParameter('backdrop_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        echo($e);
                    }
                    $serie->setBackdrop($newFilename);
                }
                $imagePoster = $form->get('poster')->getData();

                if ($imagePoster) {
                    $data = pathinfo($imagePoster->getClientOriginalName(), PATHINFO_FILENAME);
                    $safe = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $data);
                    $newFilename = $safe . '-' . uniqid() . '.' . $imagePoster->guessExtension();
                    try {
                        $imagePoster->move(
                            $this->getParameter('poster_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        echo($e);
                    }
                    $serie->setPoster($newFilename);
                }

                $dateTime = new  DateTime('NOW');
                $serie->setDateModified($dateTime);


                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('serie_index');
            }

        }
        return $this->render('serie/edit.html.twig', [
            'serie' => $serie,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/serie/manager/{id}/delete", name="serie_delete", methods={"POST"})
     * @param Request $request
     * @param Serie $serie
     * @return Response
     */
    public function delete(Request $request, Serie $serie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $serie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($serie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('serie_index');

    }
}
