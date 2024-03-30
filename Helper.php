<?php

declare(strict_types=1);

namespace Recipes;

class Helper
{
    public static function entry($directory)
    {
        $results = self::scanDirectory($directory);
        self::addFiles($results);
    }

    private static function scanDirectory($directory): array
    {
        $results = [];
        $entries = scandir( $directory );
        foreach( $entries as $key => $entry ) {
            if ( !in_array( $entry, array(".","..") ) ) {
                if ( is_dir( $directory . DIRECTORY_SEPARATOR . $entry ) ) {
                    $results[$entry] = self::scanDirectory( $directory . $entry . DIRECTORY_SEPARATOR );
                } else {
                    $results[] = $directory . $entry;
                }
            }
        }
        return $results;
    }

    private static function addFiles($files): void
    {
        foreach($files as $key => $file) {

            if ( is_array($file) ) {
                self::addFiles ( $file );
            } else {
                include_once $file;
            }
        }
    }

}