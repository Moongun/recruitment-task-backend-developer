<?php

declare(strict_types=1);


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NyTimesControllerTest extends WebTestCase
{
    public function testDoesReadIsOk()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/nytimes/');
        $this->assertResponseIsSuccessful();
    }

    public function testDoesReadReturns10Results()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/nytimes/');
        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertSame(10, count($content));
    }

    public function testHaveResultsValidStructure()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/nytimes/');
        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        foreach ($content as $item) {
            $properties = array_keys($item);
            $this->assertSame(['title', 'publicationDate', 'lead', 'image', 'url'], $properties);
        }
    }

    public function testAreResultsSortedByNewest()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/nytimes/');
        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        foreach ($content as $item) {
            $nextItem = next($content);
            if ($nextItem) {
                $this->assertGreaterThanOrEqual($nextItem['publicationDate'], $item['publicationDate']);
            }
        }
    }
}