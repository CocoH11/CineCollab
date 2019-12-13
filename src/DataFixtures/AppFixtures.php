<?php

namespace App\DataFixtures;

use App\Entity\Metier;
use App\Entity\Personnalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $this->loadMetiers($manager);
        $this->loadPersonnalites($manager);

    }


    public function loadMetiers(ObjectManager $manager){
        $metiers=[
            ["libelle"=>"réalisateur"],
            ["libelle"=>"acteur"],
            ["libelle"=>"producteur"],
            ["libelle"=>"scénariste"],
            ["libelle"=>"compsiteur"],
            ["libelle"=>"monteur"]
        ];
        foreach ($metiers as $metier){
            $new_metier= new Metier();
            $new_metier->setLibelle($metier["libelle"]);
            $manager->persist($new_metier);
        }
        $manager->flush();
    }

    public function loadPersonnalites(ObjectManager $manager){
        $metiers=$manager->getRepository(Metier::class)->findAll();
        $personnalites=[
            ["nom"=>"Pitt", "prenom"=>"Brad", "metiers"=>[$metiers[1]]],
            ["nom"=>"Jolie", "prenom"=>"Angelina", "metiers"=>[$metiers[1]]],
            ["nom"=>"Besson", "prenom"=>"Luc", "metiers"=>[$metiers[0]]],
            ["nom"=>"Spielberg", "prenom"=>"Steven", "metiers"=>[$metiers[0]]],
            ["nom"=>"Lucas", "prenom"=>"George", "metiers"=>[$metiers[2]]],
            ["nom"=>"Burton", "prenom"=>"Tim", "metiers"=>[$metiers[0]]],
            ["nom"=>"Robbie", "prenom"=>"Margot", "metiers"=>[$metiers[1]]],
            ["nom"=>"Ford", "prenom"=>"Harrison", "metiers"=>[$metiers[1]]],
            ["nom"=>"Portman", "prenom"=>"Natalie", "metiers"=>[$metiers[1]]],
            ["nom"=>"Jackson", "prenom"=>"Peter", "metiers"=>[$metiers[2]]],
            ["nom"=>"Damon", "prenom"=>"Matt", "metiers"=>[$metiers[1]]],
            ["nom"=>"Bale", "prenom"=>"Christian", "metiers"=>[$metiers[1]]],
            ["nom"=>"Stone", "prenom"=>"Emma", "metiers"=>[$metiers[1]]],
            ["nom"=>"Gosling", "prenom"=>"Ryan", "metiers"=>[$metiers[1]]],
            ["nom"=>"Gadot", "prenom"=>"Gal", "metiers"=>[$metiers[1]]],
            ["nom"=>"Hurwitz", "prenom"=>"Justin", "metiers"=>[$metiers]],
            ["nom"=>"Reno", "prenom"=>"Jean", "metiers"=>[$metiers[1]]],
            ["nom"=>"Dujardin", "prenom"=>"Jean", "metiers"=>[$metiers[1]]],
            ["nom"=>"Chabat", "prenom"=>"Alain", "metiers"=>[$metiers[1]]],
            ["nom"=>"Depardieu", "prenom"=>"Gérard", "metiers"=>[$metiers[1]]],
            ["nom"=>"Belmondo", "prenom"=>"Jean-Paul", "metiers"=>[$metiers[1]]]
            ];

        foreach ($personnalites as $personnalite){
            $new_personnalite= new Personnalite();
            $new_personnalite->setNom($personnalite['nom']);
            $new_personnalite->setPrenom($personnalite['prenom']);
            $new_personnalite->addMetier($personnalite["metier"]);
            $manager->persist($new_personnalite);
        }
        $manager->flush();
    }
}
