

<?php

class Conductor {
    private $nombreConductor;
    private $numeroConductor;

    public function __construct($nombreConductor, $numeroConductor) {
        $this->setNombreConductor($nombreConductor);
        $this->setNumeroConductor($numeroConductor);
    }

    public function setNombreConductor($nombreConductor) {
        $this->nombreConductor = $nombreConductor;
    }

    public function setNumeroConductor($numeroConductor) {
        $this->numeroConductor = $numeroConductor;
    }

    public function getNombreConductor() {
        return $this->nombreConductor;
    }

    public function getNumeroConductor() {
        return $this->numeroConductor;
    }
}

class Pasajero {
    private $nombrePasajero;
    private $numeroPasajero;

    public function __construct($nombrePasajero, $numeroPasajero) {
        $this->setNombrePasajero($nombrePasajero);
        $this->setNumeroPasajero($numeroPasajero);
    }

    public function setNombrePasajero($nombrePasajero) {
        $this->nombrePasajero = $nombrePasajero;
    }

    public function setNumeroPasajero($numeroPasajero) {
        $this->numeroPasajero = $numeroPasajero;
    }

    public function getNombrePasajero() {
        return $this->nombrePasajero;
    }

    public function getNumeroPasajero() {
        return $this->numeroPasajero;
    }
}

class Butaca {
    private $nombreButaca;
    private $numeroButaca;

    public function __construct($nombreButaca, $numeroButaca) {
        $this->setNombreButaca($nombreButaca);
        $this->setNumeroButaca($numeroButaca);
    }

    public function setNombreButaca($nombreButaca) {
        $this->nombreButaca = $nombreButaca;
    }

    public function setNumeroButaca($numeroButaca) {
        $this->numeroButaca = $numeroButaca;
    }

    public function getNombreButaca() {
        return $this->nombreButaca;
    }

    public function getNumeroButaca() {
        return $this->numeroButaca;
    }
}

class Collection {
    private $_members = array();

    public function addCollection($obj, $key = null) {
        if ($key == null) {
            $this->_members[] = $obj;
        } else {
            if (isset($this->_members[$key])) {
                throw new KeyHasUseException("Key $key already in use.");
            } else {
                $this->_members[$key] = $obj;
            }
        }
    }

    public function getCollection($key) {
        if (isset($this->_members[$key])) {
            return $this->_members[$key];
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public function getAllMembers() {
        return $this->_members;
    }
}

class PasajeroCollection extends Collection {
    public function addPasajero(Pasajero $pasajero, $key = null) {
        $this->addCollection($pasajero, $key);
    }
}

class ButacaCollection extends Collection {
    public function addButaca(Butaca $butaca, $key = null) {
        $this->addCollection($butaca, $key);
    }
}

abstract class AbstractMedioTransporte {
    protected $conductor;
    protected $pasajeros;
    protected $butacas;

    public function __construct(Conductor $conductor) {
        $this->setConductor($conductor);
        $this->setPasajeros(new PasajeroCollection());
        $this->setButacas(new ButacaCollection());
    }

    public function setConductor(Conductor $conductor) {
        $this->conductor = $conductor;
    }

    public function getConductor() {
        return $this->conductor;
    }

    public function setPasajeros(PasajeroCollection $pasajeros) {
        $this->pasajeros = $pasajeros;
    }

    public function getPasajeros() {
        return $this->pasajeros;
    }

    public function setButacas(ButacaCollection $butacas) {
        $this->butacas = $butacas;
    }

    public function getButacas() {
        return $this->butacas;
    }
}

class AutoBus extends AbstractMedioTransporte {
    private $nombreBus;
    private $numeroBus;

    public function __construct(Conductor $conductor, $nombreBus, $numeroBus) {
        parent::__construct($conductor);
        $this->setNombreBus($nombreBus);
        $this->setNumeroBus($numeroBus);
    }

    public function setNombreBus($nombreBus) {
        $this->nombreBus = $nombreBus;
    }

    public function getNombreBus() {
        return $this->nombreBus;
    }

    public function setNumeroBus($numeroBus) {
        $this->numeroBus = $numeroBus;
    }

    public function getNumeroBus() {
        return $this->numeroBus;
    }

    public function getDescription() {
        echo "- Conductor: " . $this->getConductor()->getNombreConductor() . "<br>";
        echo "- Nombre del autobús: " . $this->getNombreBus() . "<br>";
        echo "- Número del autobús: " . $this->getNumeroBus() . "<br>";
    
        echo "- Pasajeros:<br>";
        foreach ($this->getPasajeros()->getAllMembers() as $pasajero) {
            echo "  Pasajero: " . $pasajero->getNombrePasajero() . "<br>";
            echo "  PasajeroNum: " . $pasajero->getNumeroPasajero() . "<br>";
        }
    
        echo "- Butacas:<br>";
        foreach ($this->getButacas()->getAllMembers() as $butaca) {
            echo "  Butaca: " . $butaca->getNombreButaca() . "<br>";
            echo "  ButacaNum: " . $butaca->getNumeroButaca() . "<br>";
        }
    }
    // Método getDescription() sigue igual...
}

class Tren extends AbstractMedioTransporte {
    private $nombreTren;
    private $numeroTren;

    public function __construct(Conductor $conductor, $nombreTren, $numeroTren) {
        parent::__construct($conductor);
        $this->setNombreTren($nombreTren);
        $this->setNumeroTren($numeroTren);
    }

    public function setNombreTren($nombreTren) {
        $this->nombreTren = $nombreTren;
    }

    public function getNombreTren() {
        return $this->nombreTren;
    }


    public function getNumeroTren() {
        return $this->numeroTren;
    }

    public function setNumeroTren($numeroTren) {
        $this->numeroTren = $numeroTren;
    }
    public function getDescription() {
        echo "- Conductor: " . $this->getConductor()->getNombreConductor() . "<br>";
        echo "- Nombre del tren: " . $this->getNombreTren() . "<br>";
        echo "- Número del tren: " . $this->getNumeroTren() . "<br>";
    
        echo "- Pasajeros:<br>";
        foreach ($this->getPasajeros()->getAllMembers() as $pasajero) {
            echo "  Pasajero: " . $pasajero->getNombrePasajero() . "<br>";
        }
    
        echo "- Butacas:<br>";
        foreach ($this->getButacas()->getAllMembers() as $butaca) {
            echo "  Butaca: " . $butaca->getNombreButaca() . "<br>";
        }
    }
    // Método getDescription() sigue igual...
}

$conductorBus = new Conductor("Juan Pérez", 1);


$autobus = new AutoBus($conductorBus, "Bus 1", "001");


$pasajeroBus1 = new Pasajero("Pasajero Bus 1", 101);
$autobus->getPasajeros()->addPasajero($pasajeroBus1);
$pasajeroBus2 = new Pasajero("Pasajero Bus 2", 101);
$autobus->getPasajeros()->addPasajero($pasajeroBus2);

$butacaBus1 = new Butaca("Butaca 1", 1);
$autobus->getButacas()->addButaca($butacaBus1);


$conductorTren = new Conductor("María López", 2);


$tren = new Tren($conductorTren, "Tren 1", "002");


$pasajeroTren1 = new Pasajero("Pasajero Tren 1", 201);
$tren->getPasajeros()->addPasajero($pasajeroTren1);


$butacaTren1 = new Butaca("Butaca Premium", 1);
$tren->getButacas()->addButaca($butacaTren1);


echo "Autobús:\n";
var_dump($autobus);


echo "\n\nTren:\n";
var_dump($tren);

$autobus->getDescription();
echo "<br>"; // Separador para mejor lectura
$tren->getDescription();
?>