<?php

namespace App\Controller;


use App\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillController extends AbstractController
{

    public function showAction($id) {
        //je récupère la skill que je veux voir affichée
        $skill = $this->getDoctrine()->getRepository(Skill::class)->find($id);


        /**
         * exercice :
         * Ajouter la possibilité de rendre cliquable les technos (si il y en a ) et rediriger vers une page techno_show
         *
         */

        //retourner ma skill au template
        return $this->render('skill/show.html.twig', ['skill'=>$skill]);

    }

}
