<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ Config::get("custom.app.title") }}</title>
	@section('css')
		{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'); }}
		{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css'); }}
		{{ HTML::style('/asset/css/style.css'); }}
		{{ HTML::style('/asset/blockUI/jquery.blockUI.css'); }}
		{{ HTML::style('/asset/colorbox/colorbox.css'); }}
	@show
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
		@yield('content')
    </div>

	@section('js')
		{{ HTML::script('//code.jquery.com/jquery-2.2.1.min.js') }}
		{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'); }}
		{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js'); }}
		{{ HTML::script('/asset/blockUI/jquery.blockUI.js'); }}
		{{ HTML::script('/asset/colorbox/jquery.colorbox-min.js'); }}
		{{ HTML::script('/asset/js/masonry.pkgd.min.js'); }}
		{{ HTML::script('/asset/js/imagesloaded.pkgd.js'); }}
		{{ HTML::script('/asset/js/common.js?v=1'); }}
		{{ HTML::script('/asset/js/app.js?v=1'); }}
		{{ HTML::script('/asset/js/home.js?v=1'); }}
	@show
  </body>
</html>
