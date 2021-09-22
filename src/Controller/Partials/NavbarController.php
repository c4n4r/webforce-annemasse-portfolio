<?php

namespace App\Controller\Partials;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavbarController extends AbstractController
{

    public function indexAction() {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('partials/_navbar.html.twig', ['categories' => $categories]);
    }

}
