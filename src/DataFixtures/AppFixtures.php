<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Hotel;
use App\Entity\Chambre;
use App\Entity\Comodite;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();

        for ($i = 1; $i <= 20; $i++) {

            $hotel = new Hotel();

            $nom = $faker->company();
            $slug = $slugify->slugify($nom);
            $description = $faker->sentence();
            $ville = $faker->city();
            $adresse = $faker->address();
            $contact = $faker->e164PhoneNumber();
            $photoHotel = $faker->imageUrl(900, 600);

            $hotel->setNom($nom)
                ->setSlug($slug)
                ->setDescription($description)
                ->setVille($ville)
                ->setAdresse($adresse)
                ->setContact($contact)
                ->setNote(mt_rand(1, 5))
                ->setPhotoHotel($photoHotel);


            for ($j = 1; $j <= mt_rand(2, 10); $j++) {
                $chambre = new Chambre();
                $photochambre = $faker->imageUrl(900, 600);
                $prix = mt_rand(1000, 2000);


                $chambre->setNumeroChambre(mt_rand(2, 10))
                    ->setEtage(mt_rand(1, 5))
                    ->setPhotoChambre($photochambre)
                    ->setPrix($prix)
                    ->setChambreHotel($hotel);

                $manager->persist($chambre);
                for ($k = 1; $k <= mt_rand(5, 10); $k++) {
                    $comodites = new Comodite();
                    $nomComodite = $faker->jobTitle();

                    $comodites->setNom($nomComodite)
                        ->setChambre($chambre);

                    $manager->persist($comodites);
                }
            }
            $manager->persist($hotel);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
