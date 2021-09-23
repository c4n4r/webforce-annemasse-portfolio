<?php

namespace App\Services\Categories;

use Doctrine\ORM\EntityManagerInterface;

class CategoryFormHandler
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    public function handleForm ($form)
    {
        $category = $form->getData();
        $this->em->persist($category);
        $this->em->flush();
    }

}
