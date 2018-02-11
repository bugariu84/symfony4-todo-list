<?php
/**
 * Created by PhpStorm.
 * User: bbugariu
 * Date: 08.02.2018
 * Time: 20:19
 */

namespace App\Controller;


use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em)
    {
        // Fetch all items
        $items = $em->getRepository('App:Item')->findAll();

        return $this->render('home/index.html.twig', ['items' => $items]);
    }

    /**
     * @Route("/create", name="home_create", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $form = $this->createFormBuilder(new Item())
            ->setAction($this->generateUrl('item_create'))
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('priority', IntegerType::class)
            ->getForm()
        ;

        return $this->render('home/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="home_edit", methods={"GET"})
     *
     * @param $id
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit($id, EntityManagerInterface $em)
    {
        $item = $em->getRepository('App:Item')->find($id);

        return $this->render('home/edit.html.twig', ['item' => $item]);
    }
}