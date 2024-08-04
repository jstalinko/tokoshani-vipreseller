<?php
namespace Jstalinko\TokoshaniVipreseller\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Testing\TestCase;
use Jstalinko\TokoshaniVipreseller\TokoshaniVipreseller;
use Orchestra\Testbench\Concerns\CreatesApplication;
use Jstalinko\TokoshaniVipreseller\TokoshaniVipresellerServiceProvider;
use Jstalinko\TokoshaniVipreseller\TokoshaniVipresellerFacade as Vipreseller;

class VipTest extends TestCase
{
    use CreatesApplication;

    protected function getPackageProviders($app)
    {
        return [TokoshaniVipresellerServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->app->register(TokoshaniVipresellerServiceProvider::class);
    }

    public function test_sign()
    {
        $signConfig = env('TOKOSHANI_VIPRESELLER_SIGN');
        $signGenerate = Vipreseller::generateSign();
        $this->assertEquals($signGenerate, $signConfig);
    }

    public function test_getprofile_success()
    {
        $apiKey = env('TOKOSHANI_VIPRESELLER_API_KEY');
        $sign = env('TOKOSHANI_VIPRESELLER_SIGN');

        // Create a mock response
        $mockResponseBody = file_get_contents(__DIR__ . '/mock/profile.json');
        $mockResponse = new Response(200, [], $mockResponseBody);

        // Create a mock handler and stack
        $mockHandler = new MockHandler([$mockResponse]);
        $handlerStack = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handlerStack]);

        // Create an instance of TokoshaniVipreseller with the mocked client
        $tokoshaniVipreseller = new TokoshaniVipreseller($client);

        // Mock the config and generateSign method
        $this->app['config']->set('tokoshani-vipreseller.api_key', $apiKey);
        Vipreseller::shouldReceive('generateSign')->andReturn($sign);

        // Call the getProfile method and assert the response
        $response = $tokoshaniVipreseller->getProfile();
        $responseBody = json_decode($response, true);

        $this->assertTrue($responseBody['result']);
    }
}
