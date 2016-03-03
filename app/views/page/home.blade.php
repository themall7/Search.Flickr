@extends('layout.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h2 class="text-center">{{ Config::get('custom.app.title') }}</h2>
		<div class="text-center">
			<form id="frm_search">
				<span class="form-group">
					<select class="form-control" id="keyword" name="keyword[]" placeholder="Type a Keyword" multiple>
					</select>
					<!--<input type="text" id="keyword" name="keyword" value="" placeholder="Type a Keyword">-->
				</span>
				<input type="hidden" id="page" name="page" value="1">
				<button type="button" class="btn btn-default" id="btn_search">Search</button>
			</form>
		</div>
		<p></p>
		<div id="image_list">
		</div>
	</div>
	<div id="bottom">11</div>
</div>
@stop
