<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


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
        $entreprises=$this->getDoctrine()->getRepository(Entreprise::class)->findAll();

        return $this->render('pro_stage/entreprises.html.twig', [
            'controller_name' => 'Controleur ProStage entreprises',
            'listeEntreprises' => $entreprises
        ]);
    }

    /**
     * @Route("/formations", name="pro_stage_formations")
     */

    public function foramtions_vue(): Response
    {
        $formations=$this->getDoctrine()->getRepository(Formation::class)->findAll();
        return $this->render('pro_stage/formations.html.twig', [
            'controller_name' => 'Controleur ProStage formations',
            'listeFormations' => $formations
        ]);
    }

     /**
     * @Route("/stages", name="pro_stage_stage")
     */

    public function liste_stages_vue(): Response
    {
        $stages=$this->getDoctrine()->getRepository(Stage::class)->findStageEtEntreprise();
        return $this->render('pro_stage/listeStages.html.twig', [
            'controller_name' => 'Controleur ProStage stages',
            'listeStages' => $stages
        ]);
    }



    /**
     * @Route("/stages/{id}", name="pro_stage_stages_id")
     */

    public function stage_vue($id): Response
    {
        $stage=$this->getDoctrine()->getRepository(Stage::class)->find($id);

        return $this->render('pro_stage/stages.html.twig', [
            'controller_name' => 'Controleur ProStage stages',
            'stage' => $stage
        ]);
    }

    /**
     * @Route("/entreprises/{nom}", name="pro_stage_stageParEntreprise")
     */

    public function entreprise_stage_vue($nom): Response
    {
        $stages=$this->getDoctrine()->getRepository(Stage::class)->findStagesPourUneEntreprise($nom);

        return $this->render('pro_stage/entrepriseStage.html.twig', [
            'controller_name' => 'Controleur ProStage stages',
            'stages' => $stages
        ]);
    }

    /**
     * @Route("/formations/{id}", name="pro_stage_stageParFormation")
     */

    public function formation_stage_vue($id): Response
    {
        $formation=$this->getDoctrine()->getRepository(Formation::class)->find($id);

        return $this->render('pro_stage/formationStage.html.twig', [
            'controller_name' => 'Controleur ProStage stages',
            'formation' => $formation
        ]);
    }

    /**
     * @Route("/formulaireEntreprise", name="pro_stage_formulaireEntreprise")
     */

    public function formulaire_entreprise_vue(Request $request, EntityManagerInterface $manager): Response
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise = $this->createFormBuilder($entreprise)
                                ->add('nom',TextType::class)
                                ->add('adresse',TextareaType::class)
                                ->add('siteWeb',TextType::class,['constraints' => new Url()])
                                ->add('activite',TextareaType::class)
                                ->getForm();


$formulaireEntreprise->handleRequest($request);

if($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid()){
    $manager->persist($entreprise);
    $manager->flush();

    return $this->redirectToRoute('pro_stage_accueil');
}

        

        return $this->render('pro_stage/formulaireEntreprise.html.twig',[
            'formulaire' => $formulaireEntreprise->createView() 
        ]);
    }
}
