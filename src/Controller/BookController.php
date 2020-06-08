<?php
//this file defines the create, delete , edit functions of the book
//this Controller is based on the form manipulated by  Ajax 
//this file is the most important one, ,  it also adds a book to the cart  and a book review 
namespace App\Controller;
use App\Entity\Orde;
use App\Entity\Book;
use App\Entity\Admin;
use App\Entity\Genre;
use App\Entity\Subject;
use App\Entity\Review;
use App\Entity\Cart;
use App\Entity\Img;
use App\Form\Book1Type;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
//this function defines the index page for books and returns and a list of books, their images , types and genres
{
    /**
     * @Route("/", name="book_index", methods={"GET"})
     */
    public function index(BookRepository $bookRepository): Response
    {  $img = $this->getDoctrine()->getRepository(Img::class)->findAll();
        $type = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        $cat = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findAll(), 'imgs' => $img,'type'=>$type,'cat' =>$cat,
        ]);
    }

    /**
     * @Route("/new", name="book_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    { //this function 
        $book = new Book();
        $type = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        $cat = $this->getDoctrine()->getRepository(Genre::class)->findAll();


        return $this->render('book/new.html.twig', [
            'type' => $type, 'cat' =>$cat,
        ]);
    }

    /**
     * @Route("/{id}", name="book_show", methods={"GET"})
     */
    public function show(Book $book,$id): Response
    {  $img = $this->getDoctrine()->getRepository(Img::class)->findBy(['book'=>$id]);
        $type = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        $review = $this->getDoctrine()->getRepository(Review::class)->findBy(['book'=>$id]);
        $cat = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        return $this->render('book/show.html.twig', array(
            'review'=>$review,'book' => $book, 'type' => $type, 'cat' =>$cat,'img' =>$img));
        
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(Book1Type::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }

    /**
     * @Route("/genre/{id}", name="book_genre", methods={"GET","POST"} )
     */
    public function critereSelect($id) {
        $data = $this->getDoctrine()->getRepository(Subject::class)->findBy(['Genre' =>$id]);
        $tabResult=[];
      
        
        
        $i =0;
        
         foreach($data as $oneData){
           
            
            $tabResult[$i+1][] = $oneData->getLabel();
         }
           
    
         return new JsonResponse(array('data' => $tabResult));
          
        }


    /**
     * @Route("/add")
     * Method({POST})
     */
    public function add(Request $request){ //this function adds a new book 
        $book = new Book();
        
        $data = $request->request->all();
  
        //here i get the form values after being proccessed by the ajax file 
        $book->setName($data['name']);
        $book->setAuthor($data['author']);
        $book->setMaisonEdition($data['maisonEdi']);
        $book->setEtat($data['etat']); // new or old
        $book->setAction($data['action']); // Sell or rent
        //here since i have the functionnality of sorting books into genres, for each book added , i must update the number of books in thta specific genre
        $gen=$this->getDoctrine()->getRepository(Genre::class)->findBy(['id' =>$data['genre']]);
        foreach($gen as $ge) {
        $book->setGenre($ge->getLabel());
        $ge->setNumBook ($ge->getNumBook() + 1);
        }
        $book->setDateEdition($data['dateEdi']);
        $book->setUser($data['user']);
        $book->setSubject($data['subject']);
        $book->setNombrePage($data['nb']);
        $book->setPrice($data['price']);
        $book->setImg('1.jpg'); // default image , the user later have the chance to put his own image
        //here i will actuually save the book into the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();
                
        return new Response('Saved new book with id '.$book->getId());
        
    
      
      }


    /**
     * @Route("/mod/{id}")
     * Method({POST})
     */
        public function mod(Request $request,$id){ //this files modfies a book
            $book = new Book();
            
            $data = $request->request->all();
            $book= $this->getDoctrine()->getRepository(Book::class)->find(['id' =>$id]);
                    
            $book->setName($data['name']);
            $book->setAuthor($data['author']);
            $book->setMaisonEdition($data['maisonEdi']);
            $book->setEtat($data['etat']);
            $book->setAction($data['action']);
            $gen=$this->getDoctrine()->getRepository(Genre::class)->findBy(['label' =>$book->getGenre()]);
            // if the genre is modified we must remove the book from it and added it to the new genre
            foreach($gen as $ge) { 
            
                $ge->setNumBook ($ge->getNumBook() - 1);
            }
            $gen=$this->getDoctrine()->getRepository(Genre::class)->findBy(['id' =>$data['genre']]);
            foreach($gen as $ge) {
            $book->setGenre($ge->getLabel());
            $ge->setNumBook ($ge->getNumBook() + 1);
                    }
            $book->setDateEdition($data['dateEdi']);
            $book->setUser($data['user']);
            $book->setSubject($data['subject']);
            $book->setNombrePage($data['nb']);
            $book->setPrice($data['price']);
            $book->setImg($data['1.jpg']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();
                
        return new Response('Edited book with id '.$book->getId());
        
      
      }  

    /**
     * @Route("/review")
     * Method({POST})
     */
    public function review(Request $request){ // this function creates a review from the book
        $book = new Review();
        
        $data = $request->request->all();
  
        
        $book->setRateNick($data['nickname']);
        $book->setRateSumm($data['summery']);
        $book->setRateRev($data['review']);

        $book->setRate($data['rating']);
        $b = (int)$data['book'];


        $book->setBook($b);
        $them=$this->getDoctrine()->getRepository(Book::class)->findBy(['id' =>$b]);
        //here i update the rate score for that book
        foreach($them as $the) {
        $the->setNumRate($the->getNumRate() +1);
        $r = round (( $data['rating'] /5) + $the->getRate());
        $the->setRate($r);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();
                
        return new Response('Saved new review with id '.$book->getId());
       
    
      
      }

    /**
     * @Route("/cart", name="book_cart", methods={"GET","POST"})
     */
    public function cart(Request $request){ //this function adds a book to the user cart
        $cart = new Cart(); 
        $order = new Orde();
        $data = $request->request->all();
        $order->setBook($data['book']);
        
        $u=$this->getDoctrine()->getRepository(Book::class)->find(['id' =>(int)$data['book']]);
        $order->setUser($u->getUser());

        $cart->setBook($data['book']);
        $cart->setUser($data['user']);
        $cart->setDate(date('m/d/Y h:i:s a', time()));
        $them=$this->getDoctrine()->getRepository(Admin::class)->findBy(['id' =>(int)$data['user']]);
        foreach($them as $the) {
        $the->setCart($the->getCart() +1);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cart);
        
        $entityManager->flush();
        $order->setCart($cart->getId());
        $entityManager->persist($order);
        $entityManager->flush();
        return new Response('Saved new cart with id '.$cart->getId());
    }
}
