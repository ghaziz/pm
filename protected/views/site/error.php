<?php /* edited by ebrahim ver 1.1*/?>
<p class="text-center">خطایی رخ داده!</p>
<div class="block-flat danger-box">
    <div class="header">
        <h3 class="number text-center"><?php echo $code; ?></h3>
    </div>
    <div class="content">
        <h5 class="description text-center"><?php echo CHtml::encode($message); ?></h5>
    </div>
</div>