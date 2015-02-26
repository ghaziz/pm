
<div class="md-content ">
	<div class="modal-header">
        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
	 <div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="header">
                    <h3><?php CHtml::image($model->photo,'user photo',array('style'=>'width:20px')); ?></h3>
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
										<td>کد کاربری</td>
										<td class="text-center primary-emphasis"><?php echo $model->id; ?></td>
									</tr>
									<tr>
										<td>نام</td>
                                        <td class="text-center primary-emphasis"><?php echo  $model->name;; ?></td>
									</tr>
									<tr>
										<td>نام خانوادگی</td>
										<td class="text-center primary-emphasis"><?php echo  $model->family;; ?></td>
									</tr>
									<tr>
										<td>نام کاربری</td>
										<td class="text-center primary-emphasis"><?php echo $model->username; ?></td>
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
										<td>ایمیل</td>
                                        <td class="text-center primary-emphasis"><?php echo $model->email; ?></td>
									</tr>		
									<tr>
										<td>نوع کارمند</td>
										<td class="text-center primary-emphasis"><?php echo CompanyHelper::getTypeOfEmployee($model->type_employee); ?></td>
									</tr>
									<tr>
										<td>فعال</td>
										<td class="text-center primary-emphasis"><?php echo $model->active==1 ? "بله" : 'خیر'; ?></td>
									</tr>	
									<tr>
										<td>زمان ثبتنام</td>
										<td class="text-center primary-emphasis"><?php echo Yii::app()->jdate->date('Y/m/d',$model->time); ?></td>
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