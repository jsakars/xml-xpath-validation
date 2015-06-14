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

interface RulableInterface
{
    const REGEX_STRING = '/^.+$/';

    const REGEX_INTEGER = '/^[0-9]+$/';

    const REGEX_BOOLEAN = '/((^true$)|(^false$))/i';

    /**
     * @return array
     */
    public function getRules();
}
