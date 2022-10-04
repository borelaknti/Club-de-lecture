<nav>
	<a class="logo <?php if($page === "home") echo $active; else echo ""; ?>" href="index"> Club de lecture </a> 
	<ul>
		<li><a class="<?php if($page === "inscription") echo $active; else echo ""; ?>" href="inscription"> S'inscrire</a></li>
		<li><a class="<?php if($page === "connexion") echo $active; else echo ""; ?>" href="connexion"> connexion </a></li>
	</ul>
</nav>

