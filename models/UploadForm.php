<?php 
namespace app\modules\oac\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg , pdf'],
        ];
    }
    
    public function upload($idcaso)
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName .'_'.$idcaso. '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}