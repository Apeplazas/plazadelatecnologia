<?php
@session_start();
	class MyFacebook extends MX_Controller {
		private $userid;
		private $user;
		private $facebook;
		public function __construct()
		{
			parent::__construct();
			$this->userid = $this->session->userdata("userid");
			//$this->load->model('myfacebookmodel');
			try{
				require_once 'facebook/facebook.php';
				$this->facebook  = new Facebook(array(
				  'appId'  => "380608148651356",
				  'secret' => "8fb60dea0ca1f1adff9d1e9315ae313d",
				));
				$this->user = $this->facebook->getUser();
                
			}catch (FacebookApiException $e) {
				error_log($e);
				$this->user = null;
			}
		}
		
		public function index()
		{
			if($this->user) {
			  try {
				$user_profile = $this->facebook->api('/me');
				
			  } catch (FacebookApiException $e) {
				error_log($e);
				$this->user = null;
			  }
			  
			}

			if ($this->user) {
                
                $permissions = $this->facebook->api("me/permissions");
				if($permissions['data'][0]['email']!=1 //||
				   //$permissions['data'][0]['manage_pages']!=1 ||
				   //$permissions['data'][0]['offline_access']!=1 ||
                   //$permissions['data'][0]['user_groups']!=1
				  ){
                  $callbackUrl = site_url("myfacebook");
				  $loginUrl    = $this->facebook->getLoginUrl(array('redirect_uri'=>$callbackUrl,'scope'=>"publish_stream,email,user_birthday,offline_access,manage_pages"));
				 
				  echo  "<script>window.parent.location=\"".html_entity_decode($loginUrl)."\"  </script>";
				  exit;
	           }

              //d($user_profile,1);

				if(isset($user_profile['id'])){
					$user_profile['access_token'] = $this->facebook->getAccessToken();
					//$this->myfacebookmodel->addprofile($user_profile);
					echo "<pre>";
					print_r($user_profile);
					exit;
                    @session_destroy();
                    $logoutUrl   = $this->facebook->getLogoutUrl(array('next'=> site_url("myfacebook")));
				    header("Location: $logoutUrl");exit;
				}else{
				   $this->session->set_flashdata("error_message","Sorry !!! We could not access your facebook profile.");
				   redirect("myfacebook");exit;
				}
			} else {
				$callbackUrl = site_url("myfacebook");
				$loginUrl    = $this->facebook->getLoginUrl(array('redirect_uri'=>$callbackUrl,'scope'=>"publish_stream,offline_access,manage_pages,user_groups"));
			    header("Location: $loginUrl");exit;
			}
		}
		
	}