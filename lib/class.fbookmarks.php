<?php
/**
 * @version		$Id: class.fbookmarks.php 992 2011-08-29 12:55:43Z xagero $
 * @author		xagero
 */
class PluginFbookmarks extends PluginAbstract
{
	// }}}
	// {{{ init

	/**
	 * (non-PHPdoc)
	 * @see PluginAbstract::init()
	 */
	public function init()
	{
		parent::init();
		$this->viewIndexAll = array(
			'overview' => array(
				'title-tab' => 'Overview',
				'title' => $this->_config['meta']['Name'] . '&nbsp;Overview'
			),
			'settings' => array(
				'title-tab' => 'Settings',
				'title' => $this->_config['meta']['Name'] . '&nbsp;Settings'
			),
			'style' => array(
				'title-tab' => 'Custom CSS',
				'title' => $this->_config['meta']['Name'] . '&nbsp;Custom CSS'
			),
			/*
			'help' => array(
				'title-tab' => 'Help',
				'title' => $this->_config['meta']['Name'] . '&nbsp;Help',
				'file' => 'inc.contextual-help.php'
			)
			*/
		);
	} // end func init
	
	// }}}
	// {{{ _hook_wp_head
	
	/**
	 * (non-PHPdoc)
	 * @see PluginAbstract::_hook_wp_head()
	 */
	public function _hook_wp_head()
	{
		$config = $this->config('style');
		if ($config['custom-css']) {
			echo '<!-- TheThe Floating Bookmarks v.' . $this->_config['meta']['Version'] . ' Custom CSS begin //-->' . chr(10);
			echo '<style type="text/css" media="screen">' . chr(10);
			echo stripslashes_deep($config['custom-css']) . chr(10);
			echo '</style>' . chr(10);
			echo '<!-- TheThe Floating Bookmarks Custom CSS end //-->' . chr(10);
		}
	} // end func _hook_wp_head
	
	// }}}
	// {{{ _hook_wp_head
	
	/**
	 * (non-PHPdoc)
	 * @see PluginAbstract::_hook_wp_enqueue_scripts()
	 */
	public function _hook_wp_enqueue_scripts()
	{
		wp_enqueue_style('thethe-floating-bookmarks',
			$this->_config['meta']['wp_plugin_dir_url'] . 'style/css/fbookmarks.css'
		);
		wp_enqueue_script('jquery');
		wp_enqueue_script('thethe-floating-bookmarks',
			$this->_config['meta']['wp_plugin_dir_url'] . 'style/js/jquery.fbookmarks.js',
			array('jquery')
		);
		wp_enqueue_script('google-plusone','https://apis.google.com/js/plusone.js');
	} // end func _hook_wp_head
	
	// }}}
	// {{{ _hook_wp_footer
	
	/**
	 * (non-PHPdoc)
	 * @see PluginAbstract::_hook_wp_footer()
	 */
	public function _hook_wp_footer()
	{
		if( is_singular() ) {
			$url = get_permalink();
			$text = the_title('', '', false);
		} else if ( is_category() || is_tag() ) {
			if(is_category() ) {
			$cat = get_query_var('cat');
			$url = get_category_link($cat);
		} else {
			$tag = get_query_var('tag_id');
			$url = get_tag_link($tag);
		}
			$text = single_cat_title('', false) . ' on ' . get_bloginfo('name');
		} else {
			$url = get_bloginfo('url');
			$text = get_bloginfo('name') . ' - ' . get_bloginfo('description');
		}
		$config = $this->config();
		$style = 'style="';
		$position = '';
		$positionAlign = $config['position-align'];
		switch ($positionAlign){
			case 'left':
				$position .= 'left:0;';
				$positionIndent = 'top';
				$divMargin = 'margin-top:-110px;';
				break;
			case 'right':
				$position .= 'right:0;';
				$positionIndent = 'top';
				$divMargin = 'margin-top:-110px;';
				break;
			case 'top':
				$position .= 'top:0;';
				$positionIndent = 'left';
				$divMargin = 'margin-left:-34px;';
				break;
			case 'bottom':
				$position .= 'bottom:0;';
				$positionIndent = 'left';
				$divMargin = 'margin-left:-34px;';
				break;				
		}
		$positionIndent .= ':'.$config['position-indent'].'%;';
		switch ($config['position-indent']){
			case 'start':
				if ($positionAlign == 'left' || $positionAlign == 'right'){
					$positionIndent = 'top:0;';
				} else {
					$positionIndent = 'left:0;';
				}
				break;				
			case 'end':
				if ($positionAlign == 'top' || $positionAlign == 'bottom'){
					$positionIndent = 'right:0;';
				} else {
					$positionIndent = 'bottom:0;';
				}
				break;				
			default:
				$positionIndent .= $divMargin;
				break;
				
		}
		$position .= $positionIndent;
		$style .= $position;
		$style .= 'border:'.$config['border-width'].'px solid '.$config['border-color'].';';
		$style .= '-webkit-border-radius: '.$config['border-radius'].'px;-moz-border-radius: '.$config['border-radius'].'px;border-radius: '.$config['border-radius'].'px;';
		$style .= '"';
		$backLink = $config['backLink'] ? '<a class="thethe-backlink" href="http://thethefly.com/wp-plugins/thethe-floating-bookmarks/" title="Powered by TheThe Floating Bookmarks WordPress Plugin" target="_blank">?</a>' : '';
		$xTemplate = '
<div id="social-float" '.$style.'>
<div class="social-float-inner" style="background-color:'.$config['bg-color'].';">
	<div class="sf-twitter">
		<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="' . $config['twitter-username'] . '" data-url="'.$url.'" data-text="'.$text.'">Tweet</a>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	</div>
 
	<div class="sf-facebook">
		<iframe src="http://www.facebook.com/plugins/like.php?app_id=186708408052490&amp;href='.urlencode($url).'&amp;send=false&amp;layout=box_count&amp;width=50&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:62px;" allowTransparency="true"></iframe>
	</div>
 
	<div class="sf-plusone">
		<g:plusone size="tall" href="'.$url.'"></g:plusone>
	</div>'.$backLink.'
</div>
</div>';		
		print $xTemplate;
	}
	
	// }}}
	// {{{ _settingsView
	
	/**
	 * Function _settingsView
	 */
	public function _settingsView()
	{
		if (isset($_POST['data']) && isset($_POST['submit'])) {
			$dataValid = $this->_settingsValidate($_POST['data']);
			if ($dataValid) {
				update_option('_ttf-' . $this->_config['shortname'], $dataValid);
			}
		} elseif (isset($_POST['reset'])) {
			update_option('_ttf-' . $this->_config['shortname'],$this->_config['options']['default']);
		}

		return parent::_defaultView();
	} // end func _settingsView
	
	// }}}
	// {{{ _settingsValidate
	
	/**
	 * Function _settingsValidate
	 * @param array $data
	 */
	public function _settingsValidate($data)
	{
		if (!is_array($data)) return false;
		foreach (($dataValid = array(
				'position-align' => null,
				'position-indent' => null,
				'bg-color' => null,
				'border-width' => null,
				'border-color' => null,
				'border-radius' => null,
				'twitter-username' => null,
				'backLink' => null
			)
		) as $k=>$v ) {
			if (!isset($data[$k])) return false;
			$dataValid[$k] = trim($data[$k]);
		}
		
		$dataValid['border-width'] = absint($dataValid['border-width']);
		$dataValid['border-radius'] = absint($dataValid['border-radius']);
		
		return $dataValid;
	} // end func _settingsValidate
	
	// }}}
	// {{{ _styleView
	
	/**
	 * Function _styleView
	 */
	public function _styleView()
	{
		if (isset($_POST['data']) && isset($_POST['submit'])) {
			$dataValid = $this->_styleValidate($_POST['data']);
			if ($dataValid) {
				update_option(
					'_ttf-' . $this->_config['shortname'] . '-style',$dataValid
				);
			}
		} elseif (isset($_POST['reset'])) {
			update_option(
				'_ttf-' . $this->_config['shortname'] . '-style',
				$this->_config['options']['style']
			);
		}
		
		return parent::_defaultView();
	} // end func _settingsView
	
	// }}}
	// {{{ _styleValidate
	
	/**
	 * Function _styleValidate
	 * @param array $data
	 */
	public function _styleValidate($data)
	{
		if (!is_array($data)) return false;
		foreach (($dataValid = array(
				'custom-css' => null
			)
		) as $k=>$v ) {
			if (!isset($data[$k])) return false;
			$dataValid[$k] = trim($data[$k]);
		}
		
		return $dataValid;
	} // end func _settingsValidate
	
	// }}}
} // end func PluginAffiliates