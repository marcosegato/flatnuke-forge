<?
$xml = simplexml_load_file($target_path."install.xml");
if (!($xml instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
$n2 = $xml->xpath('//install_configuration/pre_inst');
$pre = $n2[0];
if (!($pre instanceof SimpleXMLElement)) {
	fn_die("PLUGINBOX",_FNINST_NOTVALID,__FILE__,__LINE__);
}
$var=$pre->variable;
echo "<p><h2><b>".$pre->message."</b></h2></p>";
?>
<form action="index.php?mod=<?=$mod?>&op=check" method="post" name="form">
<?
foreach ($var as $el_var) {
	if (isset($error[''.$el_var->name])) {
		$highl=" <-- (" . $el_var->ErrorMessage . ")";
		$highl2="style=\"background-color:red;\"";
	}
	else {
		$highl="";
		$highl2="";
	}
	?>
	<p><legend for="<?=$el_var->name?>"><?=$el_var->title?></legend>
	<input type="text" name="<?=$el_var->name?>" value="<?=$el_var->default?>"><?=$highl?></p>
	<?
}
?>
<input type="submit" value="<?=_FNINST_NEXT?>"/>&nbsp;<input type="reset" value="<?=_FNINST_RESET?>"/>
</form>
