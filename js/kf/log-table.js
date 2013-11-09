	jQuery(document).ready(function () {
		window.$ = jQuery;
		var option = {
			"iDisplayLength" : 25,
			"bProcessing" : true, //数据加载中的提示
			"bPaginate" : true,
			"bAutoWidth" : false,
			"sPaginationType" : "full_numbers",

			"aoColumns" : [{
					"mDataProp" : "num_iid"
				}, {
					"mDataProp" : "pic_url",
					"sDefaultContent" : "",
					"bSortable" : false,
					"mRender" : function (data, type, full) {
						return '<a href="http://item.taobao.com/item.htm?id=' + full.num_iid + '" target="blank" title="查看宝贝详情"><img src="' + data + '"/></a>';
					}
				}, {
					"mDataProp" : "title",
					"bSortable" : false,
					"sWidth" : '40%',
					"sClass" : 'title'
				}, {
					"mDataProp" : "price",
					"bSortable" : false
				}, {
					"mDataProp" : "delist_time"
				}
			],

			"oLanguage" : {
				"sLengthMenu" : "每页显示 _MENU_条",
				"sZeroRecords" : "没有找到符合条件的数据",
				"sProcessing" : "正在从数据库加载数据",
				"sInfo" : "当前第 _START_ - _END_ 条　共计 _TOTAL_ 条",
				"sInfoEmpty" : "木有记录",
				"sInfoFiltered" : "(从 _MAX_ 条记录中过滤)",
				"sSearch" : "搜索：",
				"oPaginate" : {
					"sFirst" : "首页",
					"sPrevious" : "前一页",
					"sNext" : "后一页",
					"sLast" : "尾页"
				}
			}
		};

		var option2 = cloneObject(option);
		option2.sAjaxSource = BASE_PATH + "/index.php/shelf/getAllListLog";
		jQuery('#dyntable').dataTable(option2);

	});
	
