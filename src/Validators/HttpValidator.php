<?php
namespace Pointdeb\LaravelCommon\Validators;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class HttpValidator
{
    public static function boot()
    {
        Validator::extend('unique_not_me', function ($attribute, $value, $params) {
            $table = $params[0];
            $column_id = $params[2] ?? 'id';
            $id = 0;
            if (isset(Input::all()[$column_id])) {
                $id = Input::all()[$column_id];
            }
            $result = DB::select("SELECT * FROM $table WHERE $attribute = '$value' AND $column_id != $id");
            return count($result) == 0;
        }, 'The :attribute has already been taken');
        
        Validator::extend('is_gender', function ($attribute, $value, $params) {
            return in_array($value, ['male', 'female', 'other']);
        }, 'The :attribute can take only male or female or other');
        
        Validator::extend('is_todo_state', function ($attribute, $value, $params) {
            return in_array($value, ['untouched', 'pending', 'pause', 'finished']);
        }, 'The :attribute can take only untouched or pending or pause or finished');
        
        Validator::extend('tokenfield', function ($attribute, $value, $params) {
            $parts = array_filter(explode(',', $value), function ($item) {
                return !empty($item);
            });
            foreach ($parts as $key => $val) {
                if (is_numeric($val)) {
                    continue;
                } else {
                    return false;
                }
            }
            return true;
        }, 'The :attribute can take only \'1,2,3,4,5...N\'');
    }
}