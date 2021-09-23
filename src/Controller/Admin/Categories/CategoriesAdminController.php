<?php

namespace App\Controller\Admin\Categories;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CategoriesAdminController extends AbstractController
{

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
            $this->handleForm($category, $form);
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
            $this->handleForm($category, $form);
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


    private function handleForm(Category $category, $form)
    {
        $category = $form->getData();
        $this->getDoctrine()->getManager()->persist($category);
        $this->getDoctrine()->getManager()->flush();
    }

}
