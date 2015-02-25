
<div class="md-content ">
	<div class="modal-header">
        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
	 <div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="header">
                    <h3>اطلاعات پروژه</h3>
                </div>
					<div class="block-flat">
						<div class="header">							
							<h3><?php echo $model->title; ?></h3>
						</div>
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
										<td>تعداد روزهای باقی مانده</td>
										<td class="text-center primary-emphasis"><?php echo $model->end_time - $model->start_time; ?></td>
									</tr>	
									<tr>
										<td>تاریخ ثبت پروژه</td>
										<td class="text-center primary-emphasis"><?php echo PM::getJalali($model->time); ?></td>
									</tr>
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
										<td>کارفرمای ناظر بر پروژه</td>
										<td class="text-center primary-emphasis"><?php echo PM::getUserName($model->user_id); ?></td>
									</tr>
									<tr>
										<td>توضیحات</td>
										<td class="text-center primary-emphasis"><?php echo $model->description; ?></td>
									</tr>										
							</table>						
						</div>
					</div>
			</div>
		</div>
	 </div>
	
</div>