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
			var week = '日一二三四五六';
			function fillZero(v){
				return v < 10 ? '0'+v : v;
			}
			$.post('./listAjax.php',function(data){
				console.log(data)
				if(data.rs){
					
			        var d = data.data;
			        var total = 0;
			        if(d.length){
			        	var temp = '';
			        	$.each(d,function(index,item){
			        		var date = new Date(item.date);
			        		var d = ''
			        		
			        		var d = `${date.getFullYear()}-${fillZero(date.getMonth()+1)}-${fillZero(date.getDate())} ${date.getDay() ===0 || date.getDay()===6 ? `<span class="bg-danger">星期${week[date.getDay()]}</span>` : `<span class="bg-success">星期${week[date.getDay()]}</span>`} `;
			        		var price = Number(item.price);
			        		total+=price;
			        		
			        		temp += `<tr>
							          <td><span class="xh">${item.id}</span></td>
							          <td>
							          	${d}
							          </td>
							          <td>${item.name}</td>
							          <td>${price.toFixed(2)}</td>
							          <td><button type="button" class="btn btn-danger btn-sm">删除</button></td>
							        </tr>`;
			        	})
			        	temp +=`<tr><td colspan="3">合集 ${total.toFixed(2)} RMB</td></tr>`
			        	$('#editItemBox > tbody').append(temp);
			        }
				}
			},'json')
		})
	</script>

<?php include('./footer.php'); ?>
