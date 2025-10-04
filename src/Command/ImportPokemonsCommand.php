<?php

namespace App\Command;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:import-pokemons',
    description: 'Importe tous les Pokémon depuis la PokeAPI officielle (avec noms et types FR/EN)'
)]
class ImportPokemonsCommand extends Command
{
    private const API_BASE = 'https://pokeapi.co/api/v2/pokemon/';
    private const SPECIES_BASE = 'https://pokeapi.co/api/v2/pokemon-species/';
    private const TYPE_BASE = 'https://pokeapi.co/api/v2/type/';
    private const LIMIT = 1025;

    public function __construct(
        private HttpClientInterface $client,
        private EntityManagerInterface $em,
        private PokemonRepository $repo
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("<info>🚀 Import des Pokémon depuis la PokeAPI…</info>");

        for ($i = 1; $i <= self::LIMIT; $i++) {
            try {
                if ($this->repo->findOneBy(['id' => $i])) {
                    $output->writeln("⏩ Pokémon #$i déjà existant, passage au suivant...");
                    continue;
                }

                $data = $this->client->request('GET', self::API_BASE . $i)->toArray();
                $species = $this->client->request('GET', self::SPECIES_BASE . $i)->toArray();

                $frenchName = null;
                foreach ($species['names'] as $n) {
                    if ($n['language']['name'] === 'fr') {
                        $frenchName = $n['name'];
                        break;
                    }
                }

                $typeEn = ucfirst($data['types'][0]['type']['name'] ?? 'Unknown');
                $typeFr = ucfirst($typeEn);

                try {
                    $typeData = $this->client->request('GET', self::TYPE_BASE . strtolower($typeEn))->toArray();
                    foreach ($typeData['names'] as $n) {
                        if ($n['language']['name'] === 'fr') {
                            $typeFr = $n['name'];
                            break;
                        }
                    }
                } catch (\Throwable) {}

                $pokemon = new Pokemon();
                $pokemon->setName(ucfirst($data['name']));
                $pokemon->setNameFr($frenchName ?? ucfirst($data['name']));
                $pokemon->setType($typeEn);
                $pokemon->setTypeFr($typeFr);
                $pokemon->setHp($data['stats'][0]['base_stat'] ?? 0);
                $pokemon->setAttack($data['stats'][1]['base_stat'] ?? 0);
                $pokemon->setDefense($data['stats'][2]['base_stat'] ?? 0);
                $pokemon->setSprite($data['sprites']['front_default'] ?? '');

                $this->em->persist($pokemon);

                if ($i % 25 === 0) {
                    $this->em->flush();
                    $this->em->clear();
                }

                $output->writeln("✅ #$i - {$pokemon->getNameFr()} ({$pokemon->getTypeFr()})");
                usleep(120000);
            } catch (\Throwable $e) {
                $output->writeln("<error>❌ Erreur sur le Pokémon #$i : {$e->getMessage()}</error>");
            }
        }

        $this->em->flush();
        $output->writeln("<info>✅ Import terminé !</info>");
        return Command::SUCCESS;
    }
}
