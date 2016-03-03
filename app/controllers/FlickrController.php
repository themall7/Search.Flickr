<?php

class FlickrController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function search()
	{
		$input = Input::all();
		$result = array('error' => false, 'message' => '', 'validation' => array());
		
		// Validation
		if (empty($input['keyword'])) {
			$result['error'] = true;
			$result['validation']['keyword'] = 'Type a Keyword.';
		}
		
		if ($result['error']) {
			return Response::json($result);
		}
		
		$keywrods = implode(",", array($input['keyword']));
		$page = !isset($input['page']) || empty($input['page']) || $input['page']==0 ? 1 : $input['page'];
		$flickr = new Flickr( Config::get('custom.flickr.key') );
		$data = $flickr->search($keywrods, $page);
		$image_tags = '';
		foreach($data['photos']['photo'] as $photo) {
			// the image URL becomes somthing like
			// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg
			//echo '<img src="' . 'http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '.jpg">';
			$image_tags .= '<img src="' . 'http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '.jpg">';
		}
		
		$result['data'] = $image_tags;
		return Response::json($result);
	}

}
