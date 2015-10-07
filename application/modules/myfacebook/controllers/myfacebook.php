<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class myfacebook extends MX_Controller {
	public $facebookuid;
	public $facebookuser;
	public $facebook;
	public function __construct()
	{
		parent::__construct();
		$this->facebookuid = $this->session->userdata("facebookuid");
		try{
			require_once 'facebook/facebook.php';
			$this->facebook  = new Facebook(array(
			  'appId'  => "380608148651356",
			  'secret' => "8fb60dea0ca1f1adff9d1e9315ae313d",
			));
			$this->facebookuser = $this->facebook->getUser();
			
		}catch (FacebookApiException $e) {
			error_log($e);
			$this->facebookuser = null;
		}
		
		
		//$this->load->model('inicio/data_model');
		$this->load->model('user_model');
		$this->load->library('session');
		
		
	}

	public function index()
	{
		if($this->facebookuser) {
			try {
				$user_profile = $this->facebook->api('/me');
				
		  	} catch (FacebookApiException $e) {
				error_log($e);
				$this->facebookuser = null;
		  	}
		  
		}

			if ($this->facebookuser) {
                
                $permissions = $this->facebook->api("me/permissions");
				$faceapiaccess = false;
				foreach ($permissions['data'] as $value) {
					if($value['permission'] == 'email' && $value['status'] == 'granted')
						$faceapiaccess = true;
				}
				
				if(!$faceapiaccess){
                  $callbackUrl = site_url()."myfacebook";
				  $loginUrl    = $this->facebook->getLoginUrl(array('redirect_uri'=>$callbackUrl,'scope'=>"publish_stream,email,user_birthday,offline_access,manage_pages"));
				 
				  echo  "<script>window.parent.location=\"".html_entity_decode($loginUrl)."\"  </script>";
				  exit;
	           }

              //d($user_profile,1);

				if(isset($user_profile['id'])){
					$user_profile['access_token'] = $this->facebook->getAccessToken();
					if($this->user_model->saveProfileData($user_profile)){
						
						$query = $this->db->query("select idRegistro,uidFacebook,access_token,email,state,tipoRegistro,userAlias from usuarios where access_token = '".$user_profile['access_token']."'");
						foreach ($query->result() as $row)
						{
							$id = $row->idRegistro;
						}
						
						$data['user'] = array(
								                'uid' 			=> $id,
								                'name'			=> $user_profile['name'],
								                'email' 		=> $user_profile["email"],
								                'tipoUsuario'	=> 'usuario',
								                'is_logged_in' 	=> true
								            );
						
						$this->session->set_userdata($data);
					}
                    @session_destroy();
					redirect('usuario');
				}else{
				   $this->session->set_flashdata("error_message","Sorry !!! We could not access your facebook profile.");
				   redirect("myfacebook");exit;
				}
			} else {
				$callbackUrl = site_url()."myfacebook";
				$loginUrl    = $this->facebook->getLoginUrl(array('redirect_uri'=>$callbackUrl,'scope'=>"email"));
			    header("Location: $loginUrl");exit;
			}
			
	}
	
	function sesion()
	{
		print_r($this->session->userdata('user'));
	}
}