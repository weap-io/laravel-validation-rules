<?php

namespace Weap\LaravelValidationRules\Tests\Rules\Network;

use Weap\LaravelValidationRules\Tests\TestCase;
use Weap\LaravelValidationRules\Rules\Network\Port;

class PortTest extends TestCase
{   
    /** @test */
    public function rule_passes_if_port_is_valid()
    {
        $this->assertTrue((new Port)->passes('port', 80));
        
        // Allow port 0
        $this->assertTrue((new Port(true))->passes('port', 0));
    }

    /** @test */
    public function rules_does_not_pass_if_port_is_invalid()
    {
        // By default port 0 is not allowed
        $this->assertFalse((new Port)->passes('port', 0));

        // Negative port numbers are not allowed
        $this->assertFalse((new Port)->passes('port', -11));

        // Numbers exceeding the maximum port number are not allowed
        $this->assertFalse((new Port)->passes('port', 99999));
    }
}