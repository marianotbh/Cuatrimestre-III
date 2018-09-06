<?php
    class Tools
    {
        static function FileToArray($file, $objProperties, $delimiter)
        {
            $obj = null;
            $arr = null;
            $ref = fopen($file, "r");   
            while(!feof($ref))
            {
                if(count($obj = explode($delimiter, fgets($ref))) == $objProperties)
                {
                    $arr[] = $obj;
                }
            }
            fclose($ref);
            return $arr;
        }

        static function ArrayToFile($arr, $file)
        {
            $ref = fopen($file, "w");
            foreach($arr as $obj)
            {
                fwrite($ref, implode("-", $obj).PHP_EOL);
            }
            fclose($ref);
        }
    
        static function LoadPhoto($fileArray, $name, $fileFolder)
        {
            if(Self::ValidatePhoto($fileArray))
            {
                $ext = explode(".", $fileArray["name"]);
                $fotoNameString = $name.".png";
                if(move_uploaded_file($fileArray["tmp_name"], "./$fileFolder/$fotoNameString"))
                return $fotoNameString;
            }
            else
                return null;            
        }

        static function ValidatePhoto($fileArray)
        {
            $imgTypes = array("jpg", "png", "bmp", "gif", "tif", "jpeg");
            $ext = explode(".", $fileArray["name"]);
            if($fileArray["size"] <= 10000000 && in_array($ext[1], $imgTypes))
            {
                return true;
            }
            return false;
        }

        static function BackUp($fileName, $originFolder, $backupFolder)
        {
            $origen = "./$originFolder/$fileName";
            $destino = "./$backupFolder/backup_$fileName";
            if(copy(trim($origen), trim($destino)))
                return true;
            else return false;
        }

        static function Find($array, $property, $value)
        {
            foreach($array as $obj)
            {
                if($obj[$property] == $value)
                {
                    return $obj;
                }
            }
            return null;
        }

        static function FindAll($array, $property, $value)
        {
            $coincidences = array();
            foreach($array as $obj)
            {
                if($obj[$property] == $value)
                {
                    $coincidences[] = $obj;
                }
            }
            return $coincidences;
        }
    }    
?>