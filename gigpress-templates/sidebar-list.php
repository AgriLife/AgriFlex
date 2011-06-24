<?php
	
// This modified template displays all of our individual show data in the sidebar.
// It's marked-up in hCalendar format, so fuck-around with caution.
// See http://microformats.org/wiki/hcalendar for specs

//	If you're curious what all variables are available in the $showdata array,
//	have a look at the docs: http://gigpress.com/docs/

?>

<dl>
<dt class="vevent <?php echo $class; ?>">
	<span class="gigpress-sidebar-date">
		<abbr class="dtstart" title="<?php echo $showdata['iso_date']; ?>"><?php echo $showdata['date']; ?></abbr>
	</span>
</dt>	
	<dd class="summary title-loc">
		<h4 class="gigpress-sidebar-notes"><?php echo $showdata['artist']; ?></h4> 
		<span class="gigpress-sidebar-city"><?php echo $showdata['city']; ?></span> 
	<span class="gigpress-sidebar-prep"><?php _e("at", "gigpress"); ?></span> 
	<span class="location gigpress-sidebar-venue"><?php echo $showdata['venue']; ?></span>
	</dd>	 
	<?php if($showdata['ticket_link']) : ?>
		<dd class="gigpress-sidebar-status sign-up btn"><?php echo $showdata['ticket_link']; ?></dd>
	<?php endif; ?>
</dl>
