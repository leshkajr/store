<?php
$this->load->view('Header');
?>
<div>
	<form action="" class="form-registration" method="post">
		<div class="display-1" style="text-align: center">
			Registration
		</div>
		<div class="mb-3">
			<label for="login" class="form-label">Login</label>
			<input type="text" class="form-control" id="login" name="login" required value="<?php echo set_value('login') ?>">
			<div style="float:right; margin:-30.5px 10px 22px 0;"><?php echo form_error('login')?></div>
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required value="<?php echo set_value('email')?>">
			<div style="float:right; margin:-30.5px 10px 22px 0;"><?php echo form_error('email')?></div>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" name="password" class="form-control" id="password" required>
			<div style="float:right; margin:-30.5px 10px 22px 0;"><?php echo form_error('password','<div>', '</div>')?></div>
		</div>
		<div class="mb-3">
			<div style="overflow: hidden">
				<label for="repeat_password" class="form-label">Repeat password</label><div style="color:#ff4b4b; float:right"><?php echo form_error('repeat_password')?></div>
			</div>
			<input type="password" name="repeat_password" class="form-control" id="repeat_password" required>
		</div>
		<input type="submit" name="submit" value="Register" class="btn btn-color"/>
		<div class="back">
			<a href="<?php echo site_url("shop") ?>" class="btn btn-secondary btn-color">Back</a>
		</div>
	</form>
</div>

<?php
$this->load->view('Footer');
?>
