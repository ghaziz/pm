<ul class="cbp_tmtimeline">
    <li>
        <?php
        $action = $this->createUrl('comments/edit',$_GET);
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'sendComment',
            'action'=>$action,
            'htmlOptions' => array('class' => 'form-horizontal','validateOnSubmit'=>true ),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // See class documentation of CActiveForm for details on this,
            // you need to use the performAjaxValidation()-method described there.
            'enableAjaxValidation' => false,

        )); ?>
        <div class="comment_icon"><?php echo CHtml::image(Yii::app()->user->image); ?></div>
        <div class="cbp_tmlabel">
            <div class="form-group">
                <h3>ویرایش نظر</h3>
            </div>
            <div class="form-group">
                <?php echo $form->textArea($model, 'context', array('class' => 'form-control','rows'=>'4')); ?>
            </div>
            <div class="form-group">
                <button type="submit"class="pull-left btn btn-success">ویرایش<i class="fa fa-arrow-left"></i></button>
            </div>

        </div>
    </li>
    <?php $this->endWidget(); ?>
</ul>