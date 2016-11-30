<!--Exceptionnellement, on n'inscrit pas la vue dans un layout car elle  s'execute  dans un context AJAX. Je n'ai donc pas besoin que de la partie qui m'intéresse, à savoir la liste des nouveaux messages.  -->

<?php $this->insert('salons/inc.messages',['messages'=>$messages]);?>