<div id="article">
<center>
<div id='board'>
	
		<h1>게시판</h1>
		<table border>
			<tr>
				<th>번호</th>
				<th>제목</th>
				<th>작성자</th>
				<th>작성일</th>
			</tr>
			<?
			if(count($list)==0){

			}
			else{
			for($i=0;$i<count($list);$i++){
				echo "<tr>";
				echo "	<td>".$list[$i]->bid."</td>";
				echo "	<td>".$list[$i]->btitle."</td>";
				echo "	<td>".$list[$i]->name."</td>";
				echo "	<td>".$list[$i]->bdate."</td>";
				echo "</tr>";
			}
		}

			?>
		</table>
		
	
</div>
<br>
		<?=$page_links?>
		<br>
		<br>
		<input type="search"> <input type="button" class="btn-btn default btn-sm" value="검색">
		<input id="board_write_btn" class="btn-btn default btn-sm" type="button" value="글쓰기" onclick="location.href='/index.php/cpms/code/boardWrite'">
		</center>
</div><!-- div id='article'-->
</div> <!--div id='wrap'-->