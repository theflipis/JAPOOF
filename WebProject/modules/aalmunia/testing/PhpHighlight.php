<?php

namespace modules\aalmunia\testing;
use lib\Module\AbstractModule as AbstractModule;
use lib\Colorizer\PHPColorizer as PHPColor;

class PhpHighlight extends AbstractModule
{
    public function __construct()
    {
        
    }
    
    public function render()
    {
        $data = file_get_contents($this->_aPreferences["FILE_TO_PARSE"]);        
        $color = new PHPColor();
        $color->setCode($data);
        $color->setTitle($files[$i]);
        $color->setDivSurround("code", "code");
        $color->surroundEachCode(true);
        $color->colorize();
        //var_dump($color);
        //echo $color->getAllCode();
    }
}