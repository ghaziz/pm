<?php

/**
 * Created by Ebrahim.
 * User: x7
 * Date: 6/12/14
 * Time: 9:42 PM
 */
class FileUploader
{
    const _DIRECTORY_ADDRESS = "assets/attachments/";
    const MAX_FILE_SIZE = 1048576; //1M
    private $hasErr = false;
    private $errors = array();

    public function FileUploader()
    {
        $this->hasErr = false;
    }

    public function  upload($data)
    {
        //Check file is empty!
        if ($data['error'] == UPLOAD_ERR_NO_FILE) {
            echo json_encode(array('status'=>Status::ERROR,'msg'=>'فایل خالی است.'));
        } else {
            if ($this->isValidExtension($data['type'])) {
                if ($data['size'] <= FileUploader::MAX_FILE_SIZE) {
                    $ext = $this->getFileExtension($data['type'], $data['name']);
                    if($ext=='unknown'){echo json_encode(array('status'=>Status::ERROR,'msg'=>'نوع فایل غیر مجاز است'));}
                    $time = time();
                    $fileName = FileUploader::_DIRECTORY_ADDRESS . "attachment-" . $time . "." . $ext;
                    if (move_uploaded_file($data['tmp_name'], $fileName)) {
                        return $fileName;
                    }else{
                        return null;
                    }
                } else {
                    $this->addError('حجم فایل تصویر تا 1 مگ بایت مجاز است');
                }
            } else {
                $this->addError('نوع فایل غیر مجاز است.');
            }
        }
    }

    private function  addError($msg)
    {
        $this->hasErr = true;
        array_push($this->errors, $msg);
    }

    public function hasError()
    {
        return $this->hasErr;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getLastError()
    {
        return $this->errors[0];
    }

    private function  isValidExtension($ext)
    {
        $acceptableExtenstions = array("image/gif", "image/jpeg", "image/jpg", "image/x-png", "image/png", "application/octet-stream");
        return in_array($ext, $acceptableExtenstions);
    }

    private function getFileExtension($ext, $name)
    {
        switch ($ext) {
            case  "image/gif" :
                return "gif";
            case  "image/jpeg" :
                return "jpg";
            case  "image/jpg" :
                return "jpg";
            case  "image/x-png" :
                return "png";
            case  "image/png" :
                return "png";
            case
            "application/octet-stream":
                if (substr($name, -4) == '.zip')
                    return "zip";
                break;
                return "unknown";
        }
    }
}