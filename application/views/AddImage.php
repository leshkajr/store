<?php
//$this->load->view('Header');
//echo '<div class="display-1 m-3">Upload image for '.$good->itemName.'</div>';
//echo form_open_multipart('admin/upload',array('class'=>'m-3'));
//echo "<div class='mb-3'>";
//echo form_label("Выберите изображение", "photo", array("class"=>"col-form-label col-3 offset-1"));
//echo form_upload(array("name"=>"photo", "id"=>"photo", "class"=>"form-control mb-2 me-2"),'multiple');
//echo form_submit(array("name"=>"sbtBtn", "class"=>"btn btn-color col-2" ),"Upload");
//echo "</div>";
//echo form_close();
//$this->load->view('Footer');
//

$this->load->view('Header');
echo '<div class="display-1 m-3">Upload image for '.$good->itemName.'</div>';
if (!empty($error)) {
	echo '<div class="push-notification" style="color:red;">';
	var_dump($error);
	echo '<ul>';
	foreach ($error as $item => $value) {
		echo '<li>'.$value.'</li>';
	}
	echo '</div>';
	echo '</ul>';
}
if (!empty($success)) {
	echo '<div class="push-notification" style="color:green;">';
	echo '<ul style="margin:0;">';
	foreach ($success as $item => $value) {
		echo '<li>'.$value.'</li>';
	}
	echo '</div>';
	echo '</ul>';
}
$st['class']='form-upload';
echo form_open_multipart($_SERVER['REQUEST_URI'],$st);
echo '<div class="col-md-offset-3">';
echo form_label('Select image','image',array("class"=>"col-form-label",'style'=>"font-size:20px; margin-left:10px;font-weight:500; color:dimgray"));

echo form_upload(array('name'=>'upfile[]',"class"=>"form-control mb-2 me-2"),'','multiple required');

echo form_submit(array('name'=>'send','value'=>'Upload',
	'class'=>'btn btn-color col-2'));
echo '</div>';
echo form_close();
$this->load->view('Footer');

