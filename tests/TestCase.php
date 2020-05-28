<?php

namespace Weap\LaravelValidationRules\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

abstract class TestCase extends OrchestraTestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->setUpDatabase();

        $this->app->make(EloquentFactory::class)->load(__DIR__.'/factories');
    }

    protected function setUpDatabase()
    {
        Schema::create('test_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('abstract_string_1');
            $table->string('abstract_string_2');
            $table->string('abstract_string_3');
            $table->timestamps();
        });
    }
}
