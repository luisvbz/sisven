<?php


namespace App\Tools;

use Peru\Jne\DniFactory;
use Peru\Sunat\RucFactory;
use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use Peru\Sunat\{HtmlParser, Ruc, RucParser};

class DniRuc
{


    public static function getData(String $tipoDocumento, Int $numeroDocumento)
    {
        try {
            if(strtoupper($tipoDocumento) === 'DNI') {
                //si el dni no es igual a 8 digitos
                if(strlen($numeroDocumento) !== 8) {
                    throw new \Exception("EL DNI {$numeroDocumento} debe tener 8 dígitos para poder consultarlo");
                }

                $factory = new DniFactory();
                $cs = $factory->create();
                $persona = $cs->get($numeroDocumento);
                if(!$persona) {
                    throw new \Exception("La persona con el DNI {$numeroDocumento} no fue encontrada");
                }
                return $persona;
            }else if(strtoupper($tipoDocumento) === 'RUC'){

                if(strlen($numeroDocumento) !== 11) {
                    throw new \Exception("EL RUC {$numeroDocumento} debe tener 11 dígitos para poder consultarlo");
                }

                $factory = new RucFactory();
                $cs = $factory->create();
                $empresa = $cs->get($numeroDocumento);
                if(!$empresa) {
                    throw new \Exception("La empresa con el RUC {$numeroDocumento} no fue encontrada");
                }
                return $empresa;
            }else {
                throw new \Exception("El tipo de documento {$tipoDocumento} no es válido para consultas");
            }

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
