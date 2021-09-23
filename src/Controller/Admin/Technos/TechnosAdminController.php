<?php

namespace App\Controller\Admin\Technos;

use App\Entity\Techno;
use App\Form\CategoryType;
use App\Form\TechnoType;
use App\Repository\TechnoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class TechnosAdminController extends AbstractController
{

    public function listAction(TechnoRepository $repository) {
        return $this->render('admin/technos/list.html.twig', ['technos' => $repository->findAll() ]);
    }

    public function newAction(Request $request, SluggerInterface $slugger, EntityManagerInterface $em) {
        $techno = new Techno();
        $form = $this->createForm(TechnoType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            /**
             * @var $techno Techno
             */
            $techno = $form->getData();
            $image = $form->get('image')->getData();

            if($image) {
                $original = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile = $slugger->slug($original) . '-' . uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('files'),
                        $newFile
                    );
                } catch (FileException $e) {
                    throw new \Exception($e);
                }
                $techno->setImage($newFile);
            }
            $em->persist($techno);
            $em->flush();
            return $this->redirectToRoute('dashboard_list_technos');
        }

        return $this->renderForm('admin/technos/form.html.twig', ["form"=>$form]);
    }

}
