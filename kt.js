$(document).ready(function(){
  $('.service-link').click(function(e){
      e.preventDefault();  
      $('.kt-description').hide();  
      $('.service-link').removeClass('active');  
      $($(this).attr('href')).show();  
      $(this).addClass('active');  
  });
});