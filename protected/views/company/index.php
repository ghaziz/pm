<div class="block-flat">
    <div class="header">
        <h3>لیست کامل شرکت ها</h3>
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
                    case 'chief' : $value = CompanyHelper::getChiefOfCompany($company->id);break;
                    case 'foundation_notice' : $value = CHtml::link('دانلود',$company->$field);break;
                    default      : $value = $company->$field;
                }
                ?>
                <td><?php echo $value; ?></td>
            <?php }?>
                <td>
                    <a title="اطلاعات کامل شرکت" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('company/info',array('id'=>$company->id))?>')"><i class="fa fa-eye"></i></a>
                    <a title="ویرایش" href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('company/edit',array('id'=>$company->id))?>')"><i class="fa fa-edit"></i></a>
                    <a href="" onclick="confirmDelete('<?php echo $this->createUrl('company/del')?>','<?php echo $company->id?>','u')" title="حذف شرکت"><i class="fa fa-times"></i></a>
                </td>
                </tr><?php } ?>
            </tbody>
        </table>
    </div>
</div>