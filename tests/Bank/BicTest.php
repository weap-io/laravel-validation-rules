<?php

namespace Weap\LaravelValidationRules\Tests\Rules;

use Weap\LaravelValidationRules\Tests\TestCase;
use Weap\LaravelValidationRules\Rules\Bank\Bic;

class BicTest extends TestCase
{
    /** @test */
    public function it_passes_if_bic_is_valid()
    {
        $rule = (new Bic);

        $this->assertTrue($rule->passes('bic', 'RBOSGGSX'));
        $this->assertTrue($rule->passes('bic', 'CHASUS33'));
        $this->assertTrue($rule->passes('bic', 'BARCGB22'));
        $this->assertTrue($rule->passes('bic', 'COBADEFF'));
    }

    /** @test */
    public function it_does_not_pass_if_bic_is_invalid()
    {
        $rule = (new Bic);

        $this->assertFalse($rule->passes('bic', 'obviously-invalid-bic'));
        $this->assertFalse($rule->passes('bic', 'E31DCLLFFF'));
        $this->assertFalse($rule->passes('bic', 'CE1EL2LLFFF'));
        $this->assertFalse($rule->passes('bic', 'C1BADEFF'));
    }
}