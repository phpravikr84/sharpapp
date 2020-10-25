<?php 	if(isset($common['headerhtml'])) :
		echo $common['headerhtml'];
		endif;
?>
	<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post" action="login/Auth">
                    <h1>SHARP ULTRASOUND</h1>
                    <p class="text-muted"> Please enter your login and password!</p>
                    <input type="text" name="username" placeholder="Username" value="">
                    <input type="password" name="password" placeholder="Password" value="">
                   <input type="submit" name="" value="Login" href="#">
                  
                </form>
            </div>
        </div>
    </div>
</div>
	
<?php 	if(isset($common['footerhtml'])) :
			echo $common['footerhtml'];
		endif;
?>