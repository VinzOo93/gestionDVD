<?php

namespace App\Controller;

use App\Entity\FilterSerie;
use App\Entity\Genre;
use App\Form\FilterSerieType;
use App\Repository\SeasonRepository;
use App\Repository\SerieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param SerieRepository $serieRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(SerieRepository $serieRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $genres = new Genre();
        $filterSerie = new FilterSerie(($genres->getName()));
        $form = $this->createForm(FilterSerieType::class, $filterSerie);
        $form->handleRequest($request);
        $data = $serieRepository->filter($filterSerie);
//        $data = $serieRepository->findBy([],['popularity' => 'DESC']);
//        dump($data);

        $series = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            24
        );
        return $this->render('index/index.html.twig', [
            'series' => $series,
            'sortieFilterType' => $form->createView()
        ]);
    }

    /**
     * @Route("/serie/{id}", name="serie", requirements={"id": "\d+"})
     * @param $id
     * @param Request $request
     * @param SerieRepository $serieRepository
     * @param SeasonRepository $seasonRepository
     * @return Response
     */
    public function detail($id, Request $request, SerieRepository $serieRepository, SeasonRepository $seasonRepository): Response
    {
        $serie = $serieRepository->find($id);
        $seasons = $seasonRepository->findBySerie($id);

        return $this->render('index/serie.html.twig', [
            'serie' => $serie,
            'seasons' => $seasons,
        ]);
    }
}
