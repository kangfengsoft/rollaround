<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 指定宝贝';
$this->breadcrumbs=array(
	'指定宝贝',
);
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.tabbedwidget').tabs();
})
</script>


<div class="row-fluid">
<div class="tabbedwidget tab-primary">
	<ul>
		<li><a href="#a-1">已经指定的宝贝</a></li>
		<li><a href="#a-2">选择宝贝</a></li>
	</ul>
	<div id="a-1"><table id="dyntable" class="table table-bordered responsive">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                          	<th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                            <th class="head0">图片</th>
                            <th class="head1">标题</th>
                            <th class="head0">价格</th>
                            <th class="head1">状态</th>
                            <th class="head0">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table></div>
	<div id="a-2">Your content goes here for tab 2</div>
</div>
<!--tabbedwidget-->



                



</div>


<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
        	"iDisplayLength": 50,
          	"bProcessing": true, //数据加载中的提示
            "bServerSide": true,
            "bPaginate": true,
            
            "sAjaxSource": BASE_PATH + "/index.php/site/getAllGood",
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
//             "fnDrawCallback": function(oSettings) {
//                 jQuery.uniform.update();
//             },

            "aoColumns": [{ "mDataProp": "num_iid" },
						  { "mDataProp": "pic_url", 
				  			"sWidth" : "60px",
            				"sDefaultContent": "",
							"mRender": function (data, type, full) {
	                                return '<img src="'+ data +'"/>';}
						  },

                          { "mDataProp": "title",
	                          "sWidth" : '40%',
	                          "sClass" : 'title'},
                          
                          
                          { "mDataProp": "price" },
                          { "mDataProp": "delist_time" },
                          { "mData": null,
                        	"bSortable":false,
                        	"sClass":"table-select",
                        	"fnRender": function(oObj){
                            	   return "计划下架<select class='input-small'>"+
                            	   "<option>星期一</option>"
                            	   +"<option>星期二</option>"
                            	   +"<option>星期三</option>"
                            	   +"<option>星期四</option>"
                            	   +"<option>星期五</option>"
                            	   +"<option>星期六</option>"
                            	   +"<option>星期天</option>"
                            	   +"</select>"+
                            	   "<select class='input-small'>"+
                            	   "<option>00:00-01:00</option>"
                            	   +"<option>01:00-02:00</option>"
                            	   +"</select>"+
                            	   "<button class='btn btn-primary'>保存</button>"
                           }}
                      ],

        	"oLanguage": {
	        	"sLengthMenu": "每页显示 _MENU_条",
	        	"sZeroRecords": "没有找到符合条件的数据",
	        	"sProcessing": "正在从数据库加载数据",
	        	"sInfo": "当前第 _START_ - _END_ 条　共计 _TOTAL_ 条",
	        	"sInfoEmpty": "木有记录",
	        	"sInfoFiltered": "(从 _MAX_ 条记录中过滤)",
	        	"sSearch": "搜索：",
	        	"oPaginate": {
	        	"sFirst": "首页",
	        	"sPrevious": "前一页",
	        	"sNext": "后一页",
	        	"sLast": "尾页"
	        	}
        	}
        });

    });
</script>