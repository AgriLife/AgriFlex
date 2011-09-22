
	<h4>Details</h4>
	<p><label class="admin-form-label" for="job_number">Job Number</label>
	<input type="text" class="admin-form-input" id="job_number" name="_my_meta[job_number]" value="<?php if(!empty($meta['job_number'])) echo $meta['job_number']; ?>" placeholder="12345" size="25" /></p>
	
	<p><label class="admin-form-label" for="agency">Agency</label>
	<input type="text" class="admin-form-input" id="agency" name="_my_meta[agency]" value="<?php if(!empty($meta['agency'])) echo $meta['agency']; ?>"placeholder="Montana WildLife Federation" size="25" /></p>	

	<p><label class="admin-form-label" for="location">Location</label>
	<input type="text" class="admin-form-input" id="location" name="_my_meta[location]" value="<?php if(!empty($meta['location'])) echo $meta['location']; ?>" placeholder="Austin, Texas" size="25" /></p>
	
	<p><label class="admin-form-label" for="salary">Salary</label>
	<input type="text" class="admin-form-input" id="salary" name="_my_meta[salary]" value="<?php if(!empty($meta['salary'])) echo $meta['salary']; ?>" placeholder="$50,000" size="25" /></p>

	<p><label class="admin-form-label" for="apply-date">Last Date to Apply</label>
	<input type="text" class="admin-form-input" id="apply-date" name="_my_meta[apply-date]" value="<?php if(!empty($meta['apply-date'])) echo $meta['apply-date']; ?>" placeholder="October 3, 2012" size="25" /></p>	
	
	<p><label class="admin-form-label" for="description">Job Description</label>
	<textarea class="admin-form-input" id="description" name="_my_meta[description]" cols="65" rows="8"><?php if(!empty($meta['description'])) echo $meta['description']; ?></textarea></p>

	<p><label class="admin-form-label" for="qualifications">Qualifications</label>
	<textarea class="admin-form-input" id="qualifications" name="_my_meta[qualifications]" cols="65" rows="8"><?php if(!empty($meta['qualifications'])) echo $meta['qualifications']; ?></textarea></p>
	
	<h4>Contact</h4>
	<p><label class="admin-form-label" for="contact-name">Contact Name</label>
	<input type="text" class="admin-form-input" id="contact-name" name="_my_meta[contact-name]" value="<?php if(!empty($meta['contact-name'])) echo $meta['contact-name']; ?>" placeholder="Jane Doe" size="25" /></p>
	
	<p><label class="admin-form-label" for="email">Contact eMail</label>
	<input type="text" class="admin-form-input" id="contact-email" name="_my_meta[contact-email]" value="<?php if(!empty($meta['contact-email'])) echo $meta['contact-email']; ?>"placeholder="janedoe@montanacompany.com" size="25" /></p>	

	<p><label class="admin-form-label" for="phone">Contact Phone</label>
	<input type="text" class="admin-form-input" id="contact-phone" name="_my_meta[contact-phone]" value="<?php if(!empty($meta['contact-phone'])) echo $meta['contact-phone']; ?>" placeholder="777-777-7777" size="25" /></p>	