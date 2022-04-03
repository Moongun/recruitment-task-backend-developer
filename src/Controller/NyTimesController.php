<?php

declare(strict_types=1);


namespace App\Controller;


use App\Collector\NyTimesArticleCollector;
use App\Hydrator\ArticleHydratorInterface;
use App\Service\NyTimes\GetArticles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/nytimes", name: "nytimes_")]
class NyTimesController extends AbstractController
{
    public function __construct(
        private ArticleHydratorInterface $articleHydrator,
        private GetArticles $listArticles
    )
    {
    }

    #[Route("/", name: "read", methods: ["GET"])]
    public function read(Request $request): Response
    {
        // Options to build in further development e.g. forms
        $options = ['q' => $request->query->get('q'), 'sort' => 'newest', 'fq' => 'news_desk:("Cars") OR type_of_material:("Article")', 'page' => (int) $request->query->get('page')];

        $response = $this->listArticles->setOptions($options)->call();

        $content = json_decode($response->getContent());
        $docs = $content->response->docs;

        $collection = [];
        foreach ($docs as $doc) {
            $collection[] = new NyTimesArticleCollector($doc);
        }

        $articles = $this->articleHydrator->hydrateMulti(...$collection);

        return $this->json($articles);
    }
}