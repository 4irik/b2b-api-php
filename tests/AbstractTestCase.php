<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Tests;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use AvtoDev\GuzzleUrlMock\UrlsMockHandler;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @var UrlsMockHandler
     */
    protected $guzzle_handler;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->guzzle_handler = new UrlsMockHandler;

        // Setup default responses
        foreach (['get', 'post', 'put', 'delete', 'head', 'update'] as $method) {
            $this->guzzle_handler->onUriRegexpRequested("~(?'{$method}').*~iu", $method, new Response(
                404, [], 'Response mocked for testing'
            ));
        }
    }
}
