<?php

namespace App\Controller;

/**
 * Description of DefaultController
 *
 * @author Chudaster
 */

use App\Entity\Books;
use App\Form\BooksForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController {
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
    public function editBook(Request $request,int $id=0): Response {
        if((int)$id){
            $book = $this->getDoctrine()->getRepository(Books::class)->find($id);
            if (!$book) {
                throw $this->createNotFoundException(
                    'No book found for id '.$id
                );
            }
        } else {

            $book = new Books();
        }
        $form = $this->createForm(BooksForm::class, $book);
        $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {

           $book = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('books');
        }
        return $this->render('default/book.html.twig',['book'=>$book,'form'=>$form->createView()]);
    }
}
