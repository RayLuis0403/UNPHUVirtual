<?php

include("../metodos/engine.php");


session_destroy();

//header("location:../");

?>
<html>
	<script  type="text/javascript">
		localStorage.clear();
		sessionStorage.clear();
		window.location = '../';	
	</script>
</html>