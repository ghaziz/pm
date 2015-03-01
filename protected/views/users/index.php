<div class="block-flat">
    <div class="header">
        <h3>لیست کاربران</h3>
    </div>
    <div class="content">
        <table>
            <thead>
            <tr>
                <th >کد کاربری</th>
                <th >عکس</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>تلفن</th>
                <th>ایمیل</th>
                <th>نوع کارمند</th>
                <th>شرکت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if(!is_array($model)){$model = array($model);}
            foreach($model as $user){
            $printable = array('id','photo','name','family','phone','email','type_employee','idCompany');
                ?><tr id="<?php echo 'u'.$user->id; ?>"><?php
            foreach($printable as $field){
                $value = ' ';
                switch($field){
                    case 'photo'  : $value = CHtml::image($user->$field,$user->name,array('class'=>'image-responsive','id'=>'up'.$user->id,'style'=>'width:50px'));break;
                    case 'type_employee' : $value = CompanyHelper::getTypeOfEmployee($user->$field);break;
                    case 'idCompany' : $value = CompanyHelper::getCompanyName($user->$field);break;
                    default      : $value = $user->$field;
                }
                ?>
                <td><?php echo $value; ?></td>
            <?php }?>
                <td>
                    <a title="اطلاعات کامل کاربر" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('users/info',array('id'=>$user->id))?>')"><i class="fa fa-eye"></i></a>
                    <a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('users/edit',array('id'=>$user->id))?>')"><i class="fa fa-edit"></i></a>
                    <a href="" onclick="confirmDelete('<?php echo $this->createUrl('users/del')?>','<?php echo $user->id?>','u')" title="غیر فعال کردن کاربر"><i class="fa fa-times"></i></a>
                    <a href="" title="حذف عکس کاربر" onclick="confirmDelete('<?php echo $this->createUrl('users/delPic')?>','<?php echo $user->id?>','up')"><i class="fa fa-eraser"></i></a>

                </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>