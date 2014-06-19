<?php
namespace Melindrea\Exalted\CharacterLoader;

use \Melindrea\Exalted as ME;

class XML implements \Melindrea\Exalted\Interfaces\Loadable
{
    protected $character;

    public function __construct($path)
    {
        $this->character = $this->convertToCharacter($this->loadDocument($path));
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

        $values = $this->parseValues($xml);

        return ME\Character::factory($characterType)
            ->values($values)
            ->set('attributes', $this->getAttributes($xml));
    }

    protected function getAttributes(\DOMDocument $xml)
    {

        $attributes = new ME\Character\Attributes(array());
        return $attributes;
    }

    protected function parseValues(\DOMDocument $xml)
    {
        $values = $this->parseSingularStats($xml);
        $values = array_merge($values, $this->parseCreationValues($xml));

        return $values;
    }

    protected function parseSingularStats(\DOMDocument $xml)
    {
        $map = array(
            'name' => 'CharacterName',
            'player' => 'Player',
            'characterization' => 'Characterization',
            'motivation' => 'Motivation',
        );

        $values = array();

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
        $map = array(
            'essence' => 'Essence',
            'willpower' => 'Willpower',
            'compassion' => 'Compassion',
            'conviction' => 'Conviction',
            'temperance' => 'Temperance',
            'valor' => 'Valor',
        );

        return $this->parseElementAttributes($xml, $map, 'creationValue');
    }

    protected function parseElementAttributes(\DOMDocument $xml, $map, $attribute)
    {
        $values = array();

        foreach ($map as $key => $tag) {
            $items = $xml->getElementsByTagName($tag);
            if ($items->length) {
                $values[$key] = $items->item(0)->getAttribute($attribute);
            }
        }

        return $values;
    }
}
