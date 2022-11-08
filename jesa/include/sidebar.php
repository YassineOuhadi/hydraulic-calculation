<?php
$result=$ManagerProjet->fct_find_by_id($account->idCompte);
$projets= $result->fetchAll();
$total=count($projets);
?>
<section id="sidebar">
		<a href="#" class="brand"><img  src="images/jesa%20maroc.png" id="icon"></a>
		<ul class="side-menu">
			<li>
            <a href="../projets/index.php" class="active"><i class='bx bxs-dashboard icon' style="color:white;"></i> 
            <?php echo $account->username;?></a></li>
            <div id="leftscroll" oncontextmenu="return true;">
            <?php
            $i=0;
            foreach($projets as $row){
           
            ?>
            <li style="direction:ltr;" id="li_projet<?php echo $row['id_projet']; ?>" 
                <?php if($id_projet==$row['id_projet']){ ?>class="active"<?php ;}; ?>
            >
                <a href="../projets/index.php?projet=<?php echo $row['id_projet']; ?>" id="projet<?php echo $i; ?>">
                <input type="hidden" value="<?php echo $row['titre_projet']; ?>" id="name">
                <input type="hidden" value="<?php echo $row['id_projet']; ?>" id="id">
                <i class='bx bx-folder-open icon'></i>
                <div id="projet_name"><?php echo $row['titre_projet']; ?></div>
                <input type="text" value="<?php echo $row['titre_projet']; ?>" id="rename" required>
                </a>
            </li>
             <?php ;$i=$i+1;}; ?>
            </div>
		</ul>
</section>
