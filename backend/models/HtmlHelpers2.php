<?php

namespace backend\models;

class HtmlHelpers2 {

    public static function dropDownList($model, $parent_model_id, $id, $second_parent, $id2, $value, $string)
    {
        $rows = $model::find()->where(['espadre'=>false,$parent_model_id => $id, $second_parent=>$id2])->all();

        $droptions = "<option></option>";

        if(count($rows)>0){
            foreach($rows as $row){
                $droptions .= '<option value='.$row->$value.'>'.$row->$string.'</option>';
            }
        }
        else{
            $droptions .= "<option>No result</option>";
        }

        return $droptions;
    }

}






/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

