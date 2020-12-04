<?php
namespace App\Entities;
use CodeIgniter\Entity;

class BaseEntity extends Entity{

    public function _get($field, $isFullName = false){
        if (!$isFullName) {
            $field = $this->model->table."_".$field;
        }
        if (isset($this->attributes[$field])) {
            if (isset($this->attributes[$field]["custom_get"])) {
                $function = $this->attributes[$field]["custom_get"];
                return $this->$function();
            }
            return $this->attributes[$field];
        }
        if (!isset($this->$field)) {
            return $this->$field;
        }
        return "";
    }

    public function _set($field, $value, $isFullName = false){
        if (!$isFullName) {
            $field = $this->model->table."_".$field;
        }
        if (isset($this->attributes[$field])) {
            if (isset($this->attributes[$field]["custom_get"])) {
                $function = $this->attributes[$field]["custom_get"];
                $this->$function($value);
            }
            $this->attributes[$field] = $value;
        }
        $this->$field = $value;
    }

    public function _id(){
        if (!empty($this->model)) {
            if (!empty($this->model->primaryKey)) {
                $key = $this->model->primaryKey;
                if (!empty($this->$key)) {
                    return $this->$key;
                } else {
                    if (isset($this->attributes[$key])) {
                        $this->$key = $this->attributes[$key];
                        return $this->$key;
                    }
                }
            }
        }
        return 0;
    }

    public function _getOptions($field, $default = false, $isFullName = false, $sort = ""){
        if (!$isFullName) {
            $field = $this->model->table."_".$field;
        }
        if(!isset($this->fields[$field])){
            return "<option>Field not found</option>";
        }
        if(!isset($this->fields[$field]["options"])){
            return "<option>Options declaration not found</option>";
        }
        $options = $this->fields[$field]["options"];
        if(!isset(static::$$options)){
            return "<option>Options not found</option>";
        }
        $haystack = static::$$options;

        switch ($sort) {
            case 'ksort':
                ksort($haystack);
                break;
            case 'krsort':
                krsort($haystack);
                break;
            case 'asort':
                asort($haystack);
                break;
            case 'arsort':
                arsort($haystack);
                break;
        }

        $html = "";
        foreach ($haystack as $key => $option) {
            $selected = "";
            if($default !== false){
                if($key == $default){
                    $selected = "selected";
                }
            } else {
                if($key == $this->_get($field, true)){
                    $selected = "selected";
                }
            }
            $html .= "<option value='$key' $selected>$option</option>";
        }
        return $html;
    }

    public function _getOptionsGroup($field, $default = false, $isFullName = false, $starAtGroup = ""){
        if (!$isFullName) {
            $field = $this->model->table."_".$field;
        }
        if(!isset($this->fields[$field])){
            return "<option>Field ($field) not found</option>";
        }
        if(!isset($this->fields[$field]["options"])){
            return "<option>Options declaration not found</option>";
        }

        $options = $this->fields[$field]["options"];
        if(!isset(static::$$options)){
            return "<option>Options not found</option>";
        }

        $options = static::$$options;
        if (isset($options[$starAtGroup])) {
            $optionAux[$starAtGroup] = $options[$starAtGroup];
            $options = $optionAux;
        }
        return $this->loadOptionGroup($field, $options, $default);
    }

    public function loadOptionGroup($field, $options, $default, $parentID = ""){
        $html = "";
        foreach ($options as $key => $option) {
            $mykey = ($parentID != "") ? "$parentID||$key": $key;
            if (is_array($option)) {
                $html .= "<optgroup label='$key'>".$this->loadOptionGroup($field, $option, $default, $mykey)."</optgroup>";
            } else {
                $selected = "";
                if($default == $mykey){
                    $selected = "selected";
                }
                $html .= "<option value='$mykey' $selected>$option</option>";
            }
        }
        return $html;
    }

    public function save($ficha = null){
        if (empty($ficha)) return false;
        $ficha = $this->checkSwitches($ficha);
        foreach ($ficha as $key => $value) {
            $this->attributes[$key] = $value;
        }
        foreach ($this->fields as $key => $value) {
            if (isset($value[$key]["html"])) {
                if (isset($value[$key]["html"]["type"])) {
                    if ($value[$key]["html"]["type"]=="switch") {
                        if (isset($ficha[$key])) {
                            $this->attributes[$key] = 1;
                        } else {
                            $this->attributes[$key] = 0;
                        }
                    }
                }
            }
        }
        if (!$this->saveCheked($ficha)) return true;
        if ($this->model->save($this)) {
            if (!($this->_id() > 0)) {
                $this->_set("id", $this->model->insertID());
            }
            echo "QUERY->".$this->model->getLastQuery();
            return true;
        }

        return $this->model->errors();
    }

    public function saveCheked($ficha){
        if ($this->_id() > 0) {
            $ficha[$this->model->primaryKey] = $this->_id();
            $this->updateTimeStamp();
            if ($this->attributes == $this->original) return false;
        } else {
            $this->insertTimeStamp();
            $this->updateTimeStamp();
            if ($this->_get("estado") == 0) {
                $this->_set("estado", 1);
            }
        }
        return true;
    }

    public function updateTimeStamp(){
        if ($this->model->useTimestamps) {
            if (isset($this->model->updatedField)) {
                //echo $this->model->updatedField."<br>";
                $this->_set($this->model->updatedField, date("Y-m-d H:i:s"), true);
            }
        }
    }

    public function insertTimeStamp(){
        if ($this->model->useTimestamps) {
            if (isset($this->model->createdField)) {
                $this->_set($this->model->createdField, date("Y-m-d H:i:s"), true);
            }
        }
    }

    public function update($debug = false){
        if ($this->model->save($this->attributes)) {
            if (!($this->_id() > 0)) {
                $this->_set("id", $this->model->insertID());
            }
            if ($debug) {
                echo $this->model->getLastQuery();
            }
            return true;
        }
        if ($debug) {
            echo $this->model->getLastQuery();
        }
        return $this->model->errors();
    }

    public function _getFullName($field){
        return $this->model->table."_".$field;
    }

    public function loadHTML($fields = null, $fichaName = "ficha", $horizontal = true){
        if (empty($fields)) {
            return "";
        }
        $data = [
            "ficha" => $this,
            "fields" => $fields,
            "fichaName" => $fichaName,
            "col_label" => ($horizontal) ? "col-md-3" : "col-12",
            "col_field" => ($horizontal) ? "col-md-9" : "col-12",
        ];
        return view("templates/custom_ficha", $data);
    }

    public function checkSwitches($ficha){
        foreach ($this->fields as $field_name => $field) {
            if (isset($field["html"])) {
                if (isset($field["html"]["type"])) {
                    if ($field["html"]["type"] == "switch") {
                        if (isset($ficha[$field_name])) {
                            $ficha[$field_name] = 1;
                        } else {
                            $ficha[$field_name] = 0;
                        }
                    }
                }
            }
        }
        return $ficha;
    }

    public function getAttributes(){
        return $this->attributes;
    }

}
