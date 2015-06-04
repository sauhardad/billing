$(function () { 
    var cache = {};    
    
    //autocomplete for searching for student
    $( "#search_student" ).autocomplete({
            minLength: 2,
            source: function( request, response ) {
                    var term = request.term;
                    if ( term in cache ) {
                            response( cache[ term ] );
                            return;
                    }

                    $.getJSON( "student/search", request, function( data, status, xhr ) {
                            cache[ term ] = data;
                            response( data );
                    });
            }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      var appendString="";
      appendString+="<a href='"+base_url+"student/view/"+ item.id +"'><img class='search-picture'";
      if(item.photo=="")
          appendString+=" src='"+ base_url+"assets/img/search-img.png'" +" />";
      else
          appendString+=" src='"+ base_url+"assets/img/user_uploads/"+ item.photo +"' />";
      appendString+="&nbsp;" + item.student_name+"</a>";
      return $( "<li>" )
        .append( appendString )
        .appendTo( ul );
    };
});    