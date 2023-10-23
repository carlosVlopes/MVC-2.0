<?php


namespace Core\helper;

class ConstructJson{


	public static function construct($data, $register = false)
	{
		$permissions_menus = '';

	    $permissions_users = '';

	    if($register) $data['m_dashboard'] = 'Ativo';

	    foreach(array_keys($data) as $key => $value){

	        if(strpos($value, 'u_') === 0){

	            unset($data[$value]);

	            $permissions_users .= '"' . $value . '":"' . "Ativo" . '",';

	        }

	        if(strpos($value, 'm_') === 0){

	            unset($data[$value]);

	            $permissions_menus .= '"' . $value . '":"' . "Ativo" . '",';

	        }
	    }

	    $data['permissions_users'] = self::constructJson($permissions_users);
	    $data['permissions_menus'] = self::constructJson($permissions_menus);

	    return $data;

	}

	private static function constructJson($string)
    {

        $string = rtrim($string, ',');

        $string = substr_replace($string, '{', 0,0);

        $qt = strlen($string);

        return substr_replace($string, '}', $qt, 0);

    }


}