<div class="col-md-9">
{{ isset($bvar) ? $bvar : $title }}
{{ $bvar or $title }}	

@if(count($data) < 3)	
	В массиве меньше 3 элементов
@elseif(count($data)>10)
В массиве больше 10 элементов
@else
	В массиве больше 3 элементов
@endif


<ul>
@for($i=0;$i<count($dataI);$i++)
	<li>{{ $dataI[$i] }}</li>
	
@endfor	
</ul>

<ul>
@foreach($dataI as $k=>$velue)
	<li>{{ $k.'=>'.$velue }}</li>
@endforeach	
</ul>

<ul>
@forelse($data as $k=>$velue)
	<li>{{ $k.'=>'.$velue }}</li>
	
	@empty
	<p>No items</p>
@endforelse	
</ul>
@while (FALSE)
	<p>I'm looping forever</p>

@endwhile

@each('default.list',$dataI,'value')


@datetime('lol')



		
			<div class="col-md-6">
			  <h2>Heading</h2>
			  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
		   </div>
			<div class="col-md-6">
			  <h2>Heading</h2>
			  <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
			  <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
			</div>
			
			 <div class="blog-post">
            <h2 class="blog-post-title">Sample blog post</h2>
            <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>

            <p>This blog post shows a few different types of content that's supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
            <hr>
            <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
            <blockquote>
              <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </blockquote>
			
			
			
		</div>
       </div>