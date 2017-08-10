$(function(){
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });
  // $(document).bind('contextmenu', function(e){
  //   e.preventDefault();
    
  // })
});