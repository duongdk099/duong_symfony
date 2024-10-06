<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Movie;
use App\Entity\Season;
use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create a Movie entity
        $movie = new Movie();
        $movie->setTitle('Inception')
            ->setShortDescription('A mind-bending thriller by Christopher Nolan')
            ->setLongDescription('A detailed description of Inception movie')
            ->setReleaseDate(new \DateTime('2010-07-16'))
            ->setCoverImage('inception.jpg')
            ->setStaff(['Christopher Nolan'])  // Staff as array
            ->setCasts(['Leonardo DiCaprio', 'Joseph Gordon-Levitt']);
        $manager->persist($movie);  // This will automatically set media_type to 'movie'

        // Create a Serie entity
        $serie = new Serie();
        $serie->setTitle('Breaking Bad')
            ->setShortDescription('A high school teacher turns to a life of crime')
            ->setLongDescription('A detailed description of Breaking Bad series')
            ->setReleaseDate(new \DateTime('2008-01-20'))
            ->setCoverImage('breaking_bad.jpg')
            ->setStaff(['Vince Gilligan'])  // Staff as array
            ->setCasts(['Bryan Cranston', 'Aaron Paul']);
        $manager->persist($serie);  // This will automatically set media_type to 'serie'

        // Create a Season for the Serie
        $season = new Season();
        $season->setNumber(1)
               ->setSerie($serie);  // Assuming Season has a setSerie method or ManyToOne relationship with Serie
        $manager->persist($season);

        // Create Episodes for the Season
        $episode1 = new Episode();
        $episode1->setSeason($season)
            ->setTitle('Pilot')
            ->setDuration(58)  // Duration in minutes
            ->setReleasedAt(new DateTimeImmutable('2008-01-20'));
        $manager->persist($episode1);

        $episode2 = new Episode();
        $episode2->setSeason($season)
            ->setTitle('Cat\'s in the Bag...')
            ->setDuration(48)
            ->setReleasedAt(new DateTimeImmutable('2008-01-27'));
        $manager->persist($episode2);

        // Flush all data to the database
        $manager->flush();
    }
}
