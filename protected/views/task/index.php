<div class="block-flat">
	<div class="header">
        <h3>لیست تسک ها</h3>
    </div>
	<div class="content">
	   <div class="form-group">
          <div class="col-sm-6">
                  <input type="search" class="light-table-filter form-control" data-table="order-table" placeholder="جستجو کنید..." style="margin-right:-12px;">
          </div>
		   <div class="col-sm-3">
                  	<div class="btn-group">
						 <button type="button" class="btn btn-default">فیلتر براساس</button>
						 <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
						  <span class="caret"></span>
						  <span class="sr-only">تغییر وضعیت منوی کشویی</span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
						     <li><a href="<?php echo Yii::app()->createUrl('task/index',array('status' => TaskHelper::OPEN)); ?>">تسک های باز</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('task/index',array('status' => TaskHelper::COMPLETED)); ?>">تسک های بسته</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('task/index',array('status' => TaskHelper::ON_HOLD )); ?>">تسک های متوقف شده</a></li>
							 <li><a href="<?php echo Yii::app()->createUrl('task/index',array('status' => TaskHelper::CANCELLED)); ?>">تسک های کنسل شده</a></li>
							 <li class="divider"></li>
							<li><a href="<?php echo Yii::app()->createUrl('task/index'); ?>">نمایش همه ی تسک ها</a></li>
						  </ul>
					</div>	
			</div>
		   	 <div class="col-sm-3">
                  	<div class="btn-group">
						 <button type="button" class="btn btn-default">مرتب سازی براساس</button>
						 <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
						  <span class="caret"></span>
						  <span class="sr-only">تغییر وضعیت منوی کشویی</span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
						     <li><a href="<?php echo Yii::app()->createUrl('task/index',array('order' => 'time')); ?>">زمان</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('task/index',array('order' => 'id_project')); ?>">پروژه</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('tsak/index',array('order' => 'id_group' )); ?>">گروه</a></li>
							 <li><a href="<?php echo Yii::app()->createUrl('task/index',array('order' => 'percent_prog' )); ?>">درصد پیشرفت</a></li>
							 <li class="divider"></li>
							<li><a href="<?php echo Yii::app()->createUrl('project/index'); ?>">نمایش همه ی تسک ها</a></li>
						  </ul>
					</div>	
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
                                    case 'percent_prog' : $value ='<div class=\'progress\'><div class=\'progress-bar progress-bar-success\' style=\'width:'.$task->$field.'%\'>'.$task->$field.'%</div></div>';break;
                                        break;
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
                                <a href="" onclick="showModal('<?php echo $this->createUrl('attachments/index',array('bind_type'=>'tasks','bind_id'=>$task->id))?>')" title="افزودن پیوست"><i class="fa fa-cloud-upload"></i></a>
                                <a href="<?php echo $this->createUrl('attachments/list',array('bind_type'=>'tasks','bind_id'=>$task->id,'title'=>$task->title));?>" title="پیوست ها"><i class="fa fa-cloud-download"></i></a>
							</td>
					</tr>
				<?php
				}
				?>
			 </tbody>
			
		</table>
	</div>	
</div>