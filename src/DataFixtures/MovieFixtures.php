<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }
    public function load(ObjectManager $manager)
    {
        $movie1 = new Movie();
        $movie1->setTitle('Aftersun');
        $movie1->setRealisateur('Charlotte Wells');
        $movie1->setCasting('Paul Mescal, Frankie Corio, Celia Rowlson-Hall');
        $movie1->setSynopsis("Dans un centre de villégiature, Sophie, 11 ans, chérit le temps qu'elle passe avec son père aimant et idéaliste. Vingt ans plus tard, Sophie se remémore leurs dernières vacances ensemble alors qu'elle tente de se réconcilier avec l'homme qu'elle n'a pas toujours connu.");
        $movie1->setPicture('aftersun-picture.jpeg');
        $movie1->setPoster('aftersun-poster.jpeg');
        $movie1->setMedia('P90iTMBTw2A');
        $movie1->setLink('https://letterboxd.com/film/aftersun/');
        $movie1->setSeen(1);
        $movie1->setLiked(1);
        $movie1->setMonth(9);
        $movie1->setSlug($this->slugify->generate($movie1->getTitle()));
        $manager->persist($movie1);
        $movie2 = new Movie();
        $movie2->setTitle('Bottoms');
        $movie2->setRealisateur('Emma Seligman');
        $movie2->setCasting('Rachel Sennott, Ruby Cruz, Havana Rose Liu, Ayo Edebiri, Kaia Gerber');
        $movie2->setSynopsis("Les meilleures amies impopulaires, PJ et Josie, créent un club de combat au lycée pour rencontrer des filles et perdre leur virginité. Elles se retrouvent vite dépassés lorsque les étudiants les plus populaires commencent à se battre au nom de la légitime défense.");
        $movie2->setPicture('bottoms-picture.jpg');
        $movie2->setPoster('bottoms-poster.jpg');
        $movie2->setMedia('vH5NAahf76s');
        $movie2->setLink('https://letterboxd.com/film/bottoms/');
        $movie2->setSeen(1);
        $movie2->setLiked(1);
        $movie2->setMonth(10);
        $movie2->setSlug($this->slugify->generate($movie2->getTitle()));
        $manager->persist($movie2);
        $manager->flush();
    }
}