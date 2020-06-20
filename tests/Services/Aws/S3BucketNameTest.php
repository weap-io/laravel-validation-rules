<?php

namespace Weap\LaravelValidationRules\Tests\Rules\Services\Aws;

use Weap\LaravelValidationRules\Tests\TestCase;
use Weap\LaravelValidationRules\Rules\Services\Aws\S3BucketName;

class S3BucketNameTest extends TestCase
{
    /** @test */
    public function it_passes_if_bucket_name_is_valid()
    {
        $rule = (new S3BucketName);

        $this->assertTrue($rule->passes('bucket_name', 'my-backups'));
        $this->assertTrue($rule->passes('bucket_name', 'abc'));
        $this->assertTrue($rule->passes('bucket_name', '123'));
        $this->assertTrue($rule->passes('bucket_name', 'abc.123'));
    }

    /** @test */
    public function it_does_not_pass_if_bucket_name_has_less_than_3_characters_length()
    {
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'my'));
    }
    
    /** @test */
    public function it_does_not_pass_if_bucket_name_has_more_than_63_characters_length()
    {
        $name = str_repeat('abcdefgh', 8); // 64 characters
        $this->assertFalse((new S3BucketName)->passes('bucket_name', $name));
    }

    /** @test */
    public function it_does_not_pass_if_bucket_name_has_one_or_more_not_allowed_characters()
    {
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'abc-'));
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'abc--'));
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'abc$'));
    }
    
    /** @test */
    public function it_does_not_pass_if_bucket_name_starts_with_an_uppercase_letter()
    {
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'Abc'));
    }
    
    /** @test */
    public function it_does_not_pass_if_bucket_name_ends_with_an_uppercase_letter()
    {
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'abC'));
    }

    /** @test */
    public function it_does_not_pass_if_bucket_name_labels_are_not_sepparated_by_a_period()
    {
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'abc def'));
    }
    
    /** @test */
    public function it_does_not_pass_if_bucket_name_is_formatted_as_an_ip_address()
    {
        $this->assertFalse((new S3BucketName)->passes('bucket_name', '192.168.5.4'));
        $this->assertFalse((new S3BucketName)->passes('bucket_name', '127.0.0.1'));
    }

    /** @test */
    public function it_does_not_pass_if_bucket_name_starts_with_sequence_of_not_allowed_characters()
    {
        $this->assertFalse((new S3BucketName)->passes('bucket_name', 'xn--'));
    }
}