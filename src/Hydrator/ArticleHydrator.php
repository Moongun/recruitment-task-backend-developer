<?php

declare(strict_types=1);


namespace App\Hydrator;


use App\Collector\ArticleCollectorInterface;
use App\Resource\Article;

/**
 * Hydrator for Article Resource.
 */
class ArticleHydrator implements ArticleHydratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function hydrate(ArticleCollectorInterface $collector): Article
    {
        return (new Article(
            title: $collector->getMain(),
            publicationDate: $collector->getPublicationDate(),
            lead: $collector->getLeadParagraph(),
            image: $collector->getImage(),
            url: $collector->getWebUrl()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function hydrateMulti(ArticleCollectorInterface ...$collectors): array
    {
        $collection = [];

        foreach ($collectors as $collector) {
            $collection[] = $this->hydrate($collector);
        }

        return $collection;
    }
}