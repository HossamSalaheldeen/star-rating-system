<?php

use App\Utilities\CustomCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

if (!function_exists('customCollect')) {
    /**
     * @param array $items
     * @return CustomCollection
     * create custom collection
     */
    function customCollect(array $items = [])
    {
        return new CustomCollection($items);
    }
}

if (!function_exists('getRedirectRoute')) {
    /**
     * @return string
     * get redirect route depending on user role
     */
    function getRedirectRoute()
    {
        return auth()->user()->isAdmin() ? route('home') : route('home2');

    }
}

if (!function_exists('getAttributeStringByReflection')) {
    /**
     * @param $reflectorClass
     * @param $property
     * @return int|string|string[]
     * @throws ReflectionException
     * get constant string by its value using class reflection
     */
    function getAttributeStringByReflection($reflectorClass, $property)
    {
        $reflector = new \ReflectionClass($reflectorClass);
        $constant = '';

        foreach ($reflector->getConstants() as $constant => $value) {
            if ($value == $property) {
                $constant = str_replace('_', ' ', Str::title($constant));
                break;
            }
        }

        return $constant;
    }
}

if (!function_exists('getModels')) {
    /**
     * @param $path
     * @return array
     * scan models directory
     */
    function getModels($path): array
    {
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..')
                continue;
            $filename = $path . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getModels($filename));
            } else {
                $out[] = substr($result, 0, -4);
            }
        }
        return $out;
    }
}

if (!function_exists('getPermissionName')) {
    /**
     * @return bool
     */
    function getPermissionName($permission, $model)
    {
        $matches = [];
        preg_match_all("/[a-zA-Z]+/m", $model, $matches);
        $entityName = Str::lower(Str::kebab($matches[0][count($matches[0]) - 1]));
        return $permission . '-' . $entityName;
    }
}

if (!function_exists('validatePhoneNumber')) {
    /**
     * @return String
     */
    function validatePhoneNumber()
    {
        return 'regex:/^\+?([0-9]{1,3})([-. ]?[(]?)([0-9]{2,4})[)]?(([-. ]?[(]?)([0-9]{2,4})[)]?)*$/';
    }
}

if (!function_exists('validateHost')) {
    /**
     * @return String
     */
    function validateHost()
    {
        return 'regex:/^([a-zA-Z0-9]{1,50})[.]{1}([a-zA-Z0-9]{2,})$/';
    }
}

if (!function_exists('validateAddress')) {
    /**
     * @return String
     */
    function validateAddress()
    {
        return 'regex:/^[a-zA-Z0-9_\s]+([-._@\/]*[a-zA-Z0-9_\s]+)+$/';
    }
}


if (!function_exists('isRequestUrl')) {
    /**
     * @return String
     */
    function isRequestUrl()
    {
        return \Route::is('settings.requests.*.create');
    }
}

if (!function_exists('prepareArrayToSave')) {
    /**
     * @param array $arr
     * @return array $items
     */
    function prepareArrayToSave($bigArr)
    {
//        $items = Array();
//        foreach ($arr as $key => $subArr) {
//
//            foreach ($subArr as $subKey => $value) {
//
//            }
//
//        }
        $bigArr = array_map('array_values',$bigArr);
        $maxLength = 0;
        foreach($bigArr as $key=>$value){
            if(count($value)>$maxLength){
                $maxLength=count($value);
            }
        }
        $res =[];
        for($i = 0 ; $i < $maxLength ; $i++){
            $block = [];
            foreach($bigArr as $key=>$value){
                $block[Str::singular($key)]=$value[$i];
                // array_push($block,$value[$i]);
            }
            array_push($res,$block);
        }
        return $res;

//        $ret = Arr::crossJoin($arr);
//        dd($arr,$ret);
//        $keys = array_keys($arr);
//        $item = array();
//        $items = array();
//
//        $returned = array(
//            [
//                'name' => 'ahmed',
//                'email' => 'ahmed@ahmed.com',
//                'phone' => '12345678921'
//            ],
//            [
//                'name' => 'mohamed',
//                'email' => 'mohamed@mohamed.com',
//                'phone' => '65432179821'
//            ],
//            [
//                'name' => 'mahmoud',
//                'email' => 'mahmoud@mahmoud.com',
//                'phone' => '46465464464'
//            ],
//            [
//                'name' => 'sami',
//                'email' => 'sami@sami.com',
//                'phone' => '741852963'
//            ]
//        );
//        $test = array(
//            'names' => [
//                3 => "ahmed",
//                4 => "mohamed",
//                5 => "mahmoud",
//                1 => "sami",
//            ],
//            'emails' => [
//                3 => "ahmed@ahmed.com",
//                4 => "mohamed@mohamed.com",
//                5 => "mahmoud@mahmoud.com",
//                1 => "sami@sami.com",
//            ],
//            'phones' => [
//                3 => "12345678921",
//                4 => "65432179821",
//                5 => "46465464464",
//                1 => "741852963",
//            ]
//        );
//
//        dd($returned);
//
//        if (count($keys) > 0) {
//            for ($j = 0; $j < count($arr[head($keys)]); $j++) {
//                $resetArr = array_values($arr[$keys[$j]]);
//                for ($i = 0; $i < count($keys); $i++) {
//                    dd($keys[$i], $resetArr);
//                    $item[Str::singular($keys[$i])] = $resetArr[$j];
//                }
//                array_push($items, $item);
//            }
//        }
//        return $items;
    }
}
