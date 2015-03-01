<div class="block-flat">
	<div class="header">
        <h3>لیست گروه های تسک</h3>
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
                <th >کد گروه</th>
                <th >عنوان</th>
                <th>تاریخ ایجاد</th>
				<th>توضیحات</th>
                <th>کاربر ایجاد کننده</th>
                <th>عملیات</th>
            </tr>
            </thead>
			 <tbody>
				<?php
				if(!is_array($model)){$model = array($model);}
				foreach($model as $task){
					$printable = array('id','title','time','description','user_id');
					?><tr id="<?php echo 'u'.$task->id; ?>">
						<?php
							foreach($printable as $field){
								$value = ' ';
								switch($field){
									case 'title' : $value = "<a href='".Yii::app()->createUrl('task/grouptask',array('id' => $task->id, 'title' => $task->title))."' title='مشاهده ی تمام تسک های گروه'>".$task->$field."</a>";break;
									case 'time' : $value = Yii::app()->jdate->date('Y/m/d',$task->$field);break;
									case 'user_id' : $value = $task->user->name." ".$task->user->family;break;
									default      : $value = $task->$field;
								}
							?>
								<td><?php echo $value; ?></td>
							<?php
							}
							?>
							<td>								
								<a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('task/edit_group',array('id'=>$task->id))?>')"><i class="fa fa-edit"></i></a>
								<a href="" onclick="confirmDelete('<?php echo $this->createUrl('task/delgroup')?>','<?php echo $task->id?>','u')" title="حذف پروژه"><i class="fa fa-times"></i></a>                               
							</td>
					</tr>
				<?php
				}
				?>
			 </tbody>
			
		</table>
	</div>	
</div>