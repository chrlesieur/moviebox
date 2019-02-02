<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\MovieSearch;
use App\Entity\User;
use App\Form\MovieSearchType;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use App\Service\MovieApiRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movie")
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/", name="movie_index", methods={"GET"})
     * @param MovieRepository $movieRepository
     * @param MovieApiRequest $movieApiRequest
     * @return Response
     */
    public function index(MovieRepository $movieRepository, MovieApiRequest $movieApiRequest): Response
    {
        $user = $this->getUser();
        $movies = $user->getMovies();
        $details=[];
        foreach ($movies as $movie) {
            $idMovie = $movie->getIdMovie();
            $details[$idMovie] = $movieApiRequest->getDetailsbyId($idMovie);
            $myCritic = $movie -> getMyCritic();
            $details[$idMovie]['myCritic'] = $myCritic;
            $statut = $movie->getStatut();
            $details[$idMovie]['statut'] = $statut;
            $details[$idMovie]['myRating'] = $movie->getMyRating();
            $details[$idMovie]['id'] = $movie->getId();

        }
        //dd($details);
            return $this->render('movie/index.html.twig', [
                'movies' => $movies,
                'details' => $details,
                'movie' => $movie
            ]);
        }


    /**
     * @Route("/new", name="movie_new", methods={"GET","POST"})
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function new(Request $request, SessionInterface $session, MovieApiRequest $movieApiRequest): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);


        $searchMovie = $session->get('movieSearch');
        $title = $searchMovie->getmovieSearchByTitle();
        $details = $movieApiRequest->getDetailsApi($title);


        if ($form->isSubmitted() && $form->isValid()) {
            $movie->addUser($user = $this->getUser());
            $movie->setIdMovie($details['imdbID']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('movie_index');
        }

        return $this->render('movie/new.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
            'movieSearch' => $searchMovie,
        ]);
    }

    /**
     * @Route("/{id}", name="movie_show", methods={"GET"})
     */
    public function show(Movie $movie): Response
    {
        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="movie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Movie $movie): Response
    {
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movie_index', [
                'id' => $movie->getId(),
            ]);
        }

        return $this->render('movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Movie $movie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($movie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('movie_index');
    }

    /**
     * @Route("/details/{title}")
     * @param string $title
     * @param MovieApiRequest $movieApiRequest
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDetails(string $title, MovieApiRequest $movieApiRequest): Response
    {
        $details = $movieApiRequest->getDetailsApi($title);
        return $this->json($details);
    }
}
