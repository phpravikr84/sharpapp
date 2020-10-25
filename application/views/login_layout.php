<?php 	if(isset($common['headerHtml'])) :
			echo $common['headerHtml'];
		endif;
?>
	<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
               <?php 	if(isset($common['contentHtml'])) :
               				echo $common['contentHtml'];
               			endif;
               ?>
            </div>
        </div>
    </div>
</div>
	
<?php 	if(isset($common['footerHtml'])) :
			echo $common['footerHtml'];
		endif;
?>