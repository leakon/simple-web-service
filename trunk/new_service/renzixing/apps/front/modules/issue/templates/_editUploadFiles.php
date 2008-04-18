

<tr valign="top">
	<td>文件上传</td>
	<td>

	<div id="uploadFiles">
<?php

?>
	</div>

<?php

	echo form_error('mime_types_error');
	echo form_error('max_size_error');
#	echo input_file_tag("file");
for ($i = 0; $i < 5; $i++) {
	echo input_file_tag("file[$i]");
	echo '<br />';
}

?>

	</td>

</tr>
