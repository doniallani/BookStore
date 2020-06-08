<?php
  namespace App\Controller;
  //this function defines the home page for the website
  use App\Entity\Cart;
  use App\Entity\Admin;
  use App\Entity\Book;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;

  class DashboardController extends Controller {
      /**
     * @Route("/", name="dashboard")
     * @Method({"GET"})
     */
    public function index() {
      $conn = $this->getDoctrine()->getManager()->getConnection();


      $sql = "SELECT * FROM Book Order by rate  DESC";
      $stmt = $conn->prepare($sql);
      //$stmt->bindValue(1, $id);
      $stmt->execute();
          
        return $this->render('dashboard.html.twig', ['books' => $stmt]);

    }

    /**
     * @Route("/index", name="index")
     * @Method({"GET"})
     */
    public function ind() {

      return $this->render('front/index.html.twig');
  }
    
  function cart($id) {
  $cart= $this->getDoctrine()->getRepository(Cart::class)->findBy(['user' =>$id]);
  return new Response(array('cart' => $cart));
} 

  }