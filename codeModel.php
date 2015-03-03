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
	function boardInput($uid,$btitle,$bcontent){
		$insertdb=array(
			'uid'=>$uid,
			'btitle'=>$btitle,
			'bcontent'=>$bcontent
			);
		$this->db->insert('board',$insertdb);
	}
	function boardView(){
		$this->db->select('bid,btitle,name,bdate');
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		return $this->db->get()->result();
	}
	
	
}
?>