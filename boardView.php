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
</div><!-- div id='article'-->
</div> <!--div id='wrap'-->

</body>
</html>