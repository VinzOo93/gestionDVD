<?php

namespace App\Controller;

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

        $data = $serieRepository ->findBy([],['popularity' => 'desc']);

       $series = $paginator->paginate(
           $data,
           $request->query->getInt('page', 1),
           25
       );





        return $this->render('index/index.html.twig', [
            'series' => $series
        ]);
    }
}
