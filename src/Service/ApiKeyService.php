<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class ApiKeyService{
    /**
     * @param Request $request
     * @return bool
     */
    public function checkApiKey( Request $request): bool{
        
        // Vérification de la présence de API-KEY dans la requète
        if($request->headers->has('API-KEY')){
            // Vérification de la longueur
            $apiKey = $request->headers->get('API-KEY');
            if(strlen($apiKey) == 42){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }   
    }
}

?>