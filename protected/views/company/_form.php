<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>
<div class="md-content ">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => $id,
        'htmlOptions' => array('class' => 'form-horizontal','enctype'=>'multipart/form-data' ),
        'action'=>$action,
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
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane cont active" id="home">
                            <h3 class="hthin">اطلاعات اولیه</h3>
                            <div class="form-group">
                                <?php echo $form->label($model, 'title', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'title', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'title', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'type', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'type',CompanyHelper::getTypeOfCompany(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'type', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'addr', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'addr', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'addr', array('class' => 'col-sm-3 control-label parsley-error')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'email', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'email', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                        </div>
                        <div class="tab-pane cont" id="profile">
                            <div class="form-group">
                                <?php echo $form->label($model, 'phone', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'phone', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->label($model, 'fax', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'fax', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'fax', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'phone_head', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'phone_head', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'phone_head', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages">

                            <div class="form-group">
                                <?php echo $form->label($model, 'year_foundation', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'year_foundation', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'year_foundation', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'website', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'website', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'website', array('class' => 'col-sm-3 control-label')); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label($model, 'foundation_notice', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->fileField($model, 'foundation_notice', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'foundation_notice', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">انصراف</button>
        <button type="button" class="btn btn-default btn-flat" onclick="sendAjaxForm('<?php echo $action;?>','<?php echo $id;?>')" >ذخیره</button>
    </div>
    <?php $this->endWidget(); ?>
</div>
