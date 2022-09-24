<?php
echo '<ul class="list">';
foreach ($customers as $customer){
	echo '<li>';
	foreach ($customer as $v){
		echo "$v ";
	}
	echo '</li>';
}
echo '</ul>';
