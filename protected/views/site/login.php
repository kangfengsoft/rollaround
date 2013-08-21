<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="row-fluid">
	<div class="span10 infobox-container">
		<a href="<?php echo Yii::app()->params['oauthAuthorizeUrl']?>" class="btn btn-large btn-primary">请登录</a>
	</div>
</div>
<div class="span5">
								<div class="widget-box transparent">
									<div class="widget-header widget-header-flat">
										<h4 class="lighter">
											<i class="icon-star orange"></i>
											上架时间表
										</h4>

										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="icon-chevron-up"></i>
											</a>
										</div>
									</div>

									<div class="widget-body">
										<div class="widget-main no-padding">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>
															<i class="icon-caret-right blue"></i>
															name
														</th>

														<th>
															<i class="icon-caret-right blue"></i>
															price
														</th>

														<th class="hidden-phone">
															<i class="icon-caret-right blue"></i>
															status
														</th>
													</tr>
												</thead>

												<tbody>
													<tr>
														<td>internet.com</td>

														<td>
															<small>
																<s class="red">$29.99</s>
															</small>
															<b class="green">$19.99</b>
														</td>

														<td class="hidden-phone">
															<span class="label label-info arrowed-right arrowed-in">on sale</span>
														</td>
													</tr>

													<tr>
														<td>online.com</td>

														<td>
															<small>
																<s class="red"></s>
															</small>
															<b class="green">$16.45</b>
														</td>

														<td class="hidden-phone">
															<span class="label label-success arrowed-in arrowed-in-right">approved</span>
														</td>
													</tr>

													<tr>
														<td>newnet.com</td>

														<td>
															<small>
																<s class="red"></s>
															</small>
															<b class="green">$15.00</b>
														</td>

														<td class="hidden-phone">
															<span class="label label-important arrowed">pending</span>
														</td>
													</tr>

													<tr>
														<td>web.com</td>

														<td>
															<small>
																<s class="red">$24.99</s>
															</small>
															<b class="green">$19.95</b>
														</td>

														<td class="hidden-phone">
															<span class="label arrowed">
																<s>out of stock</s>
															</span>
														</td>
													</tr>

													<tr>
														<td>domain.com</td>

														<td>
															<small>
																<s class="red"></s>
															</small>
															<b class="green">$12.00</b>
														</td>

														<td class="hidden-phone">
															<span class="label label-warning arrowed arrowed-right">SOLD</span>
														</td>
													</tr>
												</tbody>
											</table>
										</div><!--/widget-main-->
									</div><!--/widget-body-->
								</div><!--/widget-box-->
							</div>
