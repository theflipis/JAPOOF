<?php

namespace lib\FileSystem;

class FileSystemTool
{
	public static function getFiles($dir, $aExtensions = array())
	{
		$aReturn = array();
		$merge_extensions = false;
		for($i=0;$i<count($aExtensions);$i++)
		{			
			if(strpos($aExtensions[$i], ".") !== false)
			{
				$merge_extensions = true;
				break;	//We found it, no need for more iteration
			}
		}	
		self::readFilesFromDir($dir, $aExtensions, $aReturn, $merge_extensions);
		return $aReturn;
	}
	
	
	private static function readFilesFromDir($dir, $aExtensions, &$aReturn, $merge_extensions = false)
	{		
		$dirAnalyze = dir($dir);
		while(false !== ($entry = $dirAnalyze->read()))
		{
			if($entry != "." && $entry != "..")
			{	
				if(is_dir($dir."/".$entry))
				{
					self::readFilesFromDir($dir."/".$entry, $aExtensions, $aReturn, $merge_extensions);
				}
				else
				{		
					if(count($aExtensions) > 0)
					{
						$tokenBroken = explode(".", $entry);
						if(count($tokenBroken) == 1)	//Files without extension, we might want to capture them as well
						{
							$tokenBroken[1] = "";							
						}						
						
						//For the in_array() below to work, $tokenBroken must be a two-element array, filename and extension (merged, if required)
						if($merge_extensions === true)
						{
							if(count($tokenBroken) > 2)
							{
								self::remakeExtension($tokenBroken);
							}
						}
						
						if(!in_array($tokenBroken[1], $aExtensions))	//We look at the 
						{
							continue;
						}
					}			
					$aReturn[] = $dir."/".$entry;
				}
			}			
		}
		$dirAnalyze->close();	
	}
	
	private static function remakeExtension(&$tokenBroken)
	{
		$newExt = "";		
		for($i=1;$i<count($tokenBroken);$i++)
		{
			if($i == 1)
			{
				$newExt .= $tokenBroken[$i];
			}
			else
			{
				$newExt .= ".".$tokenBroken[$i];
			}
		}								
		array_splice($tokenBroken, 1, (count($tokenBroken) - 1), $newExt);		
	}	
}
