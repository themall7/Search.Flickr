@extends('layout.master')
@section('content')
<h2>{{ Config::get('custom.app.title') }}</h2>
<form id="frm_search">
	<span>
		<input type="text" id="keyword" name="keyword" value="" placeholder="Type a Keyword">
	</span>
	<button id="btn_search">Search</button>
</form>
<div id="image_list">
	
</div>
@stop
