<?php

abstract class DataBoundObject {

   protected $ID;
   protected $objPDO;
   protected $strTableName;
   protected $arRelationMap;
   protected $blForDeletion;
   protected $blIsLoaded;
   protected $arModifiedRelations;

   abstract protected function DefineTableName();
   abstract protected function DefineRelationMap();

   public function __construct(PDO $objPDO, $id = NULL) {
      $this->strTableName = $this->DefineTableName();
      $this->arRelationMap = $this->DefineRelationMap();
      $this->objPDO = $objPDO;
      $this->blIsLoaded = false;
      if (isset($id)) {
         $this->ID = $id;
      };
      $this->arModifiedRelations = array();
   }

   public function Load() {
      if (isset($this->ID)) {
		$strQuery = "SELECT ";
        foreach ($this->arRelationMap as $key => $value) {
			$strQuery .= "\"" . $key . "\",";
        }
        $strQuery = substr($strQuery, 0, strlen($strQuery)-1);
        $strQuery .= " FROM " . $this->strTableName . " WHERE \"id\" = :eid";
        $objStatement = $this->objPDO->prepare($strQuery);
        $objStatement->bindParam(':eid', $this->ID, PDO::PARAM_INT);
        $objStatement->execute();
        $arRow = $objStatement->fetch(PDO::FETCH_ASSOC);
        foreach($arRow as $key => $value) {
            $strMember = $this->arRelationMap[$key];
            if (property_exists($this, $strMember)) {
                if (is_numeric($value)) {
                   eval('$this->'.$strMember.' = '.$value.';');
                } else {
                   eval('$this->'.$strMember.' = "'.$value.'";');
                };
            };
         };
         $this->blIsLoaded = true;
      };
   }

   public function Save() {
      if(isset($this->ID)) {
          // Update existing record
          $strQuery = 'UPDATE "' . $this->strTableName . '" SET ';
          $changes = [];
          foreach ($this->arRelationMap as $key => $value) {
              if (array_key_exists($value, $this->arModifiedRelations)) {
                  $actualVal = &$this->$value;
                  $param = ':' . $value;
                  $changes[] = "\"$key\" = $param";
              }
          }
          if (!empty($changes)) {
              $strQuery .= implode(', ', $changes);
              $strQuery .= ' WHERE "id" = :eid';
              $objStatement = $this->objPDO->prepare($strQuery);
              $objStatement->bindValue(':eid', $this->ID, PDO::PARAM_INT);
              foreach ($this->arRelationMap as $key => $value) {
                  if (array_key_exists($value, $this->arModifiedRelations)) {
                      $actualVal = &$this->$value;
                      $objStatement->bindValue(':' . $value, $actualVal);
                  }
              }
              $objStatement->execute();
          }
      } else {
          // Insert new record
          $columns = [];
          $values = [];
          $data = [];
          foreach ($this->arRelationMap as $key => $value) {
              if (array_key_exists($value, $this->arModifiedRelations)) {
                  $actualVal = &$this->$value;
                  $columns[] = "\"$key\"";
                  $param = ':' . $value;
                  $values[] = $param;
                  $data[$param] = $actualVal;
              }
          }
          if (!empty($columns) && !empty($values)) {
              $strQuery = 'INSERT INTO "' . $this->strTableName . '" (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';
              $objStatement = $this->objPDO->prepare($strQuery);
              foreach ($data as $param => $val) {
                  $objStatement->bindValue($param, $val);
              }
              $objStatement->execute();
          } else {
              throw new Exception("No data to insert");
          }
      }
  }

   public function MarkForDeletion() {
      $this->blForDeletion = true;
   }
   
   public function __destruct() {
      if (isset($this->ID)) {   
         if ($this->blForDeletion == true) {
            $strQuery = 'DELETE FROM "' . $this->strTableName . '" WHERE "id" = :eid';
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->ID, PDO::PARAM_INT);   
            $objStatement->execute();
         };
      }
   }

   public function __call($strFunction, $arArguments) {

      $strMethodType = substr($strFunction, 0, 3);
      $strMethodMember = substr($strFunction, 3);
      switch ($strMethodType) {
         case "set":
            return($this->SetAccessor($strMethodMember, $arArguments[0]));
            break;
         case "get":
            return($this->GetAccessor($strMethodMember));   
      };
      return(false);   
   }

   private function SetAccessor($strMember, $strNewValue) {
      if (property_exists($this, $strMember)) {
          $this->$strMember = $strNewValue; // Directly assign the value without eval()
          $this->arModifiedRelations[$strMember] = true;
      } else {
          return false;
      }
  }
  
  private function GetAccessor($strMember) {
      if (!$this->blIsLoaded) {
          $this->Load();
      }
      if (property_exists($this, $strMember)) {
          return $this->$strMember; // Direct access to the property
      } else {
          return false;
      }
  }
   
}

?>
