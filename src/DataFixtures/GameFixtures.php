<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture
{
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }
    public function load(ObjectManager $manager)
    {
        $game1 = new Game();
        $game1->setTitle('Elden Ring');
        $game1->setPicture('elden-ring-picture.jpg');
        $game1->setPoster('elden-ring-poster.jpg');
        $game1->setLink('https://store.steampowered.com/app/1245620/ELDEN_RING/');
        $game1->setDescription("UNE NOUVELLE AVENTURE GRANDIOSE VOUS ATTEND Levez-vous, Sans-éclat, et puisse la grâce guider vos pas. Brandissez la puissance du Cercle d'Elden. Devenez Seigneur de l'Entre-terre.");
        $game1->setPrice(59.99);
        $game1->setType('Souls like / RPG / Open World');
        $game1->setMedia('E3Huy2cdih0');
        $game1->setDone(1);
        $game1->setLiked(1);
        $game1->setMonth(1);
        $game1->setSlug($this->slugify->generate($game1->getTitle()));
        $manager->persist($game1);
        $game2 = new Game();
        $game2->setTitle('Against the Storm');
        $game2->setPicture('against-the-storm-picture.jpg');
        $game2->setPoster('against-the-storm-poster.jpeg');
        $game2->setLink('https://store.steampowered.com/app/1336490/Against_the_Storm/');
        $game2->setDescription("Un simulateur de ville fantastique, dans lequel vous devez reconstruire la civilisation sous une pluie apocalyptique. En tant qu'émissaire de la reine, menez les humains, les castors, les lézards, les renards et les harpies pour assurer un avenir aux derniers survivants.");
        $game2->setPrice(19.49);
        $game2->setType('Stratégie / Gestion / Roguelite');
        $game2->setMedia('FsuCV86Pf5Y');
        $game2->setDone(0);
        $game2->setLiked(0);
        $game2->setMonth(2);
        $game2->setSlug($this->slugify->generate($game2->getTitle()));
        $manager->persist($game2);
        $game3 = new Game();
        $game3->setTitle('Astral Ascent');
        $game3->setPicture('astral-ascent-picture.png');
        $game3->setPoster('astral-ascent-poster.jpg');
        $game3->setLink('https://store.steampowered.com/app/1280930/Astral_Ascent/');
        $game3->setDescription("Choisissez un des 4 personnages et explorez le Jardin, une prison astrale gardée par 12 puissants boss : les Zodiaques. Pour les affronter, vous devrez dénicher et maîtriser des douzaines de sorts uniques dans ce jeu de plate-forme rogue-lite aux combats ultra rapides et satisfaisants.");
        $game3->setPrice(24.50);
        $game3->setType('Action / Roguelike');
        $game3->setMedia('5HSZqRCNBLI');
        $game3->setDone(0);
        $game3->setLiked(0);
        $game3->setMonth(3);
        $game3->setSlug($this->slugify->generate($game3->getTitle()));
        $manager->persist($game3);
        $manager->flush();
    }
}