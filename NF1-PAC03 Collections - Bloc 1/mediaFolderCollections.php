<?php
require_once('mediaFolder.collection.php');
abstract class AbstractMediaItem {
    protected $name;
    protected $thumbnail;
    protected $items = array();

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }

    public function getThumbnail() {
        return $this->thumbnail;
    }

    // Método para verificar si tiene elementos hijos
    public function hasChildren() {
        return (bool)(count($this->items) > 0);
    }

    public function add(AbstractMediaItem $item) {
        $this->items[] = $item;
    }

public function __toString() {
    $texto = "- Nombre: " . $this->getName() . "<br>";
    $texto .= "- Miniatura: " . $this->getThumbnail() . "<br>";
    if ($this->hasChildren()) {
        $texto .= "Incluye:<br>";
        foreach ($this->items as $item) {
            if ($item instanceof AbstractMediaFile) {
                $texto .= $item->getDescription(); // Llama a getDescription() solo si es un archivo
            }
        }
    }
    return $texto;
}
}

class MediaItemCollection extends Collection{
public function addMediaItem($obj = null, $key = null) {
    parent::addMediaItem($obj, $key);
  }
}

class MediaFolder extends AbstractMediaItem {
    // Constructor
    public function __construct($name, $thumbnail) {
        $this->setName($name);
        $this->setThumbnail($thumbnail);
    }
}

abstract class AbstractMediaFile extends AbstractMediaItem {
    protected $fileName;
    protected $size;

    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }

    public function getDescription() {
        echo "- Archivo: " . $this->getFileName() . "<br>";
        echo "- Nombre: " . $this->getName() . "<br>";
        echo "- Miniatura: " . $this->getThumbnail() . "<br>";
        echo "- Tamaño: " . $this->getSize() . "<br>";
    }
}


class Photo extends AbstractMediaFile {
   
    public function __construct($fileName, $size, $name, $thumbnail) {
        $this->setFileName($fileName);
        $this->setSize($size);
        $this->setName($name);
        $this->setThumbnail($thumbnail);
    }
}


class Video extends AbstractMediaFile {
    
    public function __construct($fileName, $size, $name, $thumbnail) {
        $this->setFileName($fileName);
        $this->setSize($size);
        $this->setName($name);
        $this->setThumbnail($thumbnail);
    }
}

$tc = new MediaItemCollection();

$folder = new MediaFolder("Carpeta1", "Carpeta2");

$photo1 = new Photo("foto1.jpg", "2MB", "Foto 1", "thumb1.jpg");
$photo2 = new Photo("foto2.jpg", "3MB", "Foto 2", "thumb2.jpg");
$video1 = new Video("video1.mp4", "50MB", "Video 1", "thumb3.jpg");

$folder->add($photo1);
$folder->add($photo2);
$folder->add($video1);


$folder2 = new MediaFolder("Carpeta1", "Carpeta2");

$photo3 = new Photo("foto1.jpg", "2MB", "Foto 1", "thumb1.jpg");
$photo4 = new Photo("foto2.jpg", "3MB", "Foto 2", "thumb2.jpg");
$video2 = new Video("video1.mp4", "50MB", "Video 1", "thumb3.jpg");

$folder2->add($photo1);
$folder2->add($photo2);
$folder2->add($video1);

$folder->add($folder2);

$tc-> addMediaItem($folder);
$tc-> addMediaItem($folder2);

echo $tc->__toString();
/*$folder->getDescription();*/

?>