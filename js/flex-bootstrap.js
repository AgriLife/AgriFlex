// Hooks up the FitVids configs
jQuery(window).load(function() {
  jQuery(".entry-content").fitVids();
});
// Restores the jQuery curCSS method since it was removed in version 1.8
jQuery.curCSS = function(element, prop, val) {
    return jQuery(element).css(prop, val);
};
