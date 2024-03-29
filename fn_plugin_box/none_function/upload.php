<?
$target_path_up = $target_path . basename( $_FILES['uploadedfile']['name']);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path_up)) {
    	echo "<p>"._FNINST_UPLOADOK."</p>";
}
else fn_die("PLUGINBOX",_FNINST_UPLOADERROR,__FILE__,__LINE__);

$filename=basename( $_FILES['uploadedfile']['name']);
require_once("sections/$mod/none_function/pclzip.lib.php");
$archive = new PclZip($target_path.$filename);
if (($v_result_list = $archive->extract(PCLZIP_OPT_PATH, $target_path,PCLZIP_OPT_STOP_ON_ERROR, PCLZIP_OPT_REPLACE_NEWER)) == 0) {
		fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
	}

$xml = simplexml_load_file($target_path."install.xml");

if (!($xml instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
$n1 = $xml->xpath('//install_configuration/info');
$info = $n1[0];
if (!($info instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
echo "<h2>"._FNINST_EXTINFO."</h2>";
echo "<p><a href=\"" . $info->link . "\">" . $info->name . "</a>, (ver." . $info->version . ")</p>";

$tipo="";
if ($info->type=="block") $tipo=_FNINST_BLOCK;
if ($info->type=="section") $tipo=_FNINST_SECTION;
if ($info->type=="plugin") $tipo=_FNINST_PLUGIN;
if ($info->type=="theme") $tipo=_FNINST_THEME;
if ($info->type=="system_update") $tipo=_FNINST_SYSUPDATE;
if ($info->type=="other") $tipo=_FNINST_OTHER;
echo _FNINST_AUTHOR.": " . $info->author . "<br>";
echo _FNINST_EMAIL.": <a href=\"mailto:".$info->mail."\">" . $info->mail . "</a><br>";
echo _FNINST_DESCRIPTION.": <i>" . $info->description . "</i><br>";

if ($tipo=="") echo _FNINST_NOTVALID;
else {
	echo "<p>"._FNINST_TYPE.": $tipo</p>";
	echo "<p><a href=\"index.php?mod=$mod&op=pre\">"._FNINST_GOINSTALL."</a></p>";
}
?>
