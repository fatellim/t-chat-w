    <?php  foreach ($messages as $message) : ?>

		<!-- Pour les requetes ajax, j'ai besoin de l'id du dernier message.
		     Ici je fais en sorte que l'information soit portée par tous mes messages -->

    <li data-id="<?php echo $message['id']; ?>">

    	<span class="avatar"><img src="<?php echo $this->assetUrl('uploads/'.$message['avatar']); ?>" alt=""></span>
	    <span class="personne"><?= $this->e($message['pseudo']);?> : </span>
	    <span class="message"><?= $this->e($message['corps']);?></span>


    </li>

    <?php endforeach ; ?>