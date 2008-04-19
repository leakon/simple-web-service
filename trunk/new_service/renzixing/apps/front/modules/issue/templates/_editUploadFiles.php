<?php

$actName	= $sf_context->getActionName();

$isEditMode	= ($actName == 'create') || ($actName == 'edit' && $issue->getUserId() == $sf_user->getId());


?>
<tr valign="top">
	<td>文件上传</td>
	<td>

	<div id="uploadFiles">

<ul class="uploadFiles">


<?php
$arrFiles	= $issue->getUploadFiles();
if (count($arrFiles)) {

	$uploadDir	= 'uploads/' . $issue->getBaseId() . '/';

	$baseId		= $issue->getBaseId();

	$arrImage	= array('gif', 'jpg', 'jpeg', 'png');

	// 保存的时候就已经编码过了
	foreach ($arrFiles->getRawValue() as $encodedFileName) {

		$decodedFilename	= urldecode($encodedFileName);

		preg_match("/.*\.([^\.]+)$/i", $decodedFilename, $match);
		$extName		= strtolower($match[1]);

		$isImage		= in_array($extName, $arrImage);

		echo	'<li>';

		if ($isEditMode) {
			$id	= md5($encodedFileName);
			echo	sprintf('<input type="checkbox" name="delete_files[]" value="%s" id="%s" /><label for="%s">删除</label> ',
						$encodedFileName,
						$id,
						$id
						);
		}

		$fileUrl	= $isImage ? '/' . $uploadDir . $encodedFileName :
					url_for(sprintf('issue/down?baseid=%s&filename=%s', $baseId, urlencode($encodedFileName)));

		echo	sprintf('<a href="%s" target="_blank">%s</a></li>', $fileUrl, urldecode($encodedFileName));

		echo	'</li>';
	}

}
?>

</ul>

<?php if ($isEditMode) : ?>



<script type="text/javascript">

var objTheForm = $('the_form');
var fileIndex = 1;

function FileEvent(o, sid) {

	this.bind = function() {
		ShowInputFileName(o, sid);
	}

}

function AddNewFile() {

	var idFileIndex = 'id_file_index_' + fileIndex++;

	var objUL = document.getElementById('formInputFile');
	var objList = document.createElement('li');

	var inputFile = document.createElement('input');

	inputFile.setAttribute('type', 'file');
	inputFile.setAttribute('name', 'file[]');
	inputFile.setAttribute('onchange', "ShowInputFileName(this, '" + idFileIndex + "')");

	try {

		var fileOnEvent = new FileEvent(inputFile, idFileIndex);
		inputFile.attachEvent("onchange", fileOnEvent.bind);


	} catch(e) {

	}


	objList.appendChild(inputFile);

	var textNode = document.createElement('span');
	textNode.setAttribute('id', idFileIndex);
	objList.appendChild(textNode);


	setTimeout(function(){objUL.appendChild(objList)}, 10);


}

function ShowInputFileName(o, sid) {


	var filePath = o.value;
	var arrFile = filePath.split("\\");

	var fileName = '';

	if (arrFile.length) {
		fileName = arrFile[arrFile.length - 1];
	}

	if (fileName.length) {

		setTimeout( function() {
			var textNode = document.getElementById(sid);
			textNode.innerHTML = fileName;
		}, 10);
	}

}

</script>

	<input type="button" onclick="AddNewFile()" value="增加附件" />

<ul id="formInputFile">

</ul>


<?php endif ?>



	</div>


	</td>

</tr>
