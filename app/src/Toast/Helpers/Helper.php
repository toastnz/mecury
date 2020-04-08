<?php

namespace Toast\Helpers;

use SilverStripe\Security\Security;
use SilverStripe\Security\Permission;


class Helper 
{

    static function getDirContents($dir, &$results = []) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != '.' && $value != '..') {
                self::getDirContents($path, $results);
                $results[] = $path;
            }
        }    
        return $results;
    }    


    static function getTemplates()
    {
        $cwd = getcwd();
        $themeFolder = 'themes/mercury';
        $themesPath = $cwd . '/' . $themeFolder . '/templates';
        $list = self::getDirContents($themesPath);
        $output = [];
        foreach($list as $each) {
            if (strstr($each, '.ss')) {
                $key = str_replace($cwd, '', $each);
                $output[$key] = str_replace($cwd . '/', '', $each);
            }
        }
        return $output;
    }

    static function isSuperAdmin()
    {
        return (Security::getCurrentUser()->ID == 1) && Permission::check('ADMIN');
    }


}