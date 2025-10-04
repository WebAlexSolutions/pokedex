<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PokedexController extends AbstractController
{
    #[Route('/', name: 'app_pokedex')]
    public function index(PokemonRepository $repo, Request $request): Response
    {
        $lang = $request->query->get('lang', 'fr');
        $pokemons = $repo->findAll();
        $total = count($pokemons);

        return $this->render('pokedex/index.html.twig', [
            'pokemons' => $pokemons,
            'total' => $total,
            'lang' => $lang,
        ]);
    }

}
