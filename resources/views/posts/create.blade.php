@extends('main')

@section('title','| create new post')


@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create new post</h1>
			<hr>
			{!! Form::open(['route' => 'posts.store']) !!}
				{{form::label('title','Title')}}
				{{form::text('title',null,array('class'=>'form-control'))}}  
				{{form::label('body',"Post Body:")}}
				{{form::textarea('body',null,array('class'=>'form-control'))}}
				{{form::submit('Post',array('class'=>'btn btn-success btn-lg btn-block','style' => 'margin top:20px;' ))}}  			
			{!! Form::close() !!}
		</div>
	</div>	
@endsection 

