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
	function board($num,$local){
		$this->db->limit($num,$local);
		$this->db->select('bid,btitle,name,bdate');
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		$this->db->order_by("bid", "desc"); 
		return $this->db->get()->result();
	}
	function boardCount(){
		$this->db->select('bid,btitle,name,bdate');
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		return $this->db->count_all_results();
	}
	function boardView($no){
		$this->db->where('bid',$no);
		$this->db->select('uid,bid,btitle,name,bcontent,bdate');
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		return $this->db->get()->result();
	}
	function boardUpdate($bid,$bcontent){
		$data=array('bcontent'=>$bcontent);
		$this->db->where('bid',$bid);
		$this->db->update('board',$data);
	}
	function boardDelete($no){
		$this->db->where('bid',$no);
		$this->db->delete('board');
	}
	function boardSearchAll($num,$local,$search){
		$this->db->limit($num,$local);
		$this->db->select('bid,btitle,name,bdate');
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		$this->db->like('btitle',$search);
		$this->db->or_like('bcontent',$search);
		$this->db->order_by("bid", "desc"); 
		return $this->db->get()->result();
	}
	function boardSearchTitle($num,$local,$search){
		$this->db->limit($num,$local);
		$this->db->select('bid,btitle,name,bdate');
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		$this->db->like('name',$search);
		$this->db->order_by("bid", "desc"); 
		return $this->db->get()->result();
	}
	function boardSearchAllCount($search){
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		$this->db->like('btitle',$search);
		$this->db->or_like('bcontent',$search);
		return $this->db->count_all_results();
	}
	function boardSearchTitleCount($search){
		$this->db->from('board');
		$this->db->join('member','member.id=board.uid');
		$this->db->like('name',$search);
		return $this->db->count_all_results();
	}
	
}
?>