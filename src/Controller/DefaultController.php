<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of DefaultController
 *
 * @author Chudaster
 */

use App\Entity\Books;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController {
    //put your code here
    public function index(): Response {
        $number = random_int(0, 100);

        return $this->render('default/index.html.twig', [
            'number' => $number,
        ]);
    }
    public function viewBooks(): Response {
        $books = $this->getDoctrine()->getRepository(Books::class)->findAll();
        return $this->render('default/books.html.twig',['books'=>$books]);
    }
    public function editBook(int $id): Response {
        $book = $this->getDoctrine()->getRepository(Books::class)->find($id);
        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('default/book.html.twig',['book'=>$book]);
    }
}
