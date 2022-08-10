<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}

  .film{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:20px;
    top:20px;
  }
  .pic img{
	max-width:50px;
  }
  
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">


  function bondTemplate(film){
    return `
            
            <div class="film">
            <b>Film</b>: ${film.Film}<br />
            <b>Title</b>: ${film.Title}<br />
            <b>ReleaseYear</b>: ${film.ReleaseYear}<br />
            <b>Director</b>:${film.Director}<br />
            <b>Award</b>:${film.Award}<br />
            <b>BoxOffice</b>:${film.BoxOffice}<br />
            <div class="pic"><img src="thumbnails/${film.Film }"/></div> 
  
    `;
  }
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

     //place data.title on page
     $("#filmtitle").html(data.title);

     //clear previous films
     $("#films").html("");

     $.each(data.films,function(i,item){
        let myData = bondTemplate(item);
        $("<div></div>").html(myData).appendTo("#films");
    });

        /*
     let myData = JSON.stringify(data,null,4);
      myData = "<pre>" + myData + ">/pre>";
      $("#output").html(myData);
     */
     $("#output").html(myData);
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 
</script>
</head>
	<body>
	<h1>Bond Web Service</h1>
		<a href="year" class="category">Tade's All The Time Favorite Films By Year</a><br />
		<a href="box" class="category">Tade's All The Time Favorite Films By International Box Office Totals</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">
		<div class="film">
            <b>Film</b>: Sample<br />
            <b>Title</b>: Dr. No<br />
            <b>Year</b>: 1962<br />
            <b>Director</b>:Terence Young<br />
            <b>Award</b>:Best Film<br />
            <b>BoxOffice</b>:$1,000,000.00<br />
            <div class="pic"><img src="thumbnails/dr-no.jpg"/></div>
    </div>
		</div>
		<div id="output">Results go here</div>
	</body>
</html>
