<?php
namespace Melindrea\Exalted\CharacterLoader;

use \Melindrea\Exalted as ME;

class Zip extends XML
{
    protected $character;

    public function __construct($path)
    {
        $this->character = $this->createCharacter($this->unpackFile($path));
    }

    protected function unpackFile($path)
    {
        if (! (is_file($path))) {
            throw new ME\Exceptions\FileException(sprintf('File: %s does not exist', $path));
        }
        return new \DOMDocument();
        // return $this->loadDocument(sprintf('zip:/%s#ExaltedCharacter/LastWish.ecg', $path));
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
}
