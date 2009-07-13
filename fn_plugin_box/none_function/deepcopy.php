<?
function copyr($source, $dest){
	// Simple copy for a file
	if (is_file($source)) {
		$c = copy($source, $dest);
		chmod($dest, 0777);
		return $c;
	}
	// Make destination directory
	if (!is_dir($dest)) {
		$oldumask = umask(0);
		mkdir($dest, 0777);
		umask($oldumask);
	}
	 
	// Loop through the folder
	$dir = dir($source);
	while (false !== $entry = $dir->read()) {
		// Skip pointers
		if ($entry == "." || $entry == "..") {
			continue;
		}
		// Deep copy directories
		if ($dest !== "$source/$entry") {
			copyr("$source/$entry", "$dest/$entry");
		}
	}
	 
	// Clean up
	$dir->close();
	return true;
}
?>
