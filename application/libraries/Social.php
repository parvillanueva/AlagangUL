<?php

class Social {

	public function facebook()
	{
		$CI =& get_instance();
        $result = $CI->Global_model->get_by_id("site_information",1);
        return $result[0]->facebook;
	}

	public function twitter()
	{
		$CI =& get_instance();
        $result = $CI->Global_model->get_by_id("site_information",1);
        return $result[0]->twitter;
	}

	public function instagram()
	{
		$CI =& get_instance();
        $result = $CI->Global_model->get_by_id("site_information",1);
        return $result[0]->instagram;
	}

	public function pinterest()
	{
		$CI =& get_instance();
        $result = $CI->Global_model->get_by_id("site_information",1);
        return $result[0]->pinterest;
	}

	public function linkedin()
	{
		$CI =& get_instance();
        $result = $CI->Global_model->get_by_id("site_information",1);
        return $result[0]->linkedin;
	}

	public function tumblr()
	{
		$CI =& get_instance();
        $result = $CI->Global_model->get_by_id("site_information",1);
        return $result[0]->tumblr;
	}

	public function youtube()
	{
		$CI =& get_instance();
        $result = $CI->Global_model->get_by_id("site_information",1);
        return $result[0]->youtube;
	}


	public function share($url = null)
	{
		$CI =& get_instance();
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if($url != null){
			$actual_link = $url;
		}
		
		echo '<a href="https://www.facebook.com/sharer/sharer.php?u='.$actual_link.'" target="_blank" class="icon-link round-corner facebook fill"><i class="fa fa-facebook"></i></a>';
		if ($CI->agent->is_mobile()) {
			echo '<a href="fb-messenger://share/?link='.$actual_link.'" target="_blank" class="icon-link round-corner messenger fill"><img src="'.base_url().'/assets/img/messenger.png" width="25" /></a>';
			echo '<a href="whatsapp://send?text='.$actual_link.'" target="_blank" class="icon-link round-corner whatsapp fill"><img src="'.base_url().'/assets/img/whatsapp.png" width="25" /></a>';
			echo '<a href="viber://forward?text='.$actual_link.'" target="_blank" class="icon-link round-corner viber fill"><img src="'.base_url().'/assets/img/viber.png" width="25" /></a>';
		}
		echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url='.$actual_link.'&title=&summary=&source=" target="_blank" class="icon-link round-corner linkedin fill"><i class="fa fa-linkedin"></i></a>';
		echo '<a href="https://twitter.com/home?status='.$actual_link.'" target="_blank" class="icon-link round-corner twitter fill"><i class="fa fa-twitter"></i></a>';
		echo '<a href="https://plus.google.com/share?url='.$actual_link.'" target="_blank" class="icon-link round-corner google fill"><i class="fa fa-google-plus"></i></a>';
		echo '<a href="mailto:?&body='.$actual_link.'" class="icon-link round-corner envelope fill"><i class="fa fa-envelope"></i></a>';

	}

}


