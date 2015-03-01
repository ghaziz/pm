
<div class="md-content ">
	<div class="modal-header">
        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
	 <div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="header">
                    <h3><?php echo $model->title; ?></h3>
                </div>
				<div class="tab-container">
					 <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">اطلاعات اولیه</a></li>
						<li class=""><a href="#extra" data-toggle="tab">اطلاعات تکمیلی</a></li>
                        <li class=""><a href="#profile" data-toggle="tab">پیوست ها</a></li>
                    </ul>
				<div class="tab-content">
				 <div class="tab-pane cont active" id="home">				
					<div class="block-flat">
						<div class="content">
							<table class="no-border">
								<thead class="no-border">
									<tr>
										<th style="width:40%;">مشخصات</th>
										<th class="text-center primary-emphasis">مقادیر</th>
									</tr>
								</thead>
								<tbody class="no-border-y">
									<tr>
										<td>شماره قرارداد</td>
										<td class="text-center primary-emphasis"><?php echo $model->no_contract; ?></td>
									</tr>
									<tr>
										<td>تاریخ شروع</td>
										<td class="text-center primary-emphasis"><?php echo PM::getJalali($model->start_time); ?></td>
									</tr>
									<tr>
										<td>تاریخ پایان</td>
										<td class="text-center primary-emphasis"><?php echo PM::getJalali($model->end_time); ?></td>
									</tr>
									<tr>
										<?php 
										$month=PM::remain_days(time(),$model->end_time);
										?>
										<td>تعداد روزهای باقی مانده</td>
										<td class="text-center primary-emphasis"><?php echo $month; ?></td>
									</tr>	
									<tr>
										<td>تاریخ ثبت پروژه</td>
										<td class="text-center primary-emphasis"><?php echo PM::getJalali($model->time); ?></td>
									</tr>
				    				<tr>
										<td>کارفرمای ناظر بر پروژه</td>
										<td class="text-center primary-emphasis"><?php echo PM::getUserName($model->user_id); ?></td>
									</tr>
								</tbody>
							</table>						
						</div>
					</div>
					</div>
					<div class="tab-pane cont" id="extra">	
						<div class="block-flat">
							<div class="content">
								<table class="no-border">
								<tbody class="no-border-y">
									<tr>
										<td>مبلغ پروژه</td>
										<td class="text-center primary-emphasis"><?php echo $model->price ? $model->price."ریال" : 'نامشخص'; ?></td>
									</tr>	
									<tr>
										<td>مبلغ پرداخت شده</td>
										<td class="text-center primary-emphasis"><?php echo $model->payment ? $model->payment."ریال" : 'نامشخص'; ?></td>
									</tr>	
									<tr>
										<td>تعداد افراد پروژه</td>
										<td class="text-center primary-emphasis"><?php echo $model->no_individuals; ?></td>
									</tr>	
									<tr>
										<td>وضعیت پروژه</td>
										<td class="text-center primary-emphasis"><?php echo PM::getTypeOfStatus($model); ?></td>
									</tr>
									<tr>
										<td>درصد پیشرفت پروژه</td>
										<td class="text-center primary-emphasis"><?php echo $model->percent_prog ? $model->percent_prog."%" : 'نامشخص'; ?></td>
									</tr>	
									<tr>
										<td>شرکت مجری پروژه</td>
										<td class="text-center primary-emphasis"><?php echo PM::getCompanytitle($model->id_company); ?></td>
									</tr>
									<tr>
										<td>توضیحات</td>
										<td class="text-center primary-emphasis"><?php echo $model->description; ?></td>
									</tr>
								</tbody>
							</table>
						  </div>
						</div>
					</div>
					<div class="tab-pane cont" id="profile">
					<p>در این قسمت پیسوست ها قرار می گیرد</p>
					</div>
					<a href="<?php echo Yii::app()->createUrl('project/print',array('id' => $model->id)); ?>" title="چاپ اطلاعات"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery/print.png" /></a>
				</div>
			</div>
			</div>
		</div>
	 </div>
</div>