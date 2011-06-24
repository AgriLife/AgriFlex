<?php
	
// 	STOP! DO NOT MODIFY THIS FILE!
//	If you wish to customize the output, you can safely do so by COPYING this file
//	into a new folder called 'gigpress-templates' in your 'wp-content' directory
//	and then making your changes there. When in place, that file will load in place of this one.

// This template displays all of our individual show data in the main shows listing (upcoming and past).
// It's marked-up in hCalendar format, so fuck-around with caution.
// See http://microformats.org/wiki/hcalendar for specs

//	If you're curious what all variables are available in the $showdata array,
//	have a look at the docs: http://gigpress.com/docs/

?>

<tbody class="vevent">
	
	<tr class="gigpress-row <?php echo $class; ?>">
	
		<td class="gigpress-date">
			<abbr class="dtstart" title="<?php echo $showdata['iso_date']; ?>"><?php echo $showdata['date']; ?></abbr>
		<?php if($showdata['end_date']) : ?>
			- <abbr class="dtend" title="<?php echo $showdata['iso_end_date']; ?>">
				<?php echo $showdata['end_date']; ?>
			</abbr>
		<?php endif; ?>
		</td>
		
	<?php if((!$artist && $group_artists == 'no') && $total_artists > 1) : ?>
		<td class="gigpress-artist">
			<?php echo $showdata['artist']; ?>
		</td>
	<?php endif; ?>
	
		<td class="gigpress-city summary">
			<span class="hide"><?php echo $showdata['artist']; ?> <?php _e("in", "gigpress"); ?> </span>
			<?php echo $showdata['city']; ?>
		</td>
		
		<td class="gigpress-venue location<?php if($venue) : ?> hide<?php endif; ?>"><?php echo $showdata['venue']; ?></td>
		
	<?php if($gpo['display_country'] == 1) : ?>
		<td class="gigpress-country"><?php echo $showdata['country']; ?></td>
	<?php endif; ?>
	
	</tr>
	
	<tr class="gigpress-info <?php echo $class; ?>">
	
		<td class="gigpress-links-cell">
			<?php
			// Only show these links if this show is in the future
			if($scope != 'past') : ?>
			<div class="gigpress-calendar-add">
				<a class="gigpress-links-toggle" href="#calendar-links-<?php echo $showdata['id']; ?>">Add</a>
				<div class="gigpress-calendar-links" id="calendar-links-<?php echo $showdata['id']; ?>">
					<div class="gigpress-calendar-links-inner">
						<span><?php echo $showdata['gcal']; ?></span>
						<span><?php echo $showdata['ical']; ?></span>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</td>
		
		<td colspan="<?php echo $cols - 1; ?>" class="description">
		
			<?php if($showdata['time']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Time", "gigpress"); ?>:</span> <?php echo $showdata['time']; ?>.</span>
			<?php endif; ?>
			
			<?php if($showdata['price']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Admission", "gigpress"); ?>:</span> <?php echo $showdata['price']; ?>.</span>
			<?php endif; ?>
			
			<?php if($showdata['admittance']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Age restrictions", "gigpress"); ?>:</span> <?php echo $showdata['admittance']; ?>.</span>
			<?php endif; ?>
			
			<?php if($showdata['ticket_phone']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Box office", "gigpress"); ?>:</span> <?php echo $showdata['ticket_phone']; ?>.</span>
			<?php endif; ?>
			
			<?php if($showdata['address']) : ?> 
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Address", "gigpress"); ?>:</span> <?php echo $showdata['address']; ?>.</span>
			<?php endif; ?>
			
			<?php if($showdata['venue_phone']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Venue phone", "gigpress"); ?>:</span> <?php echo $showdata['venue_phone']; ?>.</span>
			<?php endif; ?>				
			
			<?php if($showdata['notes']) : ?>
				<span class="gigpress-info-item"><?php echo $showdata['notes']; ?></span>
			<?php endif; ?>
			
			<?php if($showdata['related_link'] && $gpo['relatedlink_notes'] == 1) : ?>
				<span class="gigpress-info-item"><?php echo $showdata['related_link']; ?></span> 
			<?php endif; ?>
			
			<?php if($showdata['ticket_link']) : ?>
				<span class="gigpress-info-item"><?php echo $showdata['ticket_link']; ?></span>
			<?php endif; ?>
					
		
		</td>
	
	</tr>
</tbody>	