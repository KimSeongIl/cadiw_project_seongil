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
			$result['list']=$this->codeModel->boardView();

			

			$this->load->view('cpms/cadiwHeader');
			$this->load->view('cpms/cadiwNav');
			$this->load->view('cpms/board',$result);
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
	
}


?>