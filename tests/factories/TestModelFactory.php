<?php

use Illuminate\Support\Str;
use Weap\LaravelValidationRules\Tests\TestClasses\Models\TestModel;

$factory->define(TestModel::class, function (Faker\Generator $faker) {
    return [
        'abstract_string_1' => Str::random(),
        'abstract_string_2' => Str::random(),
        'abstract_string_3' => Str::random(),
    ];
});