<?php
namespace Melindrea\Exalted\CharacterLoader;

use \Melindrea\Exalted as ME;

class XML implements \Melindrea\Exalted\Interfaces\Loadable
{
    protected $character;

    public function __construct($path)
    {
        $this->character = $this->convertToCharacter($this->loadDocument($path));
        print_r($this->character);
    }

    public function getCharacter()
    {
        return $this->character;
    }

    protected function loadDocument($path)
    {
        $startsWithHttp = (strpos($path, 'http') === 0);
        if (! (file_exists($path) || $startsWithHttp)) {
            throw new ME\Exceptions\FileException(sprintf('File: %s does not exist', $path));
        }

        $document = new \DOMDocument();

        if (@$document->load($path) === false) {
            if ($startsWithHttp) {
                throw new ME\Exceptions\RemoteFileException(sprintf('Remote File: %s can not be read', $path));
            } else {
                throw new ME\Exceptions\InvalidXMLException(sprintf('%s is invalid XML', $path));
            }
        }

        return $document;
    }

    protected function convertToCharacter(\DOMDocument $xml)
    {
        $xmlType = $xml->getElementsByTagName('CharacterType');

        if ($xmlType->length == 0) {
            $characterType = null;
        } else {
            $characterType = $xmlType->item(0)->nodeValue;
        }

        return ME\Character::factory($characterType)
            ->values($this->parseValues($xml));
    }

    protected function getAttributes(\DOMDocument $xml)
    {
        $attributes = $xml->getElementsByTagName('Attributes')->item(0);
        $traits = [];

        foreach ($attributes->childNodes as $group) {
            $groupName = $group->nodeName;
            if ($groupName != '#text') {
                $traitGroup = new ME\Character\Traits($groupName);
                foreach ($group->childNodes as $attribute) {
                    $attributeName = $attribute->nodeName;
                    if ($attributeName != '#text') {
                        $traitGroup->{$attributeName} = $this->parseTrait($attribute, 'Attribute');
                    }

                }
                $traits[] = $traitGroup;
            }
        }
        return new ME\Character\Attributes($traits);
    }

    protected function getVirtues(\DOMDocument $xml)
    {
        $map = [
            'compassion' => 'Compassion',
            'conviction' => 'Conviction',
            'temperance' => 'Temperance',
            'valor' => 'Valor',
        ];

        $virtues = $this->parseElementAttributes($xml, $map, 'creationValue');

        return new ME\Character\Virtues(
            $virtues['compassion'],
            $virtues['conviction'],
            $virtues['temperance'],
            $virtues['valor']
        );
    }

    protected function getLanguages(\DOMDocument $xml)
    {
        $languages = [];
        $items = $xml->getElementsByTagName('language');

        if ($items->length) {
            $languages[] = $items->item(0)->nodeValue;
        }

        return $languages;
    }

    protected function parseTrait(\DOMNode $trait, $type)
    {
        $value = $trait->getAttribute('creationValue');
        $name = $trait->nodeName;
        $favored = ($trait->getAttribute('favored') == true);
        $specialtyArray = [];

        if ($trait->hasChildNodes()) {
            $specialties = $trait->getElementsByTagName('Specialty');

            foreach ($specialties as $specialty) {
                $specialtyName = $specialty->getAttribute('name');
                $specialtyValue = $specialty->getAttribute('creationValue');

                $specialtyArray[] = new ME\Character\Specialty($specialtyName, $specialtyValue);
            }
        }

        return ME\CharacterTrait::factory($type, $name, $value, $favored, $specialtyArray);
    }

    protected function parseValues(\DOMDocument $xml)
    {
        $values = $this->parseSingularStats($xml);
        $values = array_merge($values, $this->parseCreationValues($xml));
        $values = array_merge($values, $this->parseNameValues($xml));
        $values = array_merge($values, $this->parseTypeValues($xml));
        $values = array_merge($values, $this->parseAgeValues($xml));
        $values = array_merge($values, ['virtues' => $this->getVirtues($xml)]);
        $values = array_merge($values, ['attributes' => $this->getAttributes($xml)]);
        $values = array_merge($values, ['languages' => $this->getLanguages($xml)]);

        return $values;
    }

    protected function parseSingularStats(\DOMDocument $xml)
    {
        $map = [
            'name' => 'CharacterName',
            'player' => 'Player',
            'concept' => 'Characterization',
            'motivation' => 'Motivation',
            'description' => 'PhysicalDescription',
            'notes' => 'Notes',
            'anima' => 'Anima',
        ];

        $values = [];

        foreach ($map as $key => $tag) {
            $items = $xml->getElementsByTagName($tag);

            if ($items->length) {
                $values[$key] = $items->item(0)->nodeValue;
            }
        }

        return $values;
    }

    protected function parseCreationValues(\DOMDocument $xml)
    {
        $map = [
            'essence' => 'Essence',
            'willpower' => 'Willpower',
        ];

        $values = $this->parseElementAttributes($xml, $map, 'creationValue');

        $values = array_map(
            function ($value, $key) {
                $class = sprintf('\Melindrea\Exalted\Character\%s', ucfirst($key));
                return new $class($value);
            },
            $values,
            array_keys($values)
        );
        return $values;
    }

    protected function parseNameValues(\DOMDocument $xml)
    {
        $map = [
            'ruleset' => 'RuleSet',
        ];

        return $this->parseElementAttributes($xml, $map, 'name');
    }

    protected function parseTypeValues(\DOMDocument $xml)
    {
        $map = [
            'caste' => 'Caste',
        ];

        return $this->parseElementAttributes($xml, $map, 'type');
    }

    protected function parseAgeValues(\DOMDocument $xml)
    {
        $map = [
            'age' => 'CharacterConcept',
        ];

        return $this->parseElementAttributes($xml, $map, 'age');
    }

    protected function parseElementAttributes(\DOMDocument $xml, $map, $attribute)
    {
        $values = [];

        foreach ($map as $key => $tag) {
            $items = $xml->getElementsByTagName($tag);
            if ($items->length) {
                $values[$key] = $items->item(0)->getAttribute($attribute);
            }
        }

        return $values;
    }
}
