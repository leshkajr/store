<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('Header');
?>
<div>
	<div class="d-flex flex-wrap">
		<?php
			echo form_open('admin/panel', array('class' => 'section full-width'));
			echo '<table class="table table-striped table-admin-add"><thead>
					<tr>
						<th>ID</th>
						<th>Category name</th>
						<th>Choose</th>
					</tr>
				</thead><tbody>';
			foreach($categories as $category){
				echo '<tr><td>'.$category['id'].'</td>
						<td>'.$category['categoryName'].'</td>
						<td><input type="checkbox" class="form-check-input"></td>
					</tr>';
			}
			echo '</tbody></table>';
			echo '<div class="d-flex group-on-panel">';
			echo form_input(array('type' => 'text', 'name' => 'category_input','placeholder' => 'Category','class'=>'form-control me-2'));
			echo form_submit(array('name' => 'category_submit', 'value' => 'Append', 'class' => 'button btn-color'));
			echo '</div>';
			echo form_close();


			echo form_open('admin/panel', array('class' => 'section full-width'));
//			echo "<select class='form-control' name='category_select'>";
//			foreach($categories as $category) {
//				echo "<option value='".$category['categoryId']."'>".$category['categoryName']."</option>";
//			}
//			echo "</select>";
			echo '<table class="table table-striped table-admin-add"><thead>
						<tr>
							<th>ID</th>
							<th>Category name</th>
							<th>Good name</th>
							<th>Price without sale</th>
							<th>Price</th>
							<th>Rate</th>
							<th>Action</th>
							<th>Add image</th>
							<th>Choose</th>
						</tr>
					</thead><tbody>';
			foreach($goods as $good){
				echo '<tr><td>'.$good['id'].'</td>
							<td>'.$good['categoryName'].'</td>
							<td>'.$good['itemName'].'</td>
							<td>'.$good['priceIn'].' ₴</td>
							<td>'.$good['priceSale'].' ₴</td>';
				echo '<td>';
				for($i = 0; $i < $good['rate']; $i++){
					echo '★';
				}
				echo '</td>';
				echo '		<td>'.$good['action'].'</td>
							<td><a href="'.site_url("admin/upload?id=".$good['id']."").'">Click</a></td>
							<td><input type="checkbox" class="form-check-input"></td>
						</tr>';
			}
			echo '</tbody></table>';
			echo '<div class="d-flex group-on-panel">';
			$options = array();
			foreach($categories as $category) {
				$options[''.$category['id'].''] = $category['categoryName'];
			}
			echo form_dropdown(array('name'=>'category_select','class'=>'form-select me-2','style'=>'width:50%'),$options);
			echo form_input(array('type' => 'text', 'name' => 'good_input','placeholder' => 'Name','class'=>'form-control me-2'));
			echo form_input(array('type' => 'number', 'name' => 'price_input','placeholder' => 'Price','class'=>'form-control me-2'));
			echo form_submit(array('name' => 'good_submit', 'value' => 'Append', 'class' => 'button btn-color'));
			echo '</div>';
			echo form_close();
		?>
	</div>
</div>

<?php
$this->load->view('Footer');
