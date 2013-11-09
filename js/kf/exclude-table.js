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
					"mData" : null,
					"bSortable" : false,
					"sClass" : "table-select",
					"fnRender" : function (oObj) {
						return "<button class='btn btn-danger'>取消排除</button>"
					}
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
		option2.sAjaxSource = BASE_PATH + "/index.php/shelf/getAllExcludeTasks";
		option2.fnCreatedRow = function (nRow, aData, iDataIndex) {
			$('td:eq(4) button', nRow).click(function () {
				var id = aData.num_iid;
				var row = $(nRow);
				$.ajax({
					type : "post",
					url : BASE_PATH + "/index.php/shelf/deleteExcludeTask",
					dataType : "json",
					data : {
						'num_iid' : id
					},
					success : function (data, textStatus) {
						jQuery.jGrowl("取消排除成功");
						$('#dyntable').dataTable().fnDeleteRow(row[0]);
					},
					complete : function (XMLHttpRequest, textStatus) {
						//HideLoading();
					},
					error : function () {
						//请求出错处理
					}
				});
			});
		}

		jQuery('#dyntable').dataTable(option2);

		var option3 = cloneObject(option);
		option3.bServerSide = true,
		option3.sAjaxSource = BASE_PATH + "/index.php/site/getAllGood";
		option3.aoColumns = [{
				"mDataProp" : "num_iid"
			}, {
				"mDataProp" : "pic_url",
				"sWidth" : "60px",
				"bSortable" : false,
				"sDefaultContent" : "",
				"mRender" : function (data, type, full) {
					return '<a href="http://item.taobao.com/item.htm?id=' + full.num_iid + '" target="blank" title="查看宝贝详情"><img src="' + data + '"/></a>';
				}
			},
			{
				"mDataProp" : "title",
				"bSortable" : false,
				"sWidth" : '40%',
				"sClass" : 'title'
			},
			{
				"mDataProp" : "price",
				"bSortable" : false,
				"sWidth" : '80px',
			}, {
				"mDataProp" : "delist_time",
				"sDefaultContent" : ""
			}, {
				"mData" : null,
				"bSortable" : false,
				"sClass" : "table-select",
				"fnRender" : function (oObj) {
					return "<button class='btn btn-primary'>排除宝贝</button>"
				}
			}
		];

		option3.fnCreatedRow = function (nRow, aData, iDataIndex) {
			if(aData.type === "exclude"){
				$(nRow).addClass('exclude-row');
			}
				$('button', nRow).click(function () {
					var id = aData.num_iid;
				$.ajax({
					type : "post",
					url : BASE_PATH + "/index.php/shelf/saveExcludeTask",
					dataType : "json",
					data : {
						'num_iid' : id
					},
					success : function (data, textStatus) {
						jQuery.jGrowl("任务设置成功");
						$(nRow).addClass('exclude-row');
						refresh = true;
					},
					complete : function (XMLHttpRequest, textStatus) {
						//HideLoading();
					},
					error : function () {
						//请求出错处理
					}
				});
			});
		}

		jQuery('#dyntable1').dataTable(option3);
	});
	
