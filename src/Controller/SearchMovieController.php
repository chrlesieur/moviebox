<?php

namespace App\Controller;

use App\Entity\MovieSearch;
use App\Form\MovieSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SearchMovieController extends AbstractController
{
    /**
     * @Route("/search/movie", name="search_movie")
     * @param SessionInterface $session
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index( Request $request, SessionInterface $session) : Response
    {

        $movieSearch = $session->get('movieSearch') ?? (new MovieSearch());
        $form2 = $this->createForm(MovieSearchType::class, $movieSearch,
            ['method' => Request::METHOD_GET]);
        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {
            $session->set('movieSearch', $movieSearch);

            return $this->redirectToRoute('movie_new');
        }
        return $this->render('search_movie/index.html.twig', [
            'form2' => $form2->createView(),
            'MovieSearch' => $movieSearch
        ]);

    }
}
