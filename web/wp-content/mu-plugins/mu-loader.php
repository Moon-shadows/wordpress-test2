<?php
// Check for folder that contain php files with the same name and load them!
$folders = scandir(__DIR__);

foreach ($folders as $folderName)
{
	$folderPath = __DIR__ . '/' . $folderName;
	$potentialMuPluginFile = $folderPath . '/' . $folderName . '.php';

	if ( ! in_array($folderName, array('.', '..')) && is_dir($folderPath) && file_exists($potentialMuPluginFile) )
	{
		require $potentialMuPluginFile;
	}
}