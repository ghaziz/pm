
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
										<td>درصد تسک از کل پروژه</td>
										<td class="text-center primary-emphasis"><?php echo $model->percent_of_all; ?></td>
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
										<td>وضعیت پروژه</td>
										<td class="text-center primary-emphasis"><?php echo PM::getTypeOfStatus($model); ?></td>
									</tr>
									<tr>
										<td>درصد پیشرفت پروژه</td>
										<td class="text-center primary-emphasis"><?php echo $model->percent_prog ? $model->percent_prog."%" : 'نامشخص'; ?></td>
									</tr>	
									<tr>
										<td>تسک متعلق به این پروژه می باشد</td>
										<td class="text-center primary-emphasis"><?php echo PM::getProjectName($model->id_project); ?></td>
									</tr>
									<tr>
										<td>تسک متعلق به این گروه می باشد</td>
										<td class="text-center primary-emphasis"><?php echo PM::getGroupName($model->id_group); ?></td>
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
					<a href="<?php echo Yii::app()->createUrl('task/print',array('id' => $model->id)); ?>" title="چاپ اطلاعات"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery/print.png" /></a>
		         </div>
	           </div>
			</div>
		</div>
	 </div>
	
</div>