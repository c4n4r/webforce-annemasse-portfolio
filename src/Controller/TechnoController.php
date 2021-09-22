<?php

namespace App\Controller;

use App\Entity\Techno;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TechnoController extends AbstractController
{

    public function showAction($id) {

        //récupérer la bonne techno
        $techno = $this->getDoctrine()->getRepository(Techno::class)->find($id);

        return $this->render('techno/show.html.twig', ['techno' => $techno]);
    }

}
