<?php
/**
 * Created by PhpStorm.
 * User: bbugariu
 * Date: 08.02.2018
 * Time: 21:57
 */

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

interface RestInterface
{
    public function fetch($id, EntityManagerInterface $entityManager);
    public function create(Request $request, EntityManagerInterface $entityManager);
    public function update($id, Request $request, EntityManagerInterface $entityManager);
    public function remove($id, EntityManagerInterface $entityManager);
}