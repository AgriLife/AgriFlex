/*
 * For Admin Image Uploder
 *
 */
 
jQuery(document).ready(function() {

// Add image uploader for AgriLife options header/logo
jQuery('#upload_image_button').click(function() {
 formfield = jQuery('#upload_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#upload_image').val(imgurl);
 tb_remove();
}




/**************** Begin Extension Sub-options ***************/
// Reveal Extension sub-site options for Extension-only sites
// Check that box will expand correctly on 
// page load
if (jQuery('#isExtension_yes').is(':checked') && 
 	jQuery('#isResearch_no').is(':checked') &&
 	jQuery('#isCollege_no').is(':checked') &&
 	jQuery('#isTvmdl_no').is(':checked')) {	       
  jQuery('#extension_type').show();
} else {
  jQuery('#extension_type').hide();
}

// Check that box will expand correctly on user clicking
// if multi-agency, then don't expand the exension sub-options
jQuery('#isExtension_yes').click(function() {
  if(jQuery('#isResearch_no').is(':checked') && 
      jQuery('#isCollege_no').is(':checked') &&
      jQuery('#isTvmdl_no').is(':checked')){
 	    jQuery('#extension_type').show('fast');
  }
  return true;
});
// If user checks 'no' for an agency and Extension is selected
// then expand sub-options
jQuery('#isResearch_no').click(function() {
  if(jQuery('#isExtension_yes').is(':checked') && 
      jQuery('#isCollege_no').is(':checked') &&
      jQuery('#isTvmdl_no').is(':checked')){
 	    jQuery('#extension_type').show('fast');
  }
  return true;
});
jQuery('#isCollege_no').click(function() {
  if(jQuery('#isExtension_yes').is(':checked') && 
      jQuery('#isResearch_no').is(':checked') &&
      jQuery('#isTvmdl_no').is(':checked')){
 	    jQuery('#extension_type').show('fast');
  }
  return true;
});
jQuery('#isTvmdl_no').click(function() {
  if(jQuery('#isExtension_yes').is(':checked') && 
      jQuery('#isResearch_no').is(':checked') &&
      jQuery('#isCollege_no').is(':checked')){
 	    jQuery('#extension_type').show('fast');
  }
  return true;
});

// Close Extension sub-options if an additional agency is selected
jQuery('#isResearch_yes').click(function() {
  jQuery('#extension_type').hide('fast');
  return true;
});
jQuery('#isTvmdl_yes').click(function() {
  jQuery('#extension_type').hide('fast');
  return true;
});
jQuery('#isCollege_yes').click(function() {
  jQuery('#extension_type').hide('fast');
  return true;
});

// Close Extension sub-options if extension unchecked
jQuery('#isExtension_no').click(function() {
  jQuery('#extension_type').hide('fast');
  return true;
});
/**************** End Extension Sub-options ***************/


});


