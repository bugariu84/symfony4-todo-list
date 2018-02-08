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