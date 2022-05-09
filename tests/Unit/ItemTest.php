<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Models\Item;
use Tests\TestCase;

class ItemTest extends TestCase
{
    /** @test constructor and getter */
    public function it_provides_constructor_and_getter_for_item_details_object()
    {
        $data = [
            'id' => '1',
            'price' => 100_000,
            'quantity' => 1,
            'name' => 'Pulsa Indosat Rp 100,000',
            'brand' => 'Indosat',
            'category' => 'Pulsa',
            'merchant_name' => 'Ada Cell',
            'tenor' => 3, // BCA Klikpay exclusive
            'code_plan' => 000,  // BCA Klikpay exclusive
            'mid' => 'merchant_id',  // BCA Klikpay exclusive
            'url' => 'https://adacell.co.id',
        ];
        $item = new Item($data);
        $this->assertEquals($data, $item->getData());
    }
}
