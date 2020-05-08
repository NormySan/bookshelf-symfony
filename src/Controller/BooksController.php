<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route("/books", name="books")
     */
    public function index()
    {
        $book = $this->bookRepository->find(1);

        return new JsonResponse([
            'id' => $book->id,
            'title' => $book->title,
            'isbn' => $book->isbn,
            'description' => $book->description,
            'genres' => $book->genres->toArray(),
            'authors' => $book->authors->toArray(),
        ]);
    }
}
