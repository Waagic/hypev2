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
        $manager->flush();
    }
}