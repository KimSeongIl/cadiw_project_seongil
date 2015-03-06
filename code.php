<? ob_start();?>
<meta charset="utf-8">
<?
class Code extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('cpms/codeModel');
		$this->load->library('session');
	}
	public function index(){

		$this->load->view('cpms/codeIndex');
	}
	public function login(){
		$id=$this->input->post('id');
		$pw=$this->input->post('pw');
		$result=$this->codeModel->login($id,$pw);
		if(count($result)==0){
			echo "<script>alert('아이디와 비밀번호가 맞지 않습니다!')</script>";
			echo "<script>location.href='/index.php/cpms/code'</script>";
			
		}
		else{

			$data=array(
				'uid'=>$result[0]->id,
				'uname'=>$result[0]->name,
				'ugroup'=>$result[0]->grp,
				'uauth'=>$result[0]->authority
				);
			$this->session->set_userdata($data);
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function cadiw(){

		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$this->load->view('cpms/cadiwHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/cadiwIndex');
		}
		else{

			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code','refresh');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/cpms/code','location');
	}
	public function group(){
		$udata=$this->session->all_userdata();
		$group=$this->input->get('group');
		if($udata['ugroup']!=$group){
			echo "<script>alert('권한이 없습니다')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
		else{
			$this->load->view('cpms/cadiwGroupHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/cadiwGroupIndex');
		}
	}
	public function board(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			

			$data['page_num'] = $this->uri->segment(4,0);
			$data['per_page']=10;
			$data['list']=$this->codeModel->board($data['per_page'],$data['page_num']);
			$data['total_rows']=$this->codeModel->boardCount();

			$comment=$this->codeModel->commentCount();
			
			for($i=0;$i<count($data['list']);$i++){
				$comment1[$i]=0;
				for($j=0;$j<count($comment);$j++){
					if($data['list'][$i]->bid==$comment[$j]->bid)
						$comment1[$i]=$comment[$j]->bcount;
				}
				
			}
			$data['comment']=$comment1;
			
			$this->load->library('pagination');
			$config['full_tag_open'] = '<div id="page">';
			$config['base_url']='/index.php/cpms/code/board';
			$config['total_rows']=$data['total_rows'];
			$config['per_page'] = $data['per_page'];
			$config['uri_segment'] = 4;
			$config['next_link']  = '다음';
			$config['next_tag_open'] = '<div class="page_num">';
         	$config['next_tag_close'] = '</div>';
         	$config['prev_link']  = '이전';
         	$config['prev_tag_open'] = '<div class="page_num">';
         	$config['prev_tag_close'] = '</div>';
         	$config['num_tag_open'] = '<div class="page_num">';
         	$config['num_tag_close'] = '</div>';
         	$config['cur_tag_open'] = '<div class="page_num">';
         	$config['cur_tag_close'] = '</div>';
         	$config['full_tag_close'] = '</div>';
			$this->pagination->initialize($config);
			$data['page_links'] = $this->pagination->create_links();
			if($data['page_links']==null){
				$data['page_links']='1';
			}
			$this->load->view('cpms/cadiwHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/board',$data);
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function boardWrite(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$this->load->view('cpms/cadiwHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/boardWrite');
		}
		else{
			echo "<script>alert('로그인해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function boardInput(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$btitle=$this->input->post('btitle');
			$bcontent=$this->input->post('bcontent');
			$this->codeModel->boardInput($udata['uid'],$btitle,$bcontent);
			echo "<script>alert('글이 등록되었습니다')</script>";
			redirect('/cpms/code/board','refresh');
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function boardView($no){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$result['list']=$this->codeModel->boardView($no);
			$result['comment']=$this->codeModel->commentView($no);
			$this->load->view('cpms/cadiwHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/boardView',$result);
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function boardUpdate($no){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$result['list']=$this->codeModel->boardView($no);
			$this->load->view('cpms/cadiwHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/boardUpdate',$result);
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function boardUpdateSuccess(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$bid=$this->input->post('bid');
			$bcontent=$this->input->post('bcontent');
			$this->codeModel->boardUpdate($bid,$bcontent);
			echo "<script>alert('글이 수정되었습니다')</script>";
			redirect('/cpms/code/board','refresh');
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function boardDelete(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$bid=$this->input->post('bid');
			$this->codeModel->boardDelete($bid);
			echo "<script>alert('글이 삭제되었습니다')</script>";
			redirect('/cpms/code/board','refresh');
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function boardSearch($option,$search){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$o=$option;
			$s=$search;
			$option=urldecode($option);
			$search=urldecode($search);

			$data['page_num'] = $this->uri->segment(6,0);
			$data['per_page']=10;
			if($option=='제목+내용'){
				$data['list']=$this->codeModel->boardSearchAll($data['per_page'],$data['page_num'],$search);
				$data['total_rows']=$this->codeModel->boardSearchAllCount($search);
			}
			else{
				$data['list']=$this->codeModel->boardSearchTitle($data['per_page'],$data['page_num'],$search);
				$data['total_rows']=$this->codeModel->boardSearchTitleCount($search);
			}

			$comment=$this->codeModel->commentCount();
			
			for($i=0;$i<count($data['list']);$i++){
				$comment1[$i]=0;
				for($j=0;$j<count($comment);$j++){
					if($data['list'][$i]->bid==$comment[$j]->bid)
						$comment1[$i]=$comment[$j]->bcount;
				}
				
			}
			$data['comment']=$comment1;
			
			$this->load->library('pagination');
			$config['full_tag_open'] = '<div id="page">';
			$config['base_url']='/index.php/cpms/code/boardSearch/'.$o.'/'.$s.'';
			$config['total_rows']=$data['total_rows'];
			$config['per_page'] = $data['per_page'];
			$config['uri_segment'] = 6;
			$config['next_link']  = '다음';
			$config['next_tag_open'] = '<div class="page_num">';
         	$config['next_tag_close'] = '</div>';
         	$config['prev_link']  = '이전';
         	$config['prev_tag_open'] = '<div class="page_num">';
         	$config['prev_tag_close'] = '</div>';
         	$config['num_tag_open'] = '<div class="page_num">';
         	$config['num_tag_close'] = '</div>';
         	$config['cur_tag_open'] = '<div class="page_num">';
         	$config['cur_tag_close'] = '</div>';
         	$config['full_tag_close'] = '</div>';
			$this->pagination->initialize($config);
			$data['page_links'] = $this->pagination->create_links();
			if($data['page_links']==null){
				$data['page_links']='1';
			}
			$this->load->view('cpms/cadiwHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/board',$data);
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function commentWrite(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){

			$content=$this->input->post('content');
			$board_id=$this->input->post('board_id');
			echo $board_id;
			$this->codeModel->commentWrite($board_id,$udata['uid'],$content);
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	public function commentView(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$bno=$this->input->post('bid');
			$result['list']=$this->codeModel->commentView($bno);
			
			$this->load->view('cpms/commentView',$result);
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	
	}
	public function commentRemove(){
		$udata=$this->session->all_userdata();
		if(isset($udata['uid'])){
			$cid=$this->input->post('cid');
			$this->codeModel->commentRemove($cid);
			
			
		}
		else{
			echo "<script>alert('로그인 해주세요!')</script>";
			redirect('/cpms/code/cadiw','refresh');
		}
	}
	
}


?>