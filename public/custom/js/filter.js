
$(document).ready(function(){
  $(document).find('#btn-filter').click(function(e){
    e.preventDefault();
    var academic_year_id = $('#academic-year-id').val();
    var ward_id = $('#ward-id').val();
    var school_id = $('#school-id').val();

    $.ajax({
      url:"dashboard",
      method:'GET',
      data:{'academic_year_id' : academic_year_id,'ward_id':ward_id,'school_id':school_id},
      success:function (response){
        $(document).find('#replace-home-div').replaceWith(response);
      }
    });
  });

  $(document).find('#ward-id').change(function(e){
    e.preventDefault();
    var ward_id = $('#ward-id').val();
    $.ajax({
      url:'get-schools-by-ward',
      method:'GET',
      data:{ward_id : ward_id},
      success:function (response){
        $('#school-id').empty().append('<option value="">-- Select School --</option>');
        $.each(response.schools,function(k,v){
          $('#school-id').append($('<option>',{
            value:k,
            text:v
          }));
        });
      }
    });
  });
});