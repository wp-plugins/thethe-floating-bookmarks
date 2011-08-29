<?php /** @version $Id: view.settings.php 996 2011-08-29 14:22:48Z lexx-ua $ */ ?>
<?php $config = $this->config();?>
<form method="post" action="">
<?php include 'inc.submit-buttons.php';?>
<fieldset>
<legend>Social Settings:</legend>
<ul class="thethe-settings-list">
	<li>
		<label for="data-twitter-username">Twitter Username:</label>
		<input name="data[twitter-username]" id="data-twitter-username" class="str-field" value="<?php print $config['twitter-username'];?>" type="text">
		<span class="tooltip">?<span>Enter your Twitter username.</span>
	</li>
</ul>
</fieldset>
	<fieldset>
		<legend>Position Settings</legend>
<ul class="thethe-settings-list">
	<li>
		<label for="data-position-align">Position Align:</label>
		<select id="data-position-align" name="data[position-align]" class="str-field">
<?php
	foreach ($position = array(
		'left' => 'Left page edge',
		'right' => 'right page edge',
		//'top' => 'Top page edge',
		//'bottom' => 'Bottom page edge',
	) as $k=>$v) {
		$selected = '';
		if ($k == $config['position-align']) {
			$selected = 'selected';
		}
		echo "<option {$selected} value='{$k}'>{$v}</option>";
	}
?>
      </select>
      <span class="tooltip">?<span>Specify the position of your floating bookmarks box.</span>
      </li>
	<li>
		<label for="data-position-indent">Position Indent:</label>
		<select id="data-position-indent" name="data[position-indent]" class="str-field">
<?php
	foreach ($position = array(
		'33' => '1/3 of window',
		'50' => '1/2 of window',
		'25' => '1/4 of window',
		'start' => 'start of window',
		'end' => 'end of window',
	) as $k=>$v) {
		$selected = '';
		if ($k == $config['position-indent']) {
			$selected = 'selected';
		}
		echo "<option {$selected} value='{$k}'>{$v}</option>";
	}
?>
      </select>
      <span class="tooltip">?<span>Select vertical position of  the box.</span>
      </li>

</ul>
</fieldset>
<fieldset>
		<legend>Style Settings</legend>
<ul class="thethe-settings-list">
	<li>
		<label for="data-bg-color">Background Color:</label>
		<input name="data[bg-color]" id="data-bg-color" class="pickcolor" value="<?php print $config['bg-color'];?>" type="text">
		<span class="tooltip">?<span>Enter the background color code for your box.</span>
	</li>
	<li>
		<label for="data-border-width">Border Width:</label>
		<input name="data[border-width]" id="data-border-width" maxlength="1" value="<?php print $config['border-width'];?>" type="text">&nbsp;&nbsp;px
		<span class="tooltip">?<span>Enter the border thickness in pixels for your box.</span>
	</li>
	<li>
		<label for="data-border-color">Border Color:</label>
		<input name="data[border-color]" id="data-border-color" class="pickcolor" value="<?php print $config['border-color'];?>" type="text">
		<span class="tooltip">?<span>Enter the border color code.</span>
	</li>
	<li>
		<label for="data-border-radius">Border Radius:</label>
		<input name="data[border-radius]" id="data-border-radius" value="<?php print $config['border-radius'];?>" type="text">&nbsp;&nbsp;px
		<span class="tooltip">?<span>Enter the border radius in pixels.</span>
	</li>
    <li>
      <label for="data-back-link"> Linkback to Developer: </label>
      <input type="hidden" name="data[backLink]" value=0 />            
      <input name="data[backLink]" id="data-back-link" type="checkbox" value=1 <?php echo $config['backLink'] ? 'checked' : '';?> />
      <span class="tooltip">?<span>Check this box to display a backlink to the plugin home page.</span></span> </li>      
    
</ul>
</fieldset>
<?php include 'inc.submit-buttons.php';?>
</form>