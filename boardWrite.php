<div id='article'>
<center>
	<form id='boardWriteForm' action='/index.php/cpms/code/boardInput' method='post'>
	<table border id='boardWrite'>
		<tr>
			<th>제목</th>
			<td><input name="btitle" placeholder='제목을 입력하세요' type="text" style="width:100%;height:100%;border:0px;"></td>
		</tr>
		<tr>
			<th>내용</th>
			<td><textarea name="bcontent" placeholder='내용을 입력하세요' style="width:100%;height:100%;border:0px;"></textarea>
		</tr>
		<tr>
			<td colspan="2"><input class="btn-btn default btn-sm" type="submit" value="등록"> <input class="btn-btn default btn-sm" type="button" value="돌아가기" onclick="history.back()"></td>
		</tr>

	</table>
	</form>
</center>
</div><!-- div id='article'-->
</div> <!-- div id='wrap'-->