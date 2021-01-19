<?php

namespace Billplz\Tests\Four\Collection;

use Billplz\Tests\TestCase;
use Laravie\Codex\Contracts\Response;

class PayoutTest extends TestCase
{
    /**
     * API Version.
     *
     * @var string
     */
    protected $apiVersion = 'v4';

    /** @test */
    public function it_resolve_the_correct_version()
    {
        $payment = $this->makeClient()->uses('Collection.Payout', 'v4');

        $this->assertInstanceOf('Billplz\Four\Collection\Payout', $payment);
        $this->assertSame('v4', $payment->getVersion());
    }

    /** @test */
    public function it_can_get_mass_payment_for_collection()
    {
        $expected = '{"id":"4po8no8h","title":"My First API MPI Collection","mass_payment_instructions_count":"0","paid_amount":"0","status":"active"}';

        $faker = $this->expectRequest('GET', 'mass_payment_instruction_collections/4po8no8h')
                    ->shouldResponseWithJson(200, $expected);

        $response = $this->makeClient($faker)->uses('Collection.Payout')->get('4po8no8h');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($expected, $response->getBody());
        $this->assertNull($response->rateLimit());
        $this->assertNull($response->remainingRateLimit());
        $this->assertSame(0, $response->rateLimitNextReset());
    }

    /** @test */
    public function it_can_create_mass_payment_for_collection()
    {
        $expected = '{"id":"4po8no8h","title":"My First API MPI Collection","mass_payment_instructions_count":"0","paid_amount":"0","status":"active"}';

        $faker = $this->expectRequest('POST', 'mass_payment_instruction_collections', [], ['title' => 'My First API MPI Collection'])
                    ->shouldResponseWithJson(200, $expected);

        $response = $this->makeClient($faker)->uses('Collection.Payout')->create('My First API MPI Collection');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($expected, $response->getBody());
        $this->assertNull($response->rateLimit());
        $this->assertNull($response->remainingRateLimit());
        $this->assertSame(0, $response->rateLimitNextReset());
    }
}
