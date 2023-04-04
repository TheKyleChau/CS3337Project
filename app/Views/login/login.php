<?php
$session = session();
$errors = array()
?>
<?php if(!empty($session->get('errors'))) {
  $errors = $session->get('errors');?>
  <?php  if (!empty($errors)) : ?>
    <div class="error">
    	<?php foreach ($errors as $error) : ?>
    	  <p><?php echo $error ?></p>
    	<?php endforeach ?>
    </div>
  <?php  endif ?>
<?php } ?>
<?php $session->remove('errors'); ?>
<!DOCTYPE html>
<html>
<head>
	<style><?php include 'styles.css'; ?></style>
	<div class="flex-container"></div>
	<div class="content-container"></div>
  <title>Registration System</title>
</head>
<body>
  <div class="header">
  	<h1>Login</h1>
	<br>
  </div>
  <div class="theme-toggle">
    <h2></h2>
    <label class="switch">
      <input type="checkbox" onclick="switchTheme()">
      <span class="slider"></span>
    </label>
  </div>

  <form method="post" action="/login/login">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register">Sign up</a>
  	</p>
  </form>
}
</body>
</html>
