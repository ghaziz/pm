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
						<li class=""><a href="#extra" data-toggle="tab">اطلاعات تماس</a></li>
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
										<td>شناسه شرکت</td>
										<td class="text-center primary-emphasis"><?php echo $model->id; ?></td>
									</tr>
									<tr>
										<td>نام شرکت</td>
										<td class="text-center primary-emphasis"><?php echo $model->title; ?></td>
									</tr>
									<tr>
										<td>زمان ایجاد</td>
										<td class="text-center primary-emphasis"><?php echo PM::getJalali($model->time); ?></td>
									</tr>
									<tr>
                                        <td>سال تاسیس</td>
										<td class="text-center primary-emphasis"><?php echo $model->year_foundation; ?></td>
									</tr>	
									<tr>
										<td>نوع شرکت</td>
										<td class="text-center primary-emphasis"><?php echo CompanyHelper::getTypeOfCompany($model->type); ?></td>
									</tr>
				    				<tr>
										<td>رییس شرکت</td>
										<td class="text-center primary-emphasis"><?php echo CompanyHelper::getChiefOfCompany($model->id); ?></td>
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
										<td>تلفن</td>
										<td class="text-center primary-emphasis"><?php echo $model->phone;?></td>
									</tr>	
									<tr>
										<td>فکس</td>
										<td class="text-center primary-emphasis"><?php echo $model->fax; ?></td>
									</tr>	
									<tr>
										<td>ایمیل</td>
										<td class="text-center primary-emphasis"><?php echo $model->email; ?></td>
									</tr>
                                    <tr>
                                        <td>وب سایت</td>
                                        <td class="text-center primary-emphasis"><?php echo $model->website; ?></td>
                                    </tr>
                                    <tr>
                                        <td>آدرس</td>
                                        <td class="text-center primary-emphasis"><?php echo $model->addr; ?></td>
                                    </tr>
                                    <tr>
										<td>آگهی تاسیس</td>
										<td class="text-center primary-emphasis"><?php CHtml::link('دانلود',$model->foundation_notice)?></td>
									</tr>
								</tbody>
							</table>
						  </div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	 </div>
</div>