<?php

namespace Weap\LaravelValidationRules\Tests\Rules;

use Weap\LaravelValidationRules\Tests\TestCase;
use Weap\LaravelValidationRules\Rules\Bank\Iban;

class IbanTest extends TestCase
{
    /** @test */
    public function it_passes_if_iban_is_valid()
    {
        $rule = (new Iban);

        $this->assertTrue($rule->passes('iban', 'GB33BUKB20201555555555'));
        $this->assertTrue($rule->passes('iban', 'GB94BARC10201530093459'));
    }

    /** @test */
    public function it_does_not_pass_if_iban_is_invalid()
    {
        $rule = (new Iban);

        // Lower case letters not allowed
        $this->assertFalse($rule->passes('iban', 'gb33BUKB20201555555555'));
        
        // Two extra letters at the end
        $this->assertFalse($rule->passes('iban', 'GB33BUKB20201555555555AA'));
        
        // Too long
        $this->assertFalse($rule->passes('iban', 'GB33BUKB2020155555555566'));
        
        // Bank Code not found and Invalid bank code structure
        $this->assertFalse($rule->passes('iban', 'GB78BARCO0201530093459'));

        // Invalid IBAN checksum structure
        $this->assertFalse($rule->passes('iban', 'GB2LABBY09012857201707'));

        // Invalid account structure
        $this->assertFalse($rule->passes('iban', 'GB12BARC20201530093A59'));

        // Invalid IBAN length must be "X" characters long
        $this->assertFalse($rule->passes('iban', 'GB96BARC202015300934591'));

        // Invalid IBAN check digits MOD-97-10 as per ISO/IEC 7064:2003
        $this->assertFalse($rule->passes('iban', 'GB94BARC20201530093459'));

        // Country does not seem to support IBAN
        $this->assertFalse($rule->passes('iban', 'US64SVBKUS6S3300958879'));
    }
}