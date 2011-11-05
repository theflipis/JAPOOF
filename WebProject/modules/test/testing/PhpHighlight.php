<?php

namespace modules\test\testing;
use lib\Module\AbstractModule as AbstractModule;
use lib\Colorizer\PHPColorizer as PHPColor;

class PhpHighlight extends AbstractModule
{
    public function __construct()
    {
        
    }
    
    public function render($onlyHTML = false)
    {
        $data = file_get_contents($this->_aPreferences["FILE_TO_PARSE"]);        
        $color = new PHPColor();
        $color->setCode($data);
        $color->setTitle($files[$i]);
        $color->setDivSurround("code", "code");
        $color->surroundEachCode(true);
        $color->colorize();
        if($onlyHTML == true)
        {
            parent::renderHTML($color->getAllCode());
        }
        else
        {
            parent::render($color->getAllCode());
        }
    }
    
    public function renderHTML()
    {
        $this->render(true);
    }
}