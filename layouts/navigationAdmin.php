
<nav>
     <a class="logo <?php if($page === "home") echo $active; else echo ""; ?>"  href="index"> Club de lecture</a>
    <ul>
        <li><a class="<?php if($page === "member-list") echo $active; else echo ""; ?>" href="membre">Liste des membres</a></li>
        <li ><a href="../deconnexion">Déconnexion</a></li>
    </ul>
</nav>

