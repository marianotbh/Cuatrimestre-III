<?php
    function levantarArrayDeArchivo($file, $objProperties, $delimiter)
    {
        $obj;
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

    function bajarArrayAArchivo($arr,$file)
    {
        $ref = fopen($file, "w");
        foreach($arr as $obj)
        {
            fwrite($ref,$obj->ToString());
        }
        fclose($ref);
    }
?>