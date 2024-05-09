<?php

class TwitterApi extends DataBoundObject {

protected $ID;
protected $URL;
protected $Nombre_autor;
protected $URL_autor;

protected function DefineTableName() {
        return("twitterapi");
}

protected function DefineRelationMap() {
        return(array(
                "id" => "ID",
                "url" => "URL",
                "nombre_autor" => "Nombre_autor",
                "url_autor" => "URL_autor",
            ));
}
}
?>