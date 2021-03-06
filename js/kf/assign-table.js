	jQuery(document).ready(function () {
		window.$ = jQuery;
		var weekString = "<option value='1'>星期一</option>"
			 + "<option value='2'>星期二</option>"
			 + "<option value='3'>星期三</option>"
			 + "<option value='4'>星期四</option>"
			 + "<option value='5'>星期五</option>"
			 + "<option value='6'>星期六</option>"
			 + "<option value='0'>星期天</option>";

		var hourString = "<option value='0'>00:00-01:00</option>"
			 + "<option value='1'>01:00-02:00</option>"
			 + "<option value='2'>02:00-03:00</option>"
			 + "<option value='3'>03:00-04:00</option>"
			 + "<option value='4'>04:00-05:00</option>"
			 + "<option value='5'>05:00-06:00</option>"
			 + "<option value='6'>06:00-07:00</option>"
			 + "<option value='7'>07:00-08:00</option>"
			 + "<option value='8'>08:00-09:00</option>"
			 + "<option value='9'>09:00-10:00</option>"
			 + "<option value='10'>10:00-11:00</option>"
			 + "<option value='11'>11:00-12:00</option>"
			 + "<option value='12'>12:00-13:00</option>"
			 + "<option value='13'>13:00-14:00</option>"
			 + "<option value='14'>14:00-15:00</option>"
			 + "<option value='15'>15:00-16:00</option>"
			 + "<option value='16'>16:00-17:00</option>"
			 + "<option value='17'>17:00-18:00</option>"
			 + "<option value='18'>18:00-19:00</option>"
			 + "<option value='19'>19:00-20:00</option>"
			 + "<option value='20'>20:00-21:00</option>"
			 + "<option value='21'>21:00-22:00</option>"
			 + "<option value='22'>22:00-23:00</option>"
			 + "<option value='23'>23:00-24:00</option>";
		var option = {
			"iDisplayLength" : 25,
			"bProcessing" : true, //数据加载中的提示
			"bServerSide" : true,
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
				}, {
					"mData" : null,
					"bSortable" : false,
					"sClass" : "table-select",
					"fnRender" : function (oObj) {
						var newWeekString = weekString;
						var newHourString = hourString;
						if(oObj.aData.type === "assign"){
							newWeekString = weekString.replace("value='"+oObj.aData.day+"'", "value='"+oObj.aData.day+"' selected");
							newHourString = hourString.replace("value='"+oObj.aData.hour+"'", "value='"+oObj.aData.hour+"' selected")
						}
						return "计划下架<select class='input-small day'>" +
						newWeekString + "</select>" +
						"<select class='input-medium hour'>" +
						newHourString
						 + "</select>" +
						"<button class='btn btn-primary'>保存</button>"
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
		option2.sAjaxSource = BASE_PATH + "/index.php/site/getAllGood";

		option2.fnCreatedRow = function (nRow, aData, iDataIndex) {
			if(aData.type === "assign"){
				$(nRow).addClass('selected-row');
			}
			$('button', nRow).click(function () {
				var id = aData.num_iid;
				var hour = $(this).prevAll('.hour').val();
				var day = $(this).prevAll('.day').val();
		
				$.ajax({
					type : "post",
					url : BASE_PATH + "/index.php/shelf/saveAssignTask",
					dataType : "json",
					data : {
						'num_iid' : id,
						'hour' : hour,
						'day' : day
					},
					success : function (data, textStatus) {
						jQuery.jGrowl("任务设置成功");
						window.refresh = true;
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

		jQuery('#dyntable1').dataTable(option2);

		var option3 = cloneObject(option);
		option3.sAjaxSource = BASE_PATH + "/index.php/site/getInventoryGood";
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
					return "计划上架<select class='input-small day'>" +
					weekString
					 + "</select>" +
					"<select class='input-medium hour'>" +
					hourString
					 + "</select>" +
					"<button class='btn btn-primary'>上架宝贝</button>"
				}
			}
		];

		option3.fnCreatedRow = function (nRow, aData, iDataIndex) {
			$('button', nRow).click(function () {
				var id = aData.num_iid;
				var hour = $(this).prevAll('.hour').val();
				var day = $(this).prevAll('.day').val();
		
				$.ajax({
					type : "post",
					url : BASE_PATH + "/index.php/shelf/saveAssignTask",
					dataType : "json",
					data : {
						'num_iid' : id,
						'hour' : hour,
						'day' : day
					},
					success : function (data, textStatus) {
						jQuery.jGrowl("任务设置成功");
						window.refresh = true;
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

		jQuery('#dyntable3').dataTable(option3);


		var option1 = cloneObject(option);
		option1.sAjaxSource = BASE_PATH + "/index.php/shelf/getAllAssignTasks";
		option1.bServerSide = false,
		option1.aoColumns = [{
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
				var newWeekString = weekString.replace("value='"+oObj.aData.day+"'", "value='"+oObj.aData.day+"' selected");
				var newHourString = hourString.replace("value='"+oObj.aData.hour+"'", "value='"+oObj.aData.hour+"' selected")
				return "计划下架<select class='input-small day'>" +
				newWeekString + "</select>" +
				"<select class='input-medium hour'>" +
				newHourString
				 + "</select>" +
				"<button class='btn btn-primary'>保存</button>"+
				"<button class='btn btn-danger'>删除</button>"
			}
		}
	];


		option1.fnCreatedRow = function (nRow, aData, iDataIndex) {
			$('.btn-primary', nRow).click(function () {
				var id = aData.num_iid;
 				var hour = aData.hour;
 				var day = aData.day;
//				var hour = $(this).prevAll('.hour').val();
//				var day = $(this).prevAll('.day').val();
				$.ajax({
					type : "post",
					url : BASE_PATH + "/index.php/shelf/saveAssignTask",
					dataType : "json",
					data : {
						'num_iid' : id,
						'hour' : hour,
						'day' : day
					},
					success : function (data, textStatus) {
						jQuery.jGrowl("更新设置成功");
					},
					complete : function (XMLHttpRequest, textStatus) {
						//HideLoading();
					},
					error : function () {
						//请求出错处理
					}
				});
			});

			$('.btn-danger', nRow).click(function () {
				var id = aData.num_iid;
				var row = $(nRow);
				$.ajax({
					type : "post",
					url : BASE_PATH + "/index.php/shelf/deleteAssignTask",
					dataType : "json",
					data : {
						'num_iid' : id
					},
					success : function (data, textStatus) {
						jQuery.jGrowl("删除成功");
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

		jQuery('#dyntable').dataTable(option1);
	});


	
