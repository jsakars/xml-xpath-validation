<?php

/**
 * This file is part of werd/xml-xpath-validation.
 *
 * (c) Jānis Šakars <janis.sakars@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Werd\XmlXpathValidation;

class Validator
{
    /**
     * @var \SimpleXMLElement
     */
    private $simpleXml;

    /**
     * @var array|false
     */
    private $elements;

    /**
     * @var bool
     */
    private $valid = true;

    /**
     * Validate XML against given rules
     *
     * @param string $xml
     * @param array $rules
     * @return bool
     * @throws \Exception
     */
    public function validate($xml, array $rules)
    {
        $this->simpleXml = new \SimpleXMLElement(file_get_contents($xml));

        foreach ($rules as $rule) {
            if (!isset($rule['xpath'])) {
                throw new \InvalidArgumentException('xpath not found');
            } else {
                $this->elements = $this->simpleXml->xpath($rule['xpath']);
                if ($this->elements === false || !count($this->elements)) {
                    $this->valid = false;
                } else {
                    // xpath itself
                    $valid = true;

                    // regex
                    if (isset($rule['regex'])) {
                        $valid = $this->validateRegex($rule['regex']);
                    }
                    // occurrence
                    if (isset($rule['occurrence'])) {
                        $valid = $this->validateOccurrence($rule['occurrence']);
                    }

                    if ($valid !== true) {
                        $this->valid = false;
                    }
                }
            }
        }

        return $this->valid;
    }

    /**
     * Validate elements based on a regex
     *
     * @param string $regex
     * @return bool
     */
    private function validateRegex($regex)
    {
        $valid = true;

        foreach ($this->elements as $element) {
            $element = (string) $element;
            if (!preg_match($regex, $element)) {
                $valid = false;
            }
        }

        return $valid;
    }

    /**
     * Validate elements based on their occurrence(count)
     *
     * @param int $occurrence
     * @return bool
     */
    private function validateOccurrence($occurrence)
    {
        if (count($this->elements) !== $occurrence) {
            return false;
        }

        return true;
    }
}
