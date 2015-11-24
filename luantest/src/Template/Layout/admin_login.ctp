<!DOCTYPE html>
<html lang="en">
	<head>
	    <?= $this->Html->charset() ?>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	    <title>Login Page</title>
	    <?= $this->Html->meta('icon') ?>
	
	    <?= $this->Html->css('base.css') ?>
	    <?= $this->Html->css('cake.css') ?>
	
	    <?= $this->fetch('meta') ?>
	    <?= $this->fetch('css') ?>
	    <?= $this->fetch('script') ?>

		<?php
		//Add Css
		echo $this->Html->css ( 'bootstrap.min' );
		echo $this->Html->css ( 'font-awesome.min' );
		echo $this->Html->css ( 'fonts.googleapis.com' );
		echo $this->Html->css ( 'ace.min.css' );
		echo $this->Html->css ( 'ace-rtl.min' );
		
		//Add script
		echo $this->Html->script ( 'jquery.2.1.1.min.js' );
		echo $this->Html->script ( 'jquery.min.js' );
		echo $this->Html->script ( 'jquery.mobile.custom.min.js' );
		
		?>
	<style type="text/css" class="init">
		.row{
			 margin-left: auto;
   			 margin-right: auto;
		}
		.green{
			color:#69aa46!important;
		}
		.fa {
		    display: inline-block;
		    font: normal normal normal 14px/1 FontAwesome;
		    font-size: inherit;
		    text-rendering: auto;
		    -webkit-font-smoothing: antialiased;
		 }
		 .input-icon.input-icon-right>input{
		 	height: 40px;
		 }
	</style>
	</head>
	<body class="login-layout light-login">
	<?= $this->Flash->render() ?>
		<div class="main-container">
					<?= $this->fetch('content') ?>
		</div><!-- /.main-container -->


		<!-- inline scripts related to this page -->
		
	</body>
</html>