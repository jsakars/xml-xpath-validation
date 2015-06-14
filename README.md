# xml-xpath-validation
XML xpath based validation

[![Latest Stable Version](https://poser.pugx.org/werd/xml-xpath-validation/v/stable)](https://packagist.org/packages/werd/xml-xpath-validation)
[![Build Status](https://travis-ci.org/werdlv/xml-xpath-validation.svg?branch=master)](https://travis-ci.org/werdlv/xml-xpath-validation)
[![License](https://poser.pugx.org/werd/xml-xpath-validation/license)](https://packagist.org/packages/werd/xml-xpath-validation)

##Features
- Regex based validation
- Element count validation
- Compatible with PHP >= 5.6 and [HHVM](http://hhvm.com/)

##Installation
Through [Composer](https://getcomposer.org/):
```
$ composer require werd/xml-xpath-validation
```

##Usage
```php
use Werd\XmlXpathValidation\Validator;
use Werd\XmlXpathValidation\RulableInterface;

class MyRules implements RulableInterface
{
    public function getRules()
    {
        return [
            [
                'xpath' => '//my-node/@my-attribute',
                'regex' => self::REGEX_INTEGER
            ],
            [
                'xpath' => '//my-node/sub-node',
                'regex' => '/^some-custom:+[a-z]+$/i',
            ],
            ...
        ];
    }
}

$myRules = new MyRules();
$validator = new Validator();
$result = $validator->validate($pathToXml, $myRules->getRules());
```
