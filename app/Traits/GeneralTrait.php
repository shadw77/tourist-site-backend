<?php

namespace App\Traits;

trait GeneralTrait{

    //function to return data in json
    public function returnData($key,$value,$mssg="",$code=200){
        return response()->json([
            'status' => $code,
            'mssg' => $mssg,
            $key => $value
        ]);
    }

    public function returnError($mssg='',$code='E000'){
        return response()->json([
            'status' => $code,
            'mssg' => $mssg,
        ]);
    }



    public function returnSuccessMessage($mssg='',$succnum='S000'){
        return response()->json([
            'mssg' => $mssg,
            'successcode' =>$succnum,
        ]);
    }




    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E0011';
        else if ($input == "password")
            return 'E002';
        else if ($input == "mobile")
            return 'E003';
        else if ($input == "id_number")
            return 'E004';
        else if ($input == "email")
            return 'E007';
        else if ($input == "name_en")
            return 'E025';
        else if ($input == "name_ar")
            return 'E026';
        else
            return "";
    }



}
