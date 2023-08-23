<?php

namespace App\Factory;

use App\Entity\Possession;
use App\Repository\PossessionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Possession>
 *
 * @method        Possession|Proxy                     create(array|callable $attributes = [])
 * @method static Possession|Proxy                     createOne(array $attributes = [])
 * @method static Possession|Proxy                     find(object|array|mixed $criteria)
 * @method static Possession|Proxy                     findOrCreate(array $attributes)
 * @method static Possession|Proxy                     first(string $sortedField = 'id')
 * @method static Possession|Proxy                     last(string $sortedField = 'id')
 * @method static Possession|Proxy                     random(array $attributes = [])
 * @method static Possession|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PossessionRepository|RepositoryProxy repository()
 * @method static Possession[]|Proxy[]                 all()
 * @method static Possession[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Possession[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Possession[]|Proxy[]                 findBy(array $attributes)
 * @method static Possession[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Possession[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PossessionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'nom' => self::faker()->text(40),
            'type' => self::faker()->text(40),
            'valeur' => self::faker()->randomFloat(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Possession $possession): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Possession::class;
    }
}
