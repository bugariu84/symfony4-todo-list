<?php

namespace App\Controller;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller implements RestInterface
{
    public function fetch($id, EntityManagerInterface $entityManager)
    {
        // TODO: Implement fetch() method.
    }

    /**
     * @Route("/item/create", name="item_create", methods={"POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        // Create a new toto item
        $item = new Item();
        $item->setTitle($request->get('title'));
        $item->setBody($request->get('body'));

        $entityManager->persist($item);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/item/update/{id}", name="item_update", methods={"PATCH", "POST"})
     *
     * @param $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     */
    public function update($id, Request $request, EntityManagerInterface $entityManager)
    {
        $item = $entityManager->getRepository('App:Item')->find($id);
        $item->setTitle($request->request->get('title'));
        $item->setBody($request->request->get('body'));

        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/item/remove/{id}", name="item_delete", methods={"DELETE", "GET"})
     *
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove($id, EntityManagerInterface $entityManager)
    {
        $item = $entityManager->getRepository('App:Item')->find($id);
        $entityManager->remove($item);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
