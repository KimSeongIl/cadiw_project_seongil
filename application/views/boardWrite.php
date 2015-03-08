
<div id='article'>
<center>
	<form id='boardWriteForm' action='/index.php/code/boardInput' method='post'>
	<table border id='boardWrite'>
		<tr>
			<th>제목</th>
			<td><input name="btitle" placeholder='제목을 입력하세요' type="text" style="width:100%;height:100%;border:0px;"></td>
		</tr>
		
		<tr>
			<th>내용</th>
			<td><textarea name="bcontent"  style="width:100%;height:100%;border:0px;"  class="jqte-test"></textarea></td>
		</tr>
		

	</table>
	<br>
	<br>
	<br>
	<input class="btn-btn default btn-sm" type="submit" value="등록"> &nbsp;&nbsp;<input class="btn-btn default btn-sm" type="button" value="돌아가기" onclick="history.back()">
	</form>



</center>
</div><!-- div id='article'-->
</div> <!-- div id='wrap'-->
<script>
	$('.jqte-test').jqte();
	
	// settings of status
	var jqteStatus = true;
	$(".status").click(function()
	{
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
	
	</script>
</body>

</html>