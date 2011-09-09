
	<h4>Details</h4>
	<label for="job_number">Job Number</label>
	<input type="text" id="job_number" name="_my_meta[job_number]" value="<?php if(!empty($meta['job_number'])) echo $meta['job_number']; ?>" placeholder="12345" size="25" />
	
	<label for="agency">Agency</label>
	<input type="text" id="agency" name="_my_meta[agency]" value="<?php if(!empty($meta['agency'])) echo $meta['agency']; ?>"placeholder="Montana WildLife Federation" size="25" />	

	<label for="location">Location</label>
	<input type="text" id="location" name="_my_meta[location]" value="<?php if(!empty($meta['location'])) echo $meta['location']; ?>" placeholder="Austin, Texas" size="25" />
