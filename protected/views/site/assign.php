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
	<div id="a-1">Your content goes here for tab 1</div>
	<div id="a-2">Your content goes here for tab 2</div>
</div>
<!--tabbedwidget-->



                <table id="dyntable" class="table table-bordered responsive">
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
                </table>



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
							"mRender": function (data, type, full) {
	                                return '<img src="'+ data +'"/>';}
						  },
                          { "mDataProp": "title" },
                          
                          
                          { "mDataProp": "price" },
                          { "mDataProp": "delist_time" },
                          { "mDataProp": "delist_time" }
                      ],

        	"oLanguage": {
	        	"sLengthMenu": "每页显示 _MENU_条",
	        	"sZeroRecords": "没有找到符合条件的数据",
	        	//"sProcessing": "&lt;img src=’./loading.gif’ /&gt;",
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