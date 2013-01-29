// Hooks up the FlexSlider and FitVids configs
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
          controlsContainer: ".flex-container",
    animationDuration: 300     
    });
  $("#tabs-1,.entry-content").fitVids();
});
