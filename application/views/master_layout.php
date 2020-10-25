<?php 	if(isset($common['headerHtml'])) :
			echo $common['headerHtml'];
		endif;
?>
 <?php 	if(isset($common['navHtml'])) :
	               				echo $common['navHtml'];
	               			endif;
	               ?>
	<div class="container">

	         
	               <?php 	if(isset($common['contentHtml'])) :
	               				echo $common['contentHtml'];
	               			endif;
	               ?>

	</div>
	
<?php 	if(isset($common['footerHtml'])) :
			echo $common['footerHtml'];
		endif;
?>