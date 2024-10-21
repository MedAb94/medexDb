<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    public function will_display_empty_table() {
        $response = $this->get('/products')
    }
}
