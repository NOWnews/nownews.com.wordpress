<?php

	require 'config.php';

	/**
	 * Returns the properly prefixed environment url
	 * @return the url
	 */
	function get_media_server_url() {
		global $config;
		return $config["env_urls"][$config["env"]];
	}
	/**
	 * Assembles the embed_opts for the request
	 * @param $color The color to be passed in embed_opts
	 * @return the embed_opts for the query
	 */
	function get_embed_opts($color) {
		global $config;
		return array(
			"color" => $color
		) + $config["embed_opts"];
	}

	/**
	 * Gets the url of the current page
	 * @return the current page url
	 */
	function get_current_url() {
		return set_url_scheme('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	}

	/**
	 * Assembles the query params for the request
	 * @param  $embed_opts	the embedOpts used for the query
	 * @return the query params for the request
	 */
	function get_query_params($embed_opts) {
		global $config;
		$params = array(
			"u" => get_current_url(),
			"embed" => json_encode($embed_opts),
			"maxContentItems" => $config["max_docs"],
			"hasImage" => "true"
		);
		if ($config["site_restriction"] != '') {
			$params["site"] = $config["site_restriction"];
			$params["minContentScore"] = 0.0;
			$params["contentCollections"] = "Primal Web";
		} else {
			$params["contentSources"] = "Primal";
			$params["type"] = "NewsArticle,VideoObject";
		}
		
		return $params;
	}

	/**
	 * Assembles the full url used in the iframe
	 * @param  $color The requested highlight color
	 * @return the url to be used in the iframe
	 */
	function build_embed_url($color) {
		global $config;
		$embed_opts = get_embed_opts($color);
		$params = get_query_params($embed_opts);
		return get_media_server_url() . "?" . http_build_query($params);
	}

	/**
	 * Ensures a unique id is given to each iframe we have on the page
	 * @return the id for the requesting iframe
	 */
	function get_iframe_id() {
		static $iframe_id_count = 0;
		$iframe_id = 'primal_id' . $iframe_id_count;
		$iframe_id_count++;
		return $iframe_id;
	}

	/**
	 * Determines the url for the plugin settings page
	 * @return the url to access the settings page
	 */
	function get_primal_settings_url() {
		global $config;
		return urlencode($config["top_settings_menu"]) . "?page=" . urlencode($config["settings_page"]);
	}

	/** Handles printing the error message if external links are not enabled */
	function external_links_error() {?>
		<div>
			<p>
				Error: The Primal plugin relies on providing external links.
				Please enable external links in the <a href= <?php echo get_admin_url() . get_primal_settings_url() ?>>Primal Settings page</a>
				to make the widget visible.
			</p>
		</div></br><?php
	}

	/**
	 * Adds the iframe to the page and initiates the resizing call
	 * @param  $embed_url  the src for the iframe
	 * @param  $iframe_id  The unique iframe id
	 */
	function show_primal_content($embed_url, $iframe_id) {?>
		<div class="primalWidget">
			<div class="primalHeader">
				<div class="primalRec">Recommended for you </div>
				<a class="headerLink" href="<?php echo plugins_url('', __FILE__); ?>"><?php showPoweredByPrimal(); ?></a>
			</div>
			<?php
				echo '<iframe src=' . "$embed_url" . ' id=' . "$iframe_id" . ' class="primalIframe" width="100%" height="300" frameborder=0 scrolling="no"></iframe>'; 
			?>
			<div class="primalFooter">
				<a class="footerLink" href="<?php echo plugins_url('', __FILE__); ?>"><?php showPoweredByPrimal(); ?></a>
			</div>
		</div>
		<script type="text/javascript">
			PF.Resize.resize('<?php echo $iframe_id; ?>');
		</script>
		<?php
	}

	/** Adds "powered by Primal" text and logo to the page */
	function showPoweredByPrimal() {?>
		<div class="primalLogoText">Powered by </div>
		<div class="primalLogo"><img src="<?php echo plugins_url('img/primal_logo.jpg', __FILE__); ?>"></div>
		<?php
	}
?>
