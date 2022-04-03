<?php

declare(strict_types=1);


namespace App\Hydrator;


use App\Collector\ArticleCollectorInterface;
use App\Resource\ResourceInterface;

/**
 * Interface for hydrating Article Resources.
 */
interface ArticleHydratorInterface
{
    /**
     * Hydrate single Resource.
     *
     * @param ArticleCollectorInterface $collector
     * @return ResourceInterface
     */
    public function hydrate(ArticleCollectorInterface $collector): ResourceInterface;

    /**
     * Hydrate many objects of Resource.
     *
     * @param ArticleCollectorInterface ...$collectors
     * @return ResourceInterface[]
     */
    public function hydrateMulti(ArticleCollectorInterface ...$collectors): array;
}