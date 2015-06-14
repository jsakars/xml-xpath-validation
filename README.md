# xml-xpath-validation
XML xpath based validation

[![Build Status](https://travis-ci.org/werdlv/xml-xpath-validation.svg?branch=master)](https://travis-ci.org/werdlv/xml-xpath-validation)

##Features
- Regex based validation
- Compatible with PHP >= 5.6 and [HHVM](http://hhvm.com/)

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
            ...
        ];
    }
}

$myRules = new MyRules();
$validator = new Validator();
$result = $validator->validate($pathToXml, $myRules->getRules());
```
