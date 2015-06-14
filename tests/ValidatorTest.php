<?php

/**
 * This file is part of werd/xml-xpath-validation.
 *
 * (c) Jānis Šakars <janis.sakars@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Werd\XmlXpathValidation\Tests;

use Werd\XmlXpathValidation\Validator;
use Werd\XmlXpathValidation\RulableInterface;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var string
     */
    private $xmlPath;

    public function setUp()
    {
        $this->validator = new Validator();

        $this->xmlPath = __DIR__ . '/data.xml';
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testXpathIsNotGiven()
    {
        $this->validator->validate($this->xmlPath, [[]]);
    }

    public function testXpathNotGiven()
    {
        $rules = [
            [
                'xpath' => '//none-existing-nodes'
            ]
        ];

        $this->assertEquals(false, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testRegex1IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-test-1"]'
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testStringRegex1IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-string-test-1"]/@attribute',
                'regex' => RulableInterface::REGEX_STRING
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testIntegerRegex1IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-integer-test-1"]/@attribute',
                'regex' => RulableInterface::REGEX_INTEGER
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testIntegerRegex2IsNotValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-integer-test-2"]/@attribute',
                'regex' => RulableInterface::REGEX_INTEGER
            ]
        ];

        $this->assertEquals(false, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testIntegerRegex3IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-integer-test-3"]/sub-node',
                'regex' => RulableInterface::REGEX_INTEGER
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex1IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-1"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex2IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-2"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex3IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-3"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex4IsNotValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-4"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(false, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex5IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-5"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex6IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-6"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex7IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-7"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(true, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testBooleanRegex8IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="regex-boolean-test-8"]/@attribute',
                'regex' => RulableInterface::REGEX_BOOLEAN
            ]
        ];

        $this->assertEquals(false, $this->validator->validate($this->xmlPath, $rules));
    }

    public function testOccurrence1IsValid()
    {
        $rules = [
            [
                'xpath' => '//nodes/node[@type="occurrence-test-1"]',
                'occurrence' => 2
            ]
        ];

        $this->assertEquals(false, $this->validator->validate($this->xmlPath, $rules));
    }
}
