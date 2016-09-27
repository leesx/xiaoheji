<?php include('./header.php'); ?>
	
	<div class="container-fluid">
		
		<div class="xhj-main" >
		<div class="alert alert-danger" id="input-warn" style="position:fixed;top:10px;right:40px;opacity:0;">输入框不能为空</div>
		<div class="edit-hd">
			<button type="button" class="btn btn-primary pull-right" id="addItem"><span class="glyphicon glyphicon-plus"></span> &nbsp;&nbsp;添加项目</button>
		</div>
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
	        <tr>
	          <td><span class="xh">1</span></td>
	          <td>
	          	<div class="input-append date form_datetime">
					    <input size="16" type="text" value="" readonly class="form-control item-date">
					    <span class="add-on"><i class="icon-th"></i></span>
					</div>
	          </td>
	          <td><span class="col col-1"><input type="text" class="form-control item-name" /></span></td>
	          <td><span class="col col-1"><input type="text" class="form-control item-price" /></span></td>
	          <td><button type="button" class="btn btn-danger btn-sm">删除</button></td>
	        </tr>
	        
	      </tbody>
	    </table>
	    <div class="edit-ft">
			<button type="button" class="btn btn-primary pull-right" id="submit" >提交编辑</button>
		</div>
		</div>
	</div>
<script>
	//日历
	var dateConfig = {
		language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	}
	//这个方法不能放到$(function())中，界面加载的时候，需要初始化。
	$('.form_datetime').datetimepicker(dateConfig);

	$(function(){

		//添加项目
		var $editItem = $('#editItemBox');
		$('#addItem').on('click',function(){
			var len = $editItem.find('tr').length
			var itemTemp = `<tr>
			<td><span class="xh">${len}</span></td>
	          <td>
	          	<div class="input-append date form_datetime">
					    <input size="16" type="text" class="form-control item-date" value="" readonly>
					    <span class="add-on"><i class="icon-th"></i></span>
					</div>
	          </td>
	          <td><span class="col col-1"><input type="text" class="form-control item-name" /></span></td>
	          <td><span class="col col-1"><input type="text" class="form-control item-price" /></span></td>
	          <td><button type="button" class="btn btn-danger btn-sm">删除</button></td>
	        </tr>`;
			$editItem.find('tbody').append(itemTemp);
			//注意,每次动态添加的时候，都要初始化一下日历。
			$('.form_datetime').datetimepicker(dateConfig);
		})
		//删除项目
		$('#editItemBox').on('click','.btn-danger',function(){
			$(this).parent().parent().remove()
		});
		//提交
		$('#submit').on('click',function(){
			var $row = $editItem.find('tbody > tr')
			var items = [];
			for(var i=0;i<$row.length;i++){
				var obj = {};
				var $thisRow = $($row[i])
				obj.date = new Date($thisRow.find('.item-date').val()).toString()
				obj.name = $thisRow.find('.item-name').val()
				obj.price = $thisRow.find('.item-price').val()
				if(!obj.date || !obj.name || !obj.price ) {
					$('#input-warn').animate({opacity:1}, 1000)
					setTimeout(function(){
						$('#input-warn').animate({opacity:0}, 1000)
					}, 3000);
					return false;
				}

				items.push(obj)
			}

			$.post('./todypay.php',{
				payitems:items
			},function(data){
				location.href="./list.php";
			},'json')
		})
		
	})
</script>
<?php include('./footer.php'); ?>
