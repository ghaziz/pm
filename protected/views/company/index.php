<div class="block-flat">
    <div class="header">
        <h3>لیست کامل شرکت ها</h3>
    </div>
    <div class="content">
        <table>
            <thead>
            <tr>
                <th >نام شرکت</th>
                <th>نوع شرکت</th>
                <th>مدیر عامل</th>
                <th>تلفن</th>
                <th>فکس</th>
                <th>تلفن مدیر</th>
                <th>آگهی تاسیس</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($model as $company){?>
                <tr id="<?php echo "company-".$company->id; ?>">
                    <?php
            $printable = array('title','type','chief','phone','fax','phone_head','foundation_notice');
            foreach($printable as $field){
                $value = ' ';
                switch($field){
                    case 'type'  : $value = CompanyHelper::getTypeOfCompany($company->$field);break;
                    case 'chief' : $value = CompanyHelper::getChiefOfCompany($company->user_id);break;
                    case 'foundation_notice' : $value = CHtml::link('دانلود',$company->$field);break;
                    default      : $value = $company->$field;
                }
                ?>
                <td><?php echo $value; ?></td>
            <?php }?>
                <td>
                    <a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('company/edit',array('id'=>$company->id))?>')"><i class="fa fa-edit"></i></a>
                </td>
                </tr><?php } ?>
            </tbody>
        </table>
    </div>
</div>