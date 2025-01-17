<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertEquals;

class HashTest extends TestCase
{
    public function testHash()
    {
        $password = "rahasia1234";
        $hash = Hash::make($password);

        $password2 = "rahasia1234";
        $hash2 = Hash::make($password2);

        // hasil nya error karena hash yg di hasilkan selalu berbeda
        // assertEquals($hash, $hash2);

        // jika ingin mengecek nya :
        $result = Hash::check("rahasia1234", $hash);

        self::assertTrue($result);
    }
}
