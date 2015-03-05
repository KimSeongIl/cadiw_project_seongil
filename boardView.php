<?
	$udata=$this->session->all_userdata();
	
?>
<div id="article">
<center>
	<table border id="boardView">
		<tr>
			<th>제목</th>
			<td><?=$list[0]->btitle?></td>
		</tr>
		<tr>
			<th>작성자</th>
			<td><?=$list[0]->name?></td>
		</tr>
		<tr>
			<th>작성일</th>
			<td><?=$list[0]->bdate?></td>
		</tr>
		<tr>
			<th>내용</th>
			<td><?=$list[0]->bcontent?></td>
		</tr>
	</table>

	<br>
	<input type="button" value="돌아가기" class="btn btn-default btn-sm" onclick="history.back();">
</center>
<? if($udata['uid']==$list[0]->uid){?>
<div id='boardControl' align="right">
	<form action="/index.php/cpms/code/boardDelete" method="post">
	<input type="button" value="수정" class="btn btn-default btn-sm" onclick="location.href='/index.php/cpms/code/boardUpdate/<?=$list[0]->bid?>'"></a>
	&nbsp;&nbsp;
	<input type="submit" value="삭제" class="btn btn-default btn-sm" onclick="if(!confirm('정말 삭제하시겠습니까?')){return false;}"><br>
	<input type="hidden" value="<?=$list[0]->bid?>" name="bid">
	</form>
</div>
<?}?>
</div><!-- div id='article'-->
</div> <!--div id='wrap'-->

</body>
</html>