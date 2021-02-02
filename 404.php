<?php if (!isset($_SESSION)) {session_start();}; echo $_SESSION['id-user']?>
<a href="Application/session/redirect-auth">Back Home</a>