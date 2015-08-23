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

    public function dataProvider()
    {
        return [
            ['//none-existing-nodes', null, false],
            ['//nodes/node[@type="regex-test-1"]', null],
            ['//nodes/node[@type="regex-string-test-1"]/@attribute', RulableInterface::REGEX_STRING],
            ['//nodes/node[@type="regex-integer-test-1"]/@attribute',RulableInterface::REGEX_INTEGER],
            ['//nodes/node[@type="regex-integer-test-2"]/@attribute', RulableInterface::REGEX_INTEGER, false],
            ['//nodes/node[@type="regex-integer-test-3"]/sub-node',RulableInterface::REGEX_INTEGER],
            ['//nodes/node[@type="regex-boolean-test-1"]/@attribute', RulableInterface::REGEX_BOOLEAN],
            ['//nodes/node[@type="regex-boolean-test-2"]/@attribute', RulableInterface::REGEX_BOOLEAN],
            ['//nodes/node[@type="regex-boolean-test-3"]/@attribute', RulableInterface::REGEX_BOOLEAN],
            ['//nodes/node[@type="regex-boolean-test-4"]/@attribute', RulableInterface::REGEX_BOOLEAN, false],
            ['//nodes/node[@type="regex-boolean-test-5"]/@attribute', RulableInterface::REGEX_BOOLEAN],
            ['//nodes/node[@type="regex-boolean-test-6"]/@attribute', RulableInterface::REGEX_BOOLEAN],
            ['//nodes/node[@type="regex-boolean-test-7"]/@attribute', RulableInterface::REGEX_BOOLEAN],
            ['//nodes/node[@type="regex-boolean-test-8"]/@attribute', RulableInterface::REGEX_BOOLEAN, false],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param string $xpath
     * @param string $regex
     * @param bool $expected
     */
    public function testValidRules($xpath, $regex, $expected = true)
    {
        $this->assertEquals($expected, $this->validator->validate($this->xmlPath, [
            [
                'xpath' => $xpath,
                'regex' => $regex
            ]
        ]));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testXpathIsNotGiven()
    {
        $this->validator->validate($this->xmlPath, [[]]);
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
