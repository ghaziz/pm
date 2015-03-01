<div class="block-flat">
	<div class="header">
        <h3>لسیت پروژه ها</h3>
    </div>
	<div class="content">
	<!--1.0.2 added filter-->
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
						     <li><a href="<?php echo Yii::app()->createUrl('project/index',array('status' => ProjectHelper::OPEN)); ?>">پروژه های باز</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('project/index',array('status' => ProjectHelper::COMPLETED)); ?>">پروژه های بسته</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('project/index',array('status' => ProjectHelper::ON_HOLD )); ?>">پروژه های متوقف شده</a></li>
							 <li><a href="<?php echo Yii::app()->createUrl('project/index',array('status' => ProjectHelper::CANCELLED)); ?>">پروژه های کنسل شده</a></li>
							 <li class="divider"></li>
							<li><a href="<?php echo Yii::app()->createUrl('project/index'); ?>">نمایش همه ی پروژه ها</a></li>
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
						     <li><a href="<?php echo Yii::app()->createUrl('project/index',array('order' => 'time')); ?>">زمان</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('project/index',array('order' => 'id_company')); ?>">شرکت</a></li>
						     <li><a href="<?php echo Yii::app()->createUrl('project/index',array('order' => 'price' )); ?>">هزینه</a></li>
							 <li><a href="<?php echo Yii::app()->createUrl('project/index',array('order' => 'percent_prog' )); ?>">درصد پیشرفت</a></li>
							 <li class="divider"></li>
							<li><a href="<?php echo Yii::app()->createUrl('project/index'); ?>">نمایش همه ی پروژه ها</a></li>
						  </ul>
					</div>	
           </div>
        </div>
		<table class="order-table" name="order-table">
            <thead>
            <tr class="text-center primary-emphasis">
                <th >کد پروژه</th>
                <th >عنوان</th>
                <th>تاریخ شروع</th>
                <th>تاریخ پایان</th>
                <th>وضعیت</th>
                <th>شرکت مجری</th>
                <th>پیمان کار ناظر</th>
                <th>درصد پیشرفت</th>
				<th>روزهای باقیمانده</th>
				<th>تعداد نظرات</th>
                <th>عملیات</th>
            </tr>
            </thead>
			 <tbody>
				<?php
					if(!is_array($model)){$model = array($model);}
					 foreach($model as $project){
						$printable = array('id','title','start_time','end_time','status','id_company','user_id','percent_prog');
						?><tr id="<?php echo 'u'.$project->id; ?>"><?php
							 foreach($printable as $field){
								$value = ' ';
								 switch($field){
									case 'title' : $value = "<a href='".Yii::app()->createUrl('task/projecttask',array('id' => $project->id, 'title' => $project->title))."' title='مشاهده ی تسک های پروژه'>".$project->$field."</a>";break;
									case 'start_time' : $value = Yii::app()->jdate->date('Y/m/d',$project->$field);break;
									case 'end_time' : $value = Yii::app()->jdate->date('Y/m/d',$project->$field);break;
									case 'status' : 
									$value = PM::getTypeOfStatus($project);
									if($project->confirm_status == 1) 
										//$value .= "<a href='' onclick='confirmDelete(".echo $this->createUrl('project/del').",".echo $project->id.","u" )'></a>";
										$value .="<br/><a href=''>تایید</a>--<a href=''>عدم تایید</a>";
									break;
									case 'id_company' : $value = PM::getCompanytitle($project->$field);break;
									case 'user_id' : $value = PM::getUserName($project->$field);break;
                                     case 'percent_prog' : $value ='<div class=\'progress\'><div class=\'progress-bar progress-bar-success\' style=\'width:'.$project->$field.'%\'>'.$project->$field.'%</div></div>';break;
									case 'price' : $value = $project->$field ? $project->$field."ریال" : 'نامشخص';break;
									default      : $value = $project->$field;							
								 }
								 ?>
								 <td><?php echo $value; ?></td>
								 
							<?php  
								}
								$month=PM::remain_days(time(),$project->end_time);
							?>
							<td><?php echo  $month; ?></td>
							<td><a href="<?php echo  $this->createUrl('comments/list',array('bind_type'=>'projects','bind_id'=>$project->id,'title'=>$project->title)); ?>" title="تعداد نظرات"><span class="badge badge-danger"><?php echo PM::count_cmnt('projects',$project->id);  ?></span></a> </td>
							<td>
								<a title="اظلاعات کامل پروژه" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('project/info',array('id'=>$project->id))?>')"><i class="fa fa-eye"></i></a>
								<a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('project/edit',array('id'=>$project->id))?>')"><i class="fa fa-edit"></i></a>
								<a href="" onclick="confirmDelete('<?php echo $this->createUrl('project/del')?>','<?php echo $project->id?>','u')" title="حذف پروژه"><i class="fa fa-times"></i></a>
								<a href="" onclick="showModal('<?php echo $this->createUrl('attachments/index',array('bind_type'=>'projects','bind_id'=>$project->id))?>')" title="افزودن پیوست"><i class="fa fa-cloud-upload"></i></a>
								<a href="<?php echo $this->createUrl('attachments/list',array('bind_type'=>'projects','bind_id'=>$project->id,'title'=>$project->title));?>" title="پیوست ها"><i class="fa fa-cloud-download"></i></a>
								<a href="<?php echo $this->createUrl('comments/list',array('bind_type'=>'projects','bind_id'=>$project->id,'title'=>$project->title));?>" title="نظرات"><i class="fa fa-comments"></i></a>
							</td>
						</tr>
				<?php } ?>
			 </tbody>
		</table>
	</div>
</div>