<?php

/**
 * /application/core/MY_Loader.php
 *
 */
class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE) {

		$content  = $this->view('include/header_top', $vars, $return );
	        $content .= $this->view('include/header', $vars, $return );
		$content .= $this->view('include/navigation.php', $vars, $return);
    $content .= $this->view('include/rightbar.php', $vars, $return );
	  $content .= $this->view($template_name, $vars, $return );
		$content .= $this->view ( 'include/footer', $vars, $return );

		if ($return) {
			return $content;
		}
	}
}
