<?php include('./header.php'); ?>
	
	<div class="container-fluid">
		
		<div class="xhj-main" >
		
		   <table class="table" id="editItemBox">
      		<caption>记录日常生活点滴</caption>
	      <thead>
	        <tr>
	          <th>#</th>
	          <th>日期</th>
	          <th>产品</th>
	          <th>价格</th>
	          <th>操作</th>
	        </tr>
	      </thead>
	      <tbody>
	        
	        
	      </tbody>
	    </table>

		</div>
	</div>
	<script>
		
		$(function(){
			$.post('./listAjax.php',function(data){
				console.log(data)
				if(data.rs){
					
			        var d = data.data;
			        if(d.length){
			        	var temp = '';
			        	$.each(d,function(index,item){
			        		temp += `<tr>
							          <td><span class="xh">${item.id}</span></td>
							          <td>
							          	${item.date}
							          </td>
							          <td>${item.name}</td>
							          <td>${item.price}</td>
							          <td><button type="button" class="btn btn-danger btn-sm">删除</button></td>
							        </tr>`;
			        	})

			        	$('#editItemBox > tbody').append(temp);
			        }
				}
			},'json')
		})
	</script>

<?php include('./footer.php'); ?>
