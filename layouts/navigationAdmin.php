
<nav>
     <a class="logo"  href="index"> Club de lecture</a>
    <ul>
        <li><a class="<?php if($page === "home") echo $active; else echo ""; ?>" href="index">Acceuil</a></li>
        <li><a class="<?php if($page === "member-list") echo $active; else echo ""; ?>" href="listeMembre">Liste des membres</a></li>
        <li><a class="<?php if($page === "association-list") echo $active; else echo ""; ?>" href="listeAssociation">Liste des associations</a></li>
        <li ><a href="../deconnexion">Déconnexion</a></li>
    </ul>
</nav>

