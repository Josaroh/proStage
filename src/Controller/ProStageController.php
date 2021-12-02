<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage_accueil")
     */

    public function index(): Response
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'Controleur ProStage accueil',
        ]);
    }

    /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */

    public function entreprises_vue(): Response
    {
        return $this->render('pro_stage/entreprises.html.twig', [
            'controller_name' => 'Controleur ProStage entreprises',
        ]);
    }

    /**
     * @Route("/formations", name="pro_stage_formations")
     */

    public function foramtions_vue(): Response
    {
        return $this->render('pro_stage/formations.html.twig', [
            'controller_name' => 'Controleur ProStage formations',
        ]);
    }

    /**
     * @Route("/stages/{id}", name="pro_stage_stages")
     */

    public function stages_vue($id): Response
    {
        return $this->render('pro_stage/stages.html.twig', [
            'controller_name' => 'Controleur ProStage stages',
            'idRessource' => $id
        ]);
    }
}
