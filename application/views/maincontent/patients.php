<div class="row mt-3">
	<div class="col-md-12 bg-white px-md-5 py-md-5 ml-auto">
		<h6> Add Patient using Web URL</h6>
		<form action="<?php base_url(); ?>Patient/addPatients" method="post">
			<div class="form-group">
		    	<label for="referral_details">WEB URL</label>
		    	<input type="text" name="web_url" id="web_url"  class="form-control" placeholder="Please Put Your Web URL" value="">
	 		</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>