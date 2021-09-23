<?php

namespace App\Controller\Admin\Categories;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Services\Categories\CategoryFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CategoriesAdminController extends AbstractController
{
    private $formHandler;

    public function __construct(CategoryFormHandler $formHandler)
    {
        $this->formHandler = $formHandler;
    }

    public function listAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/categories/list.html.twig', ['categories' => $categories]);
    }

    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->formHandler->handleForm($form);
            return $this->redirectToRoute('dashboard_list_categories');
        }
        return $this->render('admin/categories/form.html.twig', ['category_form' => $form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->formHandler->handleForm($form);
            return $this->redirectToRoute('dashboard_list_categories');
        }
        return $this->render('admin/categories/form.html.twig', ['category_form' => $form->createView()]);
    }

    public function deleteAction($id) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($category);
        $manager->flush();
        return $this->redirectToRoute('dashboard_list_categories');
    }
}
