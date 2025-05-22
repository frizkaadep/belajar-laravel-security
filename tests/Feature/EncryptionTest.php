<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EncryptionTest extends TestCase
{
   public function testEncryption()
   {
      $value = "Frizka Ade Prasurya";
      $encrypted = Crypt::encryptString($value);
      $decrypted = Crypt::decryptString($encrypted);
      self::assertEquals($value, $decrypted);
   }
}
