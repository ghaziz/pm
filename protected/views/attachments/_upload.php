<div class="md-content ">
    <div class="modal-header">
        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
    <div class="pm-upload">
        <h3>افزودن پیوست</h3>
    <form action="#" class="demo_form">
        <div class="dropped"></div>

        <div class="filelists">
            <h5>کامل شده</h5>
            <table class="filelist complete">
                <thead><tr>
                    <th>نام فایل</th>
                    <th>نوع فایل</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                </tr></thead>
                <tbody></tbody>
            </table>
            <h5>در انتظار</h5>
            <ol class="filelist queue">
            </ol>
        </div>
    </form>
    <script type="text/javascript">
        $filesAction = '<?php echo $fileAction ;?>';
        $maxFileSize = <?php echo isset($maxFileSize)?$maxFileSize:1024*1024;?>;
    </script>
</div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat md-close btn-block" data-dismiss="modal">بستن</button>
    </div>