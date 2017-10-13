@extends('default.layout.layout') 

@section('navbar')
	@parent
@endsection('navbar')

@section('main')
	@parent
@endsection('main')

@section('sidebar')
	@parent
	
	<div class = "sidebar-module">
	<h4>About</h4>
	<p>Текст текст текст</p>
	</div>
@endsection('sidebar')

@section('content')
		@include('default.content')
@endsection