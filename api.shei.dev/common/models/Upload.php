<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Upload extends ActiveRecord {
    public $imageFile;
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

     public static function render_input_upload($form, $model, $field_name, $delete = true)
    {



        $r = $form->field($model, $field_name)->FileInput(['maxlength' => true]);
        if ($delete)
            $r .= "<br>" . $form->field($model, $field_name . "_del")->checkbox(['value' => "1"]);
        return $r;
    }

    public static function delete_upload($model, $field_name, $form_field)
    {

        if ($model->{$form_field . "_del"}) {
            $model->{$field_name} = null;
        }
        return $model;
    }

    public static function Upload___($model, $field_name, $form_field, $basfname = "uploads/")
    {


        $backup = $model->{$field_name};

        $model->{$form_field} = UploadedFile::getInstance($model, $form_field);

        if ($model->{$form_field}->basename) {



            $t =  time();

            $model->{$form_field}->saveAs($basfname . $t . $field_name . '.' . $model->{$form_field}->extension);
            $model->{$field_name} = $basfname . $t . $field_name . '.' . $model->{$form_field}->extension;

            //echo $model->{$form_field}."KKKK";
        }




        //exit();

        return $model;
    }

}