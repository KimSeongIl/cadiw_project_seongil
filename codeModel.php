<?
class CodeModel extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	function login($id,$pw){
		$strQuery = "select * from member where id='$id' and password='$pw';";

		return $this->db->query($strQuery)->result();
	}
	
	
}
?>