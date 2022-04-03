<?php

declare(strict_types=1);


namespace App\Service\NyTimes;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GetArticles implements EnpointInterface
{
    private const URL = 'https://api.nytimes.com/svc/search/v2/articlesearch.json';

    private array $options = [];

    /**
     * Constructor.
     *
     * @param Authenticator $authenticator
     */
    public function __construct(private Authenticator $authenticator)
    {
    }

    /**
     * Set options for query parameters.
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver->define('begin_date')
            ->allowedTypes('null', 'string');

        $optionsResolver->define('end_date')
            ->allowedTypes('null', 'string');

        $optionsResolver->define('facet')
            ->allowedTypes('null', 'bool');

        $optionsResolver->define('facet_fields')
            ->allowedTypes('null', 'string')
            ->allowedValues('day_of_week', 'document_type', 'ingredients', 'news_desk', 'pub_month', 'pub_year', 'section_name', 'source', 'subsection_name', 'type_of_material');

        $optionsResolver->define('facet_filter')
            ->allowedTypes('null', 'bool');

        $optionsResolver->define('f1')
            ->allowedTypes('null', 'string');

        $optionsResolver->define('fq')
            ->allowedTypes('null', 'string');

        $optionsResolver->define('page')
            ->allowedTypes('null', 'int');

        $optionsResolver->define('q')
            ->allowedTypes( 'null', 'string');

        $optionsResolver->define('sort')
            ->allowedTypes('null', 'string')
            ->allowedValues('newest', 'oldest', 'relevance');

        $optionsResolver->define('api-key')
            ->default($this->authenticator->getApiKey());

        $this->options = ['query' => $optionsResolver->resolve($options)];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function call(): ResponseInterface
    {
        $client = HttpClient::create();

        return $client->request("GET", self::URL, $this->options);
    }
}