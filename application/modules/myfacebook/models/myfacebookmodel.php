<?php 
   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class MyFacebookModel extends CI_Model {
		
		public function __construct(){
			parent::__construct();
			
		}
        public function getAddedProfiles($userid){
			if($userid == false) return false;
			$sql     = "SELECT *FROM facebook_profile WHERE userid='$userid' order by status";
			$query   = $this->db->query($sql);
			$results = $query->result(); 
			return $query->result();
		}
		public function getAddedPages($userid){
			if($userid == false) return false;
			$sql     = "SELECT *FROM facebook_pages WHERE userid='$userid' order by status";
			$query   = $this->db->query($sql);
			$results = $query->result(); 
            //d($results,1);
			return $query->result();
		}
        public function getAddedGroups($userid){
            if($userid == false) return false;
			$sql     = "SELECT *FROM facebook_groups WHERE userid='$userid' order by status";
			$query   = $this->db->query($sql);
			$results = $query->result(); 
			return $query->result();
        }
		public function addprofile($user_profile){
		    if($this->getUserExists($user_profile['id'])){
                $this->session->set_flashdata("error_message","You have already added this profile.Please try another");
			}else{
                $data['userid']       = $this->session->userdata("userid");
				$data['uid']          = $user_profile['id'];
				$data['first_name']   = $user_profile['first_name'];
				$data['last_name']    = $user_profile['last_name'];
				$data['access_token'] = $user_profile['access_token'];
				
				$this->db->insert("facebook_profile",$data);
				$affected_rows = $this->db->affected_rows();
				if($affected_rows){
					$this->session->set_flashdata("success_message","You have successfully added this profile");
				}else{
					$this->session->set_flashdata("error_message","Sorry!!! Internal problem.Please Try again later.");
				}
			}
		   
		}
		
		public function getUserExists($uid){
			$sql   = "SELECT *FROM facebook_profile WHERE uid = '".$uid."'";
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				return true;
			}else{
				return false;
			}
		}
		public function alreadyAddedThisPage($userid,$pageid){
			$sql   = "SELECT *FROM facebook_pages WHERE userid = '".$userid."' AND pageid='".$pageid."'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		public function addFanPage($data){
			$this->db->insert("facebook_pages",$data);
            //d($data,1);
			return $this->db->affected_rows();
		}
        public function addGroup($data){
			$this->db->insert("facebook_groups",$data);
			return $this->db->affected_rows();
		}
		public function deletepage($userid,$id){
			$this->db->delete('facebook_pages',array('id'=>$id,'userid'=>$userid));
			return $this->db->affected_rows();
		}
		
	}
	