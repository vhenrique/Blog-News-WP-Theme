<?php
	
	//store traffic source in COOKIE
	function bae_store_trafficsource() {
		if($_GET["si"]){
			$value = $_GET["si"];
			setcookie("subsrc", $value, time()+3600, '/', '.baedaily.com'); 
		}

	};
	bae_store_trafficsource();

	function bae_adsense() {
		$i = ($_GET["si"] ? $_GET["si"] : $_COOKIE["subsrc"]) ;


		switch ($i) {
	    case ((is_numeric($i))&& ($i>1)) :
	        ?>
	        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- OB -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-4262169081023754"
			     data-ad-slot="8601820828"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

	        <?php 
	        break;
	    case "RvCnt":
	        ?>
	        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- RC -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-4262169081023754"
			     data-ad-slot="7125087620"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

	        <?php 
	        break;
	    case "fc":
	        ?>
	        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- FB -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-4262169081023754"
			     data-ad-slot="1759441221"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

	        <?php 
	        break;    
	    default:
	    	?>
	        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Genreal Responsive Ad -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-4262169081023754"
			     data-ad-slot="8335129228"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

	        <?php 
	        break;
		}
	}

?>