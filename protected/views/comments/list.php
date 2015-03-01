<div class="header">
    <h3>نظرات <?php echo $_GET['title']; ?></h3>
    <hr/>
</div>
<ul class="cbp_tmtimeline">
<?php foreach($model as $comment){ 
	$comment->read = CommentHelper::READ;
	$comment->update(false);
?>
	
    <li id="<?php echo "comment-".$comment->id; ?>">
        <time class="cbp_tmtime"><span><?php echo Yii::app()->jdate->date('Y/m/d h:m:s',$comment->time); ?></span> <span><?php echo UserHelper::getDisplayName($comment->user->id); ?></span></time>
        <div class="comment_icon"><?php echo CHtml::image($comment->user->photo) ; ?></div>
        <div class="cbp_tmlabel">
            <div class="context" id="<?php echo "context-".$comment->id; ?>">
                <?php echo $comment->context; ?>
<!--                --><?php //echo CHtml::encode($comment->context); ?>
            </div>

            <div class="comment-panel">
                <a href="#" onclick="ansComment('<?php echo $comment->id;?>')" title="پاسخ به این نظر"><i class="fa fa-reply"></i></a>
                <?php if(RoleHelper::checkCommentsAccess('edit',$comment,$this,false)) {?>
                <a href="<?php echo $this->createUrl('comments/edit',array('id'=>$comment->id,'bind_type'=>$_GET['bind_type'],'bind_id'=>$_GET['bind_id'],'title'=>$_GET['title'])); ?>" title="ویرایش نظر"><i class="fa fa-edit"></i></a>
                <a href="#" onclick="confirmDelete(
                '<?php echo $this->createUrl('comments/del',array('id'=>$comment->id)) ?>',
                    '<?php echo $comment->id; ?>',
                    'comment-'
                )" title="حذف نظر"><i class="fa fa-times"></i></a>
                <?php } ?>
            </div>

        </div>
    </li>
<?php } ?>
    <li>
    <?php
    $action = $this->createUrl('comments/new',$_GET);
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
            <h3>ارسال نظر جدید</h3>
        </div>
            <div class="form-group">
                    <?php echo $form->textArea($newModel, 'context', array('class' => 'form-control','rows'=>'4')); ?>
            </div>
            <div class="form-group">
                <button type="submit"class="pull-left btn btn-success">ارسال<i class="fa fa-arrow-left"></i></button>
<!--                onclick="sendAjaxForm('--><?php //echo $action;?><!--','sendComment')"-->
            </div>

        </div>
    </li>
    <?php $this->endWidget(); ?>
</ul>