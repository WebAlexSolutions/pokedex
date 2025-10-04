<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pokemons = [
            ['Pikachu', 'Électrik', 35, 55, 40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'],
            ['Bulbizarre', 'Plante', 45, 49, 49, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'],
            ['Salamèche', 'Feu', 39, 52, 43, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'],
            ['Carapuce', 'Eau', 44, 48, 65, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png'],
        ];

        foreach ($pokemons as [$name, $type, $hp, $attack, $defense, $sprite]) {
            $pokemon = new Pokemon();
            $pokemon->setName($name);
            $pokemon->setType($type);
            $pokemon->setHp($hp);
            $pokemon->setAttack($attack);
            $pokemon->setDefense($defense);
            $pokemon->setSprite($sprite);

            $manager->persist($pokemon);
        }

        $manager->flush();
    }
}
