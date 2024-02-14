<?php

class Customer {

        private $CUST_NAME;
        private $CUST_CITY;
        private $WORKING_AREA;
        private $CUST_COUNTRY;
        private $GRADE;
        private $OPENING_AMT;
        private $PAYMENT_AMT;
        private $OUTSTANDING_AMT;
        private $PHONE_NO;
        private $AGENT_CODE;


        public function __call($strFunction, $arArguments) {

                $strMethodType = substr($strFunction, 0, 3);
                $strMethodMember = substr($strFunction, 3);
                switch ($strMethodType) {
                        case "set":
                                return($this->SetAccessor($strMethodMember,
                                       $arArguments[0]));
                                break;
                        case "get":
                                return($this->GetAccessor($strMethodMember));
                };
                return(false);
        }

        private function SetAccessor($strMember, $strNewValue) {
                if (property_exists($this, $strMember)) {
                        if (is_numeric($strNewValue)) {
                                eval('$this->' . $strMember . ' = ' . $strNewValue
                                     . ';');
                        } else {
                                eval('$this->' . $strMember . ' = "' . $strNewValue
                                     . '";');
                        };
                } else {
                        return(false);
                };
        }

        private function GetAccessor($strMember) {
                if (property_exists($this, $strMember)) {
                        eval('$strRetVal = $this->' . $strMember . ';');
                        return($strRetVal);
                } else {
                        return(false);
                };
        }

}

?>
