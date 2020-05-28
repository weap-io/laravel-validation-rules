<?php

namespace Weap\LaravelValidationRules\Tests\Rules;

use Weap\LaravelValidationRules\Tests\TestCase;
use Weap\LaravelValidationRules\Rules\Network\Hostname;

class HostnameTest extends TestCase
{   
    /** @test */
    public function it_passes_if_hostname_is_valid_and_tld_is_not_required()
    {
        $rule = new Hostname(false);
        
        $this->assertTrue($rule->passes('hostname', 'localhost'));
        $this->assertTrue($rule->passes('hostname', 'weap.io'));
    }

    /** @test */
    public function it_passes_if_hostname_is_valid_and_tld_is_required()
    {
        $rule = new Hostname;

        $this->assertTrue($rule->passes('hostname', 'weap.io'));
    }

    /** @test */
    public function it_does_not_pass_if_hostname_is_valid_and_without_tld_when_the_tld_is_required()
    {
        $rule = new Hostname;

        $this->assertFalse($rule->passes('hostname', 'localhost'));
    }

    /** @test */
    public function it_does_not_pass_if_hostname_is_invalid()
    {
        $rule = new Hostname;

        $this->assertFalse($rule->passeS('hostname', '_weap.io'));
    }
}