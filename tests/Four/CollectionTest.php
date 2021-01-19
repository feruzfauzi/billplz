<?php

namespace Billplz\Tests\Four;

use Billplz\Tests\Base\CollectionTestCase;

class CollectionTest extends CollectionTestCase
{
    /**
     * API Version.
     *
     * @var string
     */
    protected $apiVersion = 'v4';

    /** @test */
    public function it_can_activate_collection()
    {
        $this->proxyApiVersion = 'v3';

        parent::it_can_activate_collection();
    }

    /** @test */
    public function it_can_deactivate_collection()
    {
        $this->proxyApiVersion = 'v3';

        parent::it_can_deactivate_collection();
    }

    /** @test */
    public function it_can_called_via_helper()
    {
        $collection = $this->makeClient()->collection('v4');

        $this->assertInstanceOf('Billplz\Four\Collection', $collection);
        $this->assertSame('v4', $collection->getVersion());
    }

    /** @test */
    public function it_can_retrieve_payout_instance()
    {
        $massPayment = $this->makeClient()->collection('v4')->payout();

        $this->assertInstanceOf('Billplz\Four\Collection\Payout', $massPayment);
        $this->assertSame('v4', $massPayment->getVersion());
    }
}
