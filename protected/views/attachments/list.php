<div class="block-flat">
    <div class="header">
        <h3>لیست پیوست های <?php echo $title; ?></h3>
    </div>
    <div class="content">
        <table>
            <thead>
            <tr>
                <th >کد پیوست</th>
                <th>نوع فایل</th>
                <th>تاریخ پیوست</th>
                <th>توسط</th>
                <th>توضیحات</th>
                <th>دانلود</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($model as $attachment){
                $action = Yii::app()->createUrl('attachments/updateTypeAndDescription', array(
                    'attachmentsId' => $attachment->id,
                ));
                ?>
            <tr id="<?php echo "up".$attachment->id; ?>">
                <?php
                $printable = array('id','file_type','time','user_id','description','file');
                foreach($printable as $field){
                    $value = ' ';
                    switch($field){
                        case 'file_type'  : $value = AttachmentsHelper::availableTypeForBoundedFiles($attachment->bind_type,$attachment->$field);break;
                        case 'time' : $value = Yii::app()->jdate->date('Y/m/d',$attachment->$field);break;
                        case 'user_id' : $value = UserHelper::getDisplayName($attachment->$field);break;
                        case 'description' : $value = CHtml::textArea('desc',$attachment->$field);break;
                        case 'file' : $value = CHtml::link('دانلود',$attachment->$field);break;
                        default      : $value = $attachment->$field;
                    }
                    ?>
                    <td><?php echo $value; ?></td>
                <?php }?>
                <td>
                    <a title="ذخیره" href="#" onclick="UpdateTypeAndDescription('<?php echo $action;?>','<?php echo $attachment->id;?>')"><i class="fa fa-save"></i></a>
                    <a href="#" onclick="confirmDelete('<?php echo $this->createUrl('attachment/del')?>','<?php echo $attachment->id?>','u')" title="حذف پیوست"><i class="fa fa-times"></i></a>
                </td>
                </tr><?php } ?>
            </tbody>
        </table>
    </div>
</div>