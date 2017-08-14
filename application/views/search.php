 <section id="pageContent">
 	<div class="divCenter innerContent" style="border-top: 1px solid #ccc;">

      <div class="newsWraper">
      <h2>Search results for &quot;<?php echo $q; ?>&quot;</h2>
      <div id="content"></div>
		<script>
          function hndlr(response) {
			  if(response.items.length > 0){
				document.getElementById("content").innerHTML = "<ul>";
				  for (var i = 0; i < response.items.length; i++) {
					var item = response.items[i];
					console.log(item);
					// in production code, item.htmlTitle should have the HTML entities escaped.
					/*document.getElementById("content").innerHTML += '<li><aside><h4><a href="'+item.link+'" target="_blank"><p><strong>'+item.title+'</strong></p></a></h4><div class="contentHolder"><p>'+item.snippet+'</p></div><a class="readMore" href="'+item.link+'" target="_blank">Read more</a></aside></li>';*/
					document.getElementById("content").innerHTML += '<li><aside><h4>'+item.title+'</h4><div class="contentHolder"><p>'+item.snippet+'</p></div></aside></li>';
				  }
				  document.getElementById("content").innerHTML +"</ul>";
			  }
			  else{
				 document.getElementById("content").innerHTML = "<p><strong>Sorry, there is no result found.</strong></p>";
			  }
          }
        </script>
        <script src="https://www.googleapis.com/customsearch/v1?key=<?php echo $API_KEY;?>&amp;cx=013067804737023364260:auq07fabebo&amp;q=<?php echo $q;?>&amp;callback=hndlr">
        </script>
  
      <div class="clearFix"></div>

    </div>

    <br clear="all"/>

    <div class="clearFix"></div>

  </section>
