<?php /** @version $Id: view.style.php 996 2011-08-29 14:22:48Z lexx-ua $ */ ?>
<?php $config = $this->config('style');?>
<form method="POST">
<?php include 'inc.submit-buttons.php';?>
<fieldset>
  <legend>Custom CSS Settings</legend>
  <ul class="thethe-settings-list">
    <li>
      <label for="data-customcss">Custom CSS:</label>
      <textarea style="width:200px;height:260px;" name="data[custom-css]" id="data-customcss"><?php print htmlspecialchars(stripslashes($config['custom-css']));?></textarea>
	</li>
  </ul>
</fieldset>
<?php include 'inc.submit-buttons.php';?>
</form>