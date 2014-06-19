<?php
namespace Melindrea\Exalted\CharacterLoader;

use \Melindrea\Exalted as ME;

class Zip extends XML
{
    protected $character;

    public function __construct($path)
    {
        $this->character = $this->convertToCharacter($this->unpackFile($path));
    }

    protected function unpackFile($path)
    {
        if (! (is_file($path))) {
            throw new ME\Exceptions\FileException(
                sprintf('File: %s does not exist', $path)
            );
        }

        $archive = zip_open($path);

        if (! (is_resource($archive))) {
            throw new ME\Exceptions\ZipFileException(
                sprintf('Error opening %s', $path)
            );
        }

        $content = false;

        while ($entry = zip_read($archive)) {
            $extension = pathinfo(zip_entry_name($entry), PATHINFO_EXTENSION);

            // This finds the first ecg file, reads 3Mb and quits the loop
            if ($extension == 'ecg' || $extension == 'xml') {
                $content = zip_entry_read($entry, 30000);
                break;
            }
        }

        if (! $content) {
            throw new ME\Exceptions\ZipFileException(
                sprintf('Invalid archive %s', $path)
            );
        }

        $document = new \DOMDocument();

        if (@$document->loadXML($content) === false) {
            throw new ME\Exceptions\InvalidXMLException(
                sprintf('%s contains invalid XML-file', $path)
            );
        }

        return $document;
    }
}
