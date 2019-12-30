<?php

namespace App\DataFixtures;

use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Metier;
use App\Entity\Nationalite;
use App\Entity\Personnalite;
use App\Entity\PersonnaliteMetier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadGenre($manager);
        $this->loadNationalite($manager);
        $this->loadMetiers($manager);
        $this->loadPersonnalites($manager);
        $this->loadFilms($manager);

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
        $nationalites=$manager->getRepository(Nationalite::class)->findAll();
        $personnalites=[
            ["nom"=>"Pitt", "prenom"=>"Brad", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Jolie", "prenom"=>"Angelina", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Besson", "prenom"=>"Luc", "metiers"=>$metiers[0], "nationalite"=>$nationalites[1]],
            ["nom"=>"Spielberg", "prenom"=>"Steven", "metiers"=>$metiers[0], "nationalite"=>$nationalites[1]],
            ["nom"=>"Lucas", "prenom"=>"George", "metiers"=>$metiers[2], "nationalite"=>$nationalites[1]],
            ["nom"=>"Burton", "prenom"=>"Tim", "metiers"=>$metiers[0], "nationalite"=>$nationalites[1]],
            ["nom"=>"Robbie", "prenom"=>"Margot", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Ford", "prenom"=>"Harrison", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Portman", "prenom"=>"Natalie", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Jackson", "prenom"=>"Peter", "metiers"=>$metiers[2], "nationalite"=>$nationalites[1]],
            ["nom"=>"Damon", "prenom"=>"Matt", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Bale", "prenom"=>"Christian", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Stone", "prenom"=>"Emma", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Gosling", "prenom"=>"Ryan", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Gadot", "prenom"=>"Gal", "metiers"=>$metiers[1], "nationalite"=>$nationalites[1]],
            ["nom"=>"Hurwitz", "prenom"=>"Justin", "metiers"=>$metiers[4], "nationalite"=>$nationalites[1]],
            ["nom"=>"Reno", "prenom"=>"Jean", "metiers"=>$metiers[1], "nationalite"=>$nationalites[0]],
            ["nom"=>"Dujardin", "prenom"=>"Jean", "metiers"=>$metiers[1], "nationalite"=>$nationalites[0]],
            ["nom"=>"Chabat", "prenom"=>"Alain", "metiers"=>$metiers[1], "nationalite"=>$nationalites[0]],
            ["nom"=>"Depardieu", "prenom"=>"Gérard", "metiers"=>$metiers[1], "nationalite"=>$nationalites[0]],
            ["nom"=>"Belmondo", "prenom"=>"Jean-Paul", "metiers"=>$metiers[1], "nationalite"=>$nationalites[0]]
        ];

        foreach ($personnalites as $personnalite){
            $new_personnalite= new Personnalite();
            $new_personnalite->setNom($personnalite['nom']);
            $new_personnalite->setPrenom($personnalite['prenom']);
            $new_personnalite->setNationalite($personnalite["nationalite"]);
            $new_personnalite_metier=  new PersonnaliteMetier();
            $new_personnalite_metier->setPersonnalite($new_personnalite);
            $new_personnalite_metier->setMetier($personnalite["metiers"]);
            $manager->persist($new_personnalite);
            $manager->persist($new_personnalite_metier);
        }
        $manager->flush();
    }

    private function loadGenre(ObjectManager $manager)
    {
        $genres=[
            ["libelle"=>"Action"],
            ["libelle"=>"Comédie Musicale"],
            ["libelle"=>"Science Fiction"],
            ["libelle"=>"Horreur"],
            ["libelle"=>"Romance"],
            ["libelle"=>"Indépendant"],
            ["libelle"=>"Super Héros"]
        ];

        foreach ($genres as $genre){
            $new_genre= new Genre();
            $new_genre->setLibelle($genre["libelle"]);
            $manager->persist($new_genre);
        }
        $manager->flush();
    }

    private function loadNationalite(ObjectManager $manager)
    {
        $nationalites=[
            ["libelle"=>"France"],
            ["libelle"=>"Etats Unis"],
            ["libelle"=>"Royaume Uni"],
            ["libelle"=>"Allemagne"],
            ["libelle"=>"Espagne"],
            ["libelle"=>"Canada"],
            ["libelle"=>"Pays Bas"]
        ];

        foreach ($nationalites as $nationalite){
            $new_nationalite= new Nationalite();
            $new_nationalite->setLibelle($nationalite["libelle"]);
            $manager->persist($new_nationalite);
        }
        $manager->flush();
    }

    private function loadFilms(ObjectManager $manager)
    {
        $nationalites=$manager->getRepository(Nationalite::class)->findAll();
        $genres=$manager->getRepository(Genre::class)->findAll();
        $personnalite_metiers=$manager->getRepository(PersonnaliteMetier::class)->findAll();
        $films=[
            ["titre"=>"Star Wars V", "resume"=>"resume de star wars épisode 5", "nationalite"=>$nationalites[1], "genres"=>[$genres[2], $genres[0]], "duree"=>120, "personnalite_metiers"=>[$personnalite_metiers[7]]],
            ["titre"=>"Star Wars IV", "resume"=>"resume de star wars épisode 4", "nationalite"=>$nationalites[1], "genres"=>[$genres[2], $genres[0]], "duree"=>120,  "personnalite_metiers"=>[$personnalite_metiers[7]]],
            ["titre"=>"La La Land", "resume"=>"Film trop bien avec Ryan Gosling et Emma Stone", "nationalite"=>$nationalites[1], "genres"=>[$genres[1], $genres[4]], "duree"=>120, "personnalite_metiers"=>[$personnalite_metiers[13]]]
        ];

        foreach ($films as $film){
            $new_film= new Film();
            $new_film->setTitre($film["titre"]);
            $new_film->setResume($film["resume"]);
            $new_film->setNationalite($film['nationalite']);
            $new_film->setDuree($film["duree"]);
            $new_film->addGenre($film["genres"][0]);
            $new_film->addGenre($film["genres"][1]);
            $new_film->addPersonnaliteMetier($film["personnalite_metiers"][0]);
            //if($film["personnalite_metiers"][1])$new_film->addPersonnaliteMetier($film["personnalite_metiers"][1]);
            $manager->persist($new_film);
        }
        $manager->flush();
    }
}
