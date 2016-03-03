<?php

class FlickrController extends BaseController {

	/*
	|	Route::post('search', 'FlickrController@search');
	*/

	public function search()
	{
		$input = Input::all();
		$result = array('error' => false, 'message' => '', 'validation' => array());
		
		// Validation
		if (empty($input['keyword'])) {
			$result['error'] = true;
			$result['validation']['keyword[]'] = 'Type a Keyword.';
		}
		
		if ($result['error']) {
			return Response::json($result);
		}
		
		$keywrods = implode(",", $input['keyword']);
		$page = !isset($input['page']) || empty($input['page']) || $input['page']==0 ? 1 : $input['page'];
		$flickr = new Flickr( Config::get('custom.flickr.key') );
		$data = $flickr->search($keywrods, $page);
		$image_tags = '';
		foreach($data['photos']['photo'] as $photo) {
			// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg
			
			$img = <<<EOD
					http://farm{$photo["farm"]}.static.flickr.com/{$photo["server"]}/{$photo["id"]}_{$photo["secret"]}.jpg
EOD;
			$image_tags .= <<<EOD
				<div class="grid-item">
					<a class="gallery" href="{$img}" title="{$photo["title"]}"><img src="{$img}"></a>
				</div>
EOD;
		}
		$image_tags = <<<EOD
			<div class="grid">
				<div class="grid-sizer"></div>
				{$image_tags}
				<a class="infinite-more-link" href="/search/">More</a>
			</div>
EOD;
		
		$result['data'] = $image_tags;
		return Response::json($result);
	}

}
