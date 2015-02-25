<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>
<div class="md-content ">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => $id,
        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
        'action' => $action,
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => false,
    )); ?>
    <div class="modal-header">
        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3><?php echo $title; ?></h3>
                </div>
                <?php echo $form->errorSummary($model); ?>


                <div class="tab-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">اطلاعات اولیه</a></li>
                        <li class=""><a href="#profile" data-toggle="tab">اطلاعات تماس</a></li>
                        <li class=""><a href="#messages" data-toggle="tab">موارد دیگر</a></li>
                        <li class=""><a href="#permissions" data-toggle="tab">حق دسترسی</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane cont active" id="home">
                            <h3 class="hthin">اطلاعات اولیه</h3>

                            <div class="form-group">
                                <?php echo $form->label($model, 'username', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'username', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'password', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'password', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'password', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'name', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'name', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'family', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'family', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'family', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'birthday', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'birthday', array('class' => 'date-picker form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'birthday', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                        </div>
                        <div class="tab-pane cont" id="profile">
                            <div class="form-group">
                                <?php echo $form->label($model, 'phone', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'phone', array('class' => 'col-sm-3 control-label parsley-error')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'email', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'email', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                        </div>
                        <div class="tab-pane" id="messages">
                            <div class="form-group">
                                <?php echo $form->label($model, 'type_employee', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'type_employee', CompanyHelper::getTypeOfEmployee(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'type_employee', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->label($model, 'photo', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->fileField($model, 'photo', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'photo', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'id_company', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'id_company', CompanyHelper::getCompaniesList(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'id_company', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="permissions">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'insert_comp', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'insert_comp', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'view_comp', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'view_comp', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'delete_comp', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'delete_comp', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'insert_task', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'insert_task', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'view_task', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'view_task', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'delete_task', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'delete_task', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'insert_proj', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'insert_proj', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'view_proj', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'view_proj', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->label($role, 'delete_proj', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($role, 'delete_proj', array('class' => 'access')); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo $form->label($model, 'active', array('class' => 'col-sm-9 control-label')); ?>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <?php echo $form->checkBox($model, 'active', array('class' => '')); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-9 control-label">دسترسی کامل</label>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="checkAllAccess"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">انصراف</button>
        <button type="button" class="btn btn-default btn-flat"
                onclick="sendAjaxForm('<?php echo $action; ?>','<?php echo $id ?>')">ذخیره
        </button>
    </div>
    <?php $this->endWidget(); ?>
</div>
