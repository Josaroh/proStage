<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //création de générateur de données faker

        $faker= \Faker\Factory::create('fr_FR');

        /*********************************************
         ********  creation des entreprises *********
         **********************************************/
        $nbEntreprises = 15;
        $tabActivite = array("Assistance, maintenance, dépannage informatique", "Conseils, audit, ingénierie informatique", "Développement de logiciels de programmation, d'exploitation, de gestion"
            , "Développement de progiciels applicatifs, de gestion","Développement, commerce de gros de systèmes dédiés, terminaux d'acquisition de données","Édition, commerce de gros de logiciels de programmation, d'exploitation, de gestion","Hébergement de sites internet, dépôt de noms de domaine",
            "Développement, programmation informatique","Traitement, saisie de données informatiques","Exploitation de sites web","Serveur, éditeur de banque de données");

        $tabEntreprise=[];

        for($i=1; $i <= $nbEntreprises; $i++){
            $entreprise = new Entreprise();

            //gérer la génration de faker
            $nomCompany = $faker->company;
            $pos=strpos($nomCompany,'.', $offset = 0);
            while($pos != false){
                $nomCompany = $faker->company;
                $pos=strpos($nomCompany,'.', $offset = 0);
            } 
            
            

            $posActivite = $faker->numberBetween($min=0, $max=count($tabActivite)-1);

            $activite=$tabActivite[$posActivite];

            $entreprise->setNom($nomCompany);
            $entreprise->setAdresse($faker->address);



            $entreprise->setSiteWeb($faker->domainName);
            $entreprise->setActivite($activite);

            array_push($tabEntreprise, $entreprise);

            $manager->persist($entreprise);
        }

        /*********************************************
         ********  creation des formations *********
         **********************************************/
        $listeFormations = array("DUT INFO" => "Diplome universitaire de technlogie Informatique",
        "LP Numérique" => "Licence professionnelle Métiers du Numérique",
        "LP PA" => "Licence professionnelle Programmation Avancée",
        "LI" => "Licence Informatique");

        $listeTitreStage = array("Developpement web",
        "Administration Réseau",
        "Developpement mobile",
        "Administration base de données",
        "gestion de projet informatique");

        foreach($listeFormations as $nomCourt => $nomLong){
            $formation = new Formation();

            $formation->setNomCourt($nomCourt);

            $formation->setNomLong($nomLong);

            $manager->persist($formation);

            $posTitreStage = $faker->numberBetween($min=0, $max=count($listeTitreStage)-1);
            $titreStage=$listeTitreStage[$posTitreStage];
            $stage = new Stage();
            $stage->setTitre($titreStage);
            $stage->setDescription($faker->realText($maxNbChars = 200, $indexSize =2));
            $stage->setEmail($faker->email);

            $stage->addFormation($formation);

            $numEntreprise
        }
    
        $manager->flush();
    }
}