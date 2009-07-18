<?
//[ToDo = Esiste qualcosa di simile su Fn?]
//cancella ricorsivamente una cartella ed i file contenuti
function delete_directory($dirname) {
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
            else
                delete_directory($dirname.'/'.$file);          
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}
//[ToDo = Vanno riportate le sole notifiche di errore]
$res=delete_directory($target_path);
if ($res) {
	echo "<p style=\"background-color: green;\">"._FNINST_CLEANOK."</p>";
}
else {
	echo "<p style=\"background-color: red;\">"._FNINST_CLEANERROR."</p>";
}

$res=mkdir($target_path);
if ($res) {
	echo "<p style=\"background-color: green;\">"._FNINST_TEMPOK."</p>";
}
else {
	echo "<p style=\"background-color: red;\">"._FNINST_TEMPERROR."</p>";
}
?>
