<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function placement_price($price){
	$priceStr = strrev($price);
	$priceStrCount = strlen($priceStr);
	$price = "";
	for($i = 0; $i < $priceStrCount; $i++) {
		if($i % 3 === 0){
			$price .= " ";
		}
		$price .= $priceStr[$i];
	}
	return strrev($price);
}
$this->load->view('Header');
echo "<div>";
echo form_open("shop/catalog",array('class' => 'd-flex m-2 mb-2','role' => 'search'));
if(isset($search)){
	echo form_input(array('type' => 'search', 'name' => 'search_input', 'class' => 'form-control me-2','placeholder' => 'Search','value' => $search));
}
else
	echo form_input(array('type' => 'search', 'name' => 'search_input', 'class' => 'form-control me-2','placeholder' => 'Search'));
echo form_submit(array('name' => 'search_submit','class' => 'btn btn-secondary btn-exit'),"Search");
echo form_close();
echo "</div>";
?>
<div class="d-flex flex-wrap goods">
<?php
	foreach ($goods as $good){
		echo '<div class="good">
				<div class="good-contain-img"><img class="good-img" src="../../'.$good['imagepath'].'"></div>
				<div class="good-name">'.$good['itemName'].'</div>';
		echo '<div class="good-rate">';
		for($i = 0; $i < $good['rate']; $i++) {
			echo '★';
		}
		echo '</div>';
		$priceIn = placement_price($good['priceIn']);
		if($good['priceIn'] === $good['priceSale']){
			echo '<div class="good-priceIn">'.$priceIn.' ₴</div>';
		}
		else{
			$priceSale = placement_price($good['priceSale']);
			echo '<div class="good-priceIn crossed">'.$priceIn.' ₴</div>';
			echo '<div class="good-priceSale">'.$priceSale.' ₴</div>';
		}

		echo '</div>';

	}
?>
</div>
<?php
$this->load->view('Footer');
