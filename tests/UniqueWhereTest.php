<?php

namespace Weap\LaravelValidationRules\Tests\Rules;

use Weap\LaravelValidationRules\Tests\TestCase;
use Weap\LaravelValidationRules\Rules\UniqueWhere;
use Weap\LaravelValidationRules\Tests\TestClasses\Models\TestModel;

class UniqueWhereTest extends TestCase
{
    /** @test */
    public function it_passes_if_the_record_is_unique_for_the_given_condition()
    {
        factory(TestModel::class)->create([
            'abstract_string_1' => 'localhost',
            'abstract_string_2' => 'ubuntu',
        ]);
        
        // It should pass since there is no record with the same value which matches the where condition
        $rule = (new UniqueWhere('test_models.abstract_string_1', ['abstract_string_2' => 'ubuntu']));
        $this->assertTrue($rule->passes('host', '127.0.0.1'));
    }

    /** @test */
    public function it_passes_if_record_with_the_same_value_exists_but_where_condition_is_not_fulfilled()
    {
        factory(TestModel::class)->create([
            'abstract_string_1' => 'localhost',
            'abstract_string_2' => 'ubuntu-16.04',
        ]);
        
        // It should pass because the where condition is not fulfilled, even if we already have a record with the value 'localhost'
        $rule = (new UniqueWhere('test_models.abstract_string_1', ['abstract_string_2' => 'ubuntu']));
        $this->assertTrue($rule->passes('host', 'localhost'));
    }

    /** @test */
    public function it_does_not_pass_if_the_record_is_not_unique_for_the_given_condition()
    {
        factory(TestModel::class)->create([
            'abstract_string_1' => 'localhost',
            'abstract_string_2' => 'ubuntu',
        ]);
        
        // It should not pass since there aready exists a record with the same value which matches the where condition
        $rule = (new UniqueWhere('test_models.abstract_string_1', ['abstract_string_2' => 'ubuntu']));
        $this->assertFalse($rule->passes('host', 'localhost'));
    }
}