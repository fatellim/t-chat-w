<?php $this->layout('layout', ['title' => 'Message de mon salon'])?>

<?php $this->start('main_content') ?>

<!-- Ici on a uniquement $salon et $messages à notre disposition  -->

<h2>Bienvenue sur le salon "<?= $this->e($salon['nom']); ?>"</h2>
<ol class="messages">
   
   <?php $this->insert('salons/inc.messages',['messages'=>$messages]) ;?>
    
    
</ol>

<!-- J'envoie mon formulaire d'ajout de message sur la page courante
cela va me permettre d'ajouter mes messages à ce salon précisément.
-->

<?php if($w_user){ ?>


<form class="form-message" action="<?php $this->url('view_salon', array('id'=>$salon['id'])) ?>" method="POST">
    <input type="text" name="message" /><input type="submit" class="button" name="send" value="Envoyer"/>
</form>


<?php } ?>


<?php $this->stop('main_content') ?>

<?php $this->start('javascript') ?>

<script type="text/javascript" src="<?php echo $this->assetUrl('js/prepare-chat.js'); ?>"></script>
<script type="text/javascript">
	
var salonId = <?php  echo $salon['id'] ; ?> ;
var homeUrl = '<?php echo $this->url('default_home'); ?>';

$(document).ready(function(){

	setInterval(function(){

		var lastMessageId = $('.messages > li:last-child').data('id') || 0;

/*		$('input[name="message"]').on('input', function(){
			$.get(homeUrl+'writing/'+salonId, [], function(data){

				//Bidule est entrain d'écrire

			});//

		});//*/

		$.get(homeUrl+'newmessages/'+salonId+'/'+lastMessageId,[], function(data){

			if($('<div>'+data+'</div>').find('li').length > 0) {
				$('.messages').append(data).scrollTop($('.messages').height());
			}
		});

	}, 500);//fin intervalle


});//Fin dom



</script>

<?php $this->stop('javascript') ?>

