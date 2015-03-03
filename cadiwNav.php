<?
	$udata=$this->session->all_userdata();
	
?>	
	<div id="nav">
		
			<table id="mypage">
				<tr>
					<td colspan="2"><?=$udata['uname']?> 님 환영합니다!</td>
				</tr>
				<tr>
				<?if($udata['uauth']=='관리자'){?>
					<td colspan="3" align="center">관리자</td>
					<?}else{?>
					<th>소속: </th>
					<td colspan="2"><?=$udata['ugroup']?>조</td>
					<?}?>
				</tr>
				<tr>
					<td><div class="btn btn-default btn-sm">마이페이지</div></td>
					<td><a href="/index.php/cpms/code/logout"><div class="btn btn-default btn-sm">로그아웃</div></a></td>
				</tr>
			</table>

		
		<div id="menu">
			
				<li>공지사항</li>
				<li id="menu_board">게시판</li>
					
				<li><a href="/index.php/cpms/code/group?group=<?=$udata['ugroup']?>">웹 프로젝트</a></li>
				<li>Q & A</li>
			
		</div>
		<div id="menu_board_sub">
						<li>강의자료</li>
						<li>자유게시판</li>
			</div>

	</div>
