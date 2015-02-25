<div class="block-flat">
	<div class="header">
        <h3>لیست تسک ها</h3>
    </div>
	<div class="content">
		<table>
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
								<a title="اظلاعات کامل پروژه" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('task/info',array('id'=>$task->id))?>')"><i class="fa fa-eye"></i></a>
								<a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('task/edit',array('id'=>$task->id))?>')"><i class="fa fa-edit"></i></a>
								<a href="" onclick="confirmDelete('<?php echo $this->createUrl('task/del')?>','<?php echo $task->id?>','u')" title="حذف پروژه"><i class="fa fa-times"></i></a>
							</td>
					</tr>
				<?php
				}
				?>
			 </tbody>
			
		</table>
	</div>	
</div>