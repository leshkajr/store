<?php
function fill_nav($items,$action_page,$roleId){
	foreach($items as $item){
		if($item['forAdmin'] === false){
			?>
			<li class="nav-item">
				<a class="nav-link<?php if($action_page === $item['title']) echo " active"; ?>" aria-current="page" href="<?php echo site_url($item['path'])?>"><?php echo $item['title'] ?></a>
			</li>
			<?php
		}
		else{
			if($roleId == 1){
				?>
				<li class="nav-item">
					<a class="nav-link<?php if($action_page === $item['title']) echo " active"; ?>" aria-current="page" href="<?php echo site_url($item['path'])?>"><?php echo $item['title'] ?></a>
				</li>
				<?php
			}
		}
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php if(isset($title)){ echo $title;}else{ echo "Store";}?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="../../contents/css/style.css">
</head>
<body class="body">

<div class="header">
	<ul class="nav nav-pills">
		<?php
		fill_nav(array(
			array('title'=>'Catalog','path'=>"shop/catalog",'forAdmin'=>false),
			array('title'=>'Cart','path'=>'shop/cart','forAdmin'=>false),
			array('title'=>'Reports','path'=>'reports','forAdmin'=>false),
			array('title'=>'Admin','path'=>'admin/panel','forAdmin'=>true)
		),$action_page,$this->session->userdata('roleId'));
		?>
	</ul>
	<form class="form-item" method="post" action="">
		<?php

		if(isset($_POST['exit'])){
			unset($_SESSION['roleId'],$_SESSION['customerId'],$_SESSION['login']);
			header("Location: ".$_SERVER['REQUEST_URI']);
		}

		if($this->session->has_userdata('login')){
			?>
			<a class="nav-link" style="margin: 7px 10px 0 0"><?php echo $this->session->userdata('login'); ?></a>
			<input class="btn btn-secondary me-2 btn-exit" type="submit" name="exit" value="Exit"/>
			<?php
		}
		else{
			?>
			<input class="form-control me-2 btn-outline-secondary input-authorization" type="text" name="login" placeholder="Login" aria-label="Login">
			<input class="form-control me-2 btn-outline-secondary input-authorization" type="password" name="password" placeholder="Password" aria-label="Password">
			<input class="btn btn-outline-secondary me-2 btn-enter" type="submit" name="authorization" value="LogIn"/>
			<a class="btn btn-secondary me-2 btn-registration" href="<?php if(isset($_GET['id'])){ echo site_url("/registration");}else{ echo "/registration";} ?>">Registration</a>
			<?php
		}

		?>
	</form>
</div>
<div class="content">
