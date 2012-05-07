<h4>Details</h4>
	<p><label class="admin-form-label" for="job_number">Job Number</label>
	<input type="text" class="admin-form-input" id="job_number" name="job_number" value="<?php if(!empty($job_number)) echo $job_number; ?>" placeholder="12345" size="25" /></p>
	
	<p><label class="admin-form-label" for="agency">Agency</label>
	<input type="text" class="admin-form-input" id="agency" name="agency" value="<?php if(!empty($agency)) echo $agency; ?>"placeholder="Montana WildLife Federation" size="25" /></p>	

	<p><label class="admin-form-label" for="location">Location</label>
	<input type="text" class="admin-form-input" id="location" name="location" value="<?php if(!empty($location)) echo $location; ?>" placeholder="Austin, Texas" size="25" /></p>
	
	<p><label class="admin-form-label" for="website">Website</label>
	<input type="text" class="admin-form-input" id="website" name="website" value="<?php if(!empty($website)) echo $website; ?>" placeholder="http://agrilife.org" size="25" /></p>
	
	<p><label class="admin-form-label" for="salary">Salary</label>
	<input type="text" class="admin-form-input" id="salary" name="salary" value="<?php if(!empty($salary)) echo $salary; ?>" placeholder="$50,000" size="25" /></p>

	<p><label class="admin-form-label" for="apply_date">Last Date to Apply</label>
	<input type="text" class="admin-form-input" id="apply-date" name="apply_date" value="<?php if(!empty($apply_date)) echo $apply_date; ?>" placeholder="October 3, 2013" size="25" /></p>
	
	<p><label class="admin-form-label" for="start_date">Start Date</label>
	<input type="text" class="admin-form-input" id="start-date" name="start_date" value="<?php if(!empty($start_date)) echo $start_date; ?>" placeholder="October 15, 2013" size="25" /></p>	
	
	<p><label class="admin-form-label" for="description">Job Description</label>
	<textarea class="admin-form-input" id="description" name="description" cols="65" rows="8"><?php if(!empty($description)) echo $description; ?></textarea></p>

	<p><label class="admin-form-label" for="qualifications">Qualifications</label>
	<textarea class="admin-form-input" id="qualifications" name="qualifications" cols="65" rows="8"><?php if(!empty($qualifications)) echo $qualifications; ?></textarea></p>
	
	<h4>Contact</h4>
	<p><label class="admin-form-label" for="contact-name">Contact Name</label>
	<input type="text" class="admin-form-input" id="contact-name" name="contact_name" value="<?php if(!empty($contact_name)) echo $contact_name; ?>" placeholder="Jane Doe" size="25" /></p>
	
	<p><label class="admin-form-label" for="email">Contact eMail</label>
	<input type="text" class="admin-form-input" id="contact-email" name="contact_email" value="<?php if(!empty($contact_email)) echo $contact_email; ?>"placeholder="janedoe@montanacompany.com" size="25" /></p>	

	<p><label class="admin-form-label" for="phone">Contact Phone</label>
	<input type="text" class="admin-form-input" id="contact-phone" name="contact_phone" value="<?php if(!empty($contact_phone)) echo $contact_phone; ?>" placeholder="777-777-7777" size="25" /></p>	 