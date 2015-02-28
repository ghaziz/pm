<?php
	if ($message != "")
	{ ?>
	<div class="block-flat">
	  <div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<i class="fa fa-times-circle sign"></i>
		<strong>خطا!</strong> <?php echo $message; ?>
	  </div>
     </div>
	 <?php
	}
	else{ ?>
<div class="block-flat">
	<div class="header">
        <h3>لیست تسک های متعلق به گروه<span class="badge badge-primary"><?php echo $title; ?></span></h3>
    </div>
	<div class="content">
	   <div class="form-group">
          <div class="col-sm-6">
                  <input type="search" class="light-table-filter form-control" data-table="order-table" placeholder="جستجو کنید..." style="margin-right:-12px;">
          </div>
       </div>
		<table class="order-table" name="order-table">
            <thead>
            <tr class="text-center primary-emphasis">
                <th >کد تسک</th>
                <th >عنوان</th>
                <th>تاریخ شروع</th>
                <th>تاریخ پایان</th>
                <th>وضعیت</th>
                <th>پروژه</th>
                <th>گروه</th>
                <th>درصد پیشرفت</th>
				<th>روزهای باقیمانده</th>
				<th>تعداد نظرات</th>
                <th>عملیات</th>
            </tr>
            </thead>
			 <tbody>
				<?php
				if(!is_array($model)){$model = array($model);}
				if($model != null){
				foreach($model as $task){
					$printable = array('id','title','start_time','end_time','status','id_project','id_group','percent_prog');
					?><tr id="<?php echo 'u'.$task->id; ?>">
						<?php
							foreach($printable as $field){
								$value = ' ';
								switch($field){
									case 'start_time' : $value = Yii::app()->jdate->date('Y/m/d',$task->$field);break;
									case 'end_time' : $value = Yii::app()->jdate->date('Y/m/d',$task->$field);break;
									case 'status' : 
									$value = PM::getTypeOfStatus($task);
									if($task->confirm_status == 1) 
										//$value .= "<a href='' onclick='confirmDelete(".echo $this->createUrl('project/del').",".echo $project->id.","u" )'></a>";
										$value .="<br/><a href=''>تایید</a>--<a href=''>عدم تایید</a>";
									break;
									case 'id_project' : $value = PM::getProjectName($task->$field);break;
									case 'id_group' : $value = PM::getGroupName($task->$field);break;
									case 'percent_prog' : $value = $task->$field ? $task->$field."%" : 'نامشخص';break;
									default      : $value = $task->$field;
								}
							?>
								<td><?php echo $value; ?></td>
							<?php
							}
							?>
							<?php 
								$month=PM::remain_days(time(),$task->end_time);
							?>
							<td><?php echo $month; ?></td>
							<td></td>
							<td>								
								<a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('task/edit_group',array('id'=>$task->id))?>')"><i class="fa fa-edit"></i></a>
								<a href="" onclick="confirmDelete('<?php echo $this->createUrl('task/delgroup')?>','<?php echo $task->id?>','u')" title="حذف پروژه"><i class="fa fa-times"></i></a>                               
							</td>
					</tr>
				<?php
				}
				}
				else{
					echo "<tr><td>تسکی برای این گروه تعریف نشده است</td></tr>";
				}
				?>
			 </tbody>
			
		</table>
	</div>	
</div>
<?php } ?>