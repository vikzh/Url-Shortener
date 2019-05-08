<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\Math;

class MathTest extends TestCase
{
    protected $mappings = [
        80 => '1i',
        500 => '84',
        50000 => 'd0s'
    ];

    public function testEncodeValue()
    {
        $math = new Math();

        foreach ($this->mappings as $value => $encoded) {
            $this->assertEquals($encoded, $math->toBase($value));
        }
    }
}
