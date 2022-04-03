<?php

declare(strict_types=1);


namespace App\Tests\Hydrator;


use App\Collector\NyTimesArticleCollector;
use App\Hydrator\ArticleHydrator;
use App\Resource\Article;
use PHPUnit\Framework\TestCase;

class ArticleHydratorTest extends TestCase
{
    public function testDoesHydrateWithValidCollector()
    {
        $returnValues = [
            'main' => 'Title 1',
            'PublicationDate' => '12-12-2002',
            'lead' => 'Lorem ipsum dolor sit amet...',
            'image' => 'https://example.jpg',
            'weburl' => 'https://example.site'
        ];
        $collectorStub = $this->createStub(NyTimesArticleCollector::class);
        $collectorStub->method('getMain')->willReturn($returnValues['main']);
        $collectorStub->method('getPublicationDate')->willReturn($returnValues['PublicationDate']);
        $collectorStub->method('getLeadParagraph')->willReturn($returnValues['lead']);
        $collectorStub->method('getImage')->willReturn($returnValues['image']);
        $collectorStub->method('getWebUrl')->willReturn($returnValues['weburl']);

        $hydrator = new ArticleHydrator();
        $articleResource = $hydrator->hydrate($collectorStub);

        $this->assertSame($returnValues['main'], $articleResource->getTitle());
        $this->assertSame($returnValues['PublicationDate'], $articleResource->getPublicationDate());
        $this->assertSame($returnValues['lead'], $articleResource->getLead());
        $this->assertSame($returnValues['image'], $articleResource->getImage());
        $this->assertSame($returnValues['weburl'], $articleResource->getUrl());
    }
}