<?php

namespace App\Controller\Admin\Categories;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesAdminController extends AbstractController
{

    public function listAction() {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/categories/list.html.twig', ['categories' => $categories]);
    }

}
