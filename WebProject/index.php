<?php
use lib\FrontController\WebPage as Page;
use lib\Bootstrap\ClassAutoLoader as Loader;
use lib\Colorizer\HTMLColorizer as HTMLColor;
use lib\Colorizer\PHPColorizer as PHPColor;
use lib\XML as XML;
use lib\DataAdapter\FileSystemDataAdapter as FSDA;
use lib\MetaHTML\MetaHTMLParser as MHTMLP;
use lib\FileSystem\FileSystemTool as FSTool;
use lib\Reflection\Reflector as Reflector;


//print_r($_REQUEST);
//passthru("pwd");

if(!array_key_exists("RELOAD", $_REQUEST))
{

//@TODO: Reescribir .htaccess. Quizás crear algún script propio de recarga de módulos,
//independiente del FrontController

?>
<html>
<style>
code
{
	font-family: "Courier New";
	font-size: 10pt;
	font-weight: 800;	
}
.code
{
	background-color: #EEEEEE;
	width: 80%;
	margin-left: auto;
	margin-right: auto;	
	white-space: normal;
}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/Class-0.0.2.js"></script>
<script type="text/javascript" src="js/Module.js"></script>
<script type="text/javascript">
var modManager = new Module;
</script>
<?php 
$now = microtime();

include_once("lib/Bootstrap/ClassAutoLoader.php");
Loader::register();

$fst = new FSTool();
$files = $fst->getFiles("/home/alejandro/JAPOOF", array("php", "class.php", "php", "html"));


$moduleDef = "";
for($i=0;$i<count($files);$i++)
{
    $moduleDef .= "<modules:test:testing:PhpHighlight>{\"FILE_TO_PARSE\" : \"".$files[$i]."\"}</modules:test:testing:PhpHighlight>";
}

$parser = new MHTMLP();
$modules = $parser->parseText($moduleDef, 0);

for($i=0;$i<count($modules);$i++)
{    
	$modules[$i]->render();
	echo "<div onClick=\"javascript:modManager.reload('0_".$i."', '0_".$i."', prefs_0_".$i.")\";><a href=\"#\">TEST RELOAD MODULE</a></div>";
}

echo "</pre>";
echo $now;
echo "<br/>";
echo microtime() - $now;

?>
</html>
<?php
}
else
{
    include_once("lib/Bootstrap/ClassAutoLoader.php");
    Loader::register();    
    $parser = new MHTMLP();
	/*$params = json_encode($_REQUEST);
	echo "<pre>";	
	echo $params["METATAGS"];
	die();*/
    $moduleDef = "<".$_REQUEST["METATAGS"].">".json_encode($_REQUEST)."</".$_REQUEST["METATAGS"].">";
    $module = $parser->parseText($moduleDef, 0);
    $module[0]->render();
}
?>