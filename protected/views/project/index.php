<div class="block-flat">
	<div class="header">
        <h3>لسیت پروژه ها</h3>
    </div>
	<div class="content">
		<table>
            <thead>
            <tr>
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
									case 'percent_prog' : $value = $project->$field ? $project->$field."%" : 'نامشخص';break;
									case 'price' : $value = $project->$field ? $project->$field."ریال" : 'نامشخص';break;
									default      : $value = $project->$field;							
								 }
								 ?>
								 <td><?php echo $value; ?></td>
								 
							<?php } ?>
							<td><?php echo $project->end_time - $project->start_time; ?></td>
							<td></td>
							<td>
								<a title="اظلاعات کامل پروژه" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('project/info',array('id'=>$project->id))?>')"><i class="fa fa-eye"></i></a>
								<a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('project/edit',array('id'=>$project->id))?>')"><i class="fa fa-edit"></i></a>
								<a href="" onclick="confirmDelete('<?php echo $this->createUrl('project/del')?>','<?php echo $project->id?>','u')" title="حذف پروژه"><i class="fa fa-times"></i></a>
								<a href="" onclick="showModal('<?php echo $this->createUrl('attachments/index',array('bind_type'=>'projects','bind_id'=>$project->id))?>')" title="افزودن پیوست"><i class="fa fa-cloud-upload"></i></a>
								<a href="<?php echo $this->createUrl('attachments/list',array('bind_type'=>'projects','bind_id'=>$project->id,'title'=>$project->title));?>" title="پیوست ها"><i class="fa fa-cloud-download"></i></a>
							</td>
						</tr>
				<?php } ?>
			 </tbody>
		</table>
	</div>
</div>