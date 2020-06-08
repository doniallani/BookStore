<?php
//This is the controller for Admin management
namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{  public $passwordEncoder; //This declared variable will be used to encode password 

    //this function allow us to create un object type UserPasswordEncoderInterface
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index(AdminRepository $adminRepository): Response 
    //this function will show list of users in user index (only accecible by the admin)
    {
        return $this->render('admin/index.html.twig', [
            'admins' => $adminRepository->findAll(),
        ]);
    }
  
    /**
     * @Route("/new", name="admin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    //this function will render the page new.html.twig
    {
       

        return $this->render('admin/new.html.twig');
    }

    /**
     * @Route("/add", name="admin_add", methods={"GET","POST"})
     */
    public function add(Request $request)
    { //this function adds a new user
    
        $agent = new Admin();
      
        $data = $request->request->all();

   
 
  // Here we will encode the password for security mesures
  //this action is based on the form manipulated by  Ajax 
        $agent->setPassword($this->passwordEncoder->encodePassword(
               $agent,
               $data['password']
           ));
        $agent->setEmail($data['email']);
        $agent->setRoles($data['role']);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($agent);
        $entityManager->flush();
                
      
        return new Response('saved');
    }
    /**
     * @Route("/{id}", name="admin_show", methods={"GET"})
     */
    public function show(Admin $admin): Response
    {//this function will 
        return $this->render('admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Admin $admin): Response
    {
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'admin' => $admin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Admin $admin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($admin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_index');
    }
}
