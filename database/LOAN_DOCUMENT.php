<?php

class LOAN_DOCUMENT extends Model implements IModel
{
	private $ID;
	private $ID_LENDER;
	private $ID_CLIENT;
	private $GROSS_AMOUNT;
	private $PARTIAL_AMOUNT;
	private $INTERES_RATE;
	private $TOTAL_AMOUNT;
	private $PARTIALS;
	private $BALANCE;
	private $CURRENCY;
	private $STATUS;
	private $TERM;
	private $LOAN_RECEIPT;
	private $INIT_DATE;
	private $USER_CREATE;
	private $DATE_CREATE;
	private $USER_UPDATE;
	private $DATE_UPDATE;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getID_LENDER() { return $this->ID_LENDER; }
	private function getID_CLIENT() { return $this->ID_CLIENT; }
	private function getGROSS_AMOUNT() { return $this->GROSS_AMOUNT; }
	private function getPARTIAL_AMOUNT() { return $this->PARTIAL_AMOUNT; }
	private function getINTERES_RATE() { return $this->INTERES_RATE; }
	private function getTOTAL_AMOUNT() { return $this->TOTAL_AMOUNT; }
	private function getPARTIALS() { return $this->PARTIALS; }
	private function getBALANCE() { return $this->BALANCE; }
	private function getCURRENCY() { return $this->CURRENCY; }
	private function getSTATUS() { return $this->STATUS; }
	private function getTERM() { return $this->TERM; }
	private function getLOAN_RECEIPT() { return $this->LOAN_RECEIPT; }
	private function getINIT_DATE() { return $this->INIT_DATE; }
	private function getUSER_CREATE() { return $this->USER_CREATE; }
	private function getDATE_CREATE() { return $this->DATE_CREATE; }
	private function getUSER_UPDATE() { return $this->USER_UPDATE; }
	private function getDATE_UPDATE() { return $this->DATE_UPDATE; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setID_LENDER($ID_LENDER) { $this->ID_LENDER = $ID_LENDER; }
	private function setID_CLIENT($ID_CLIENT) { $this->ID_CLIENT = $ID_CLIENT; }
	private function setGROSS_AMOUNT($GROSS_AMOUNT) { $this->GROSS_AMOUNT = $GROSS_AMOUNT; }
	private function setPARTIAL_AMOUNT($PARTIAL_AMOUNT) { $this->PARTIAL_AMOUNT = $PARTIAL_AMOUNT; }
	private function setINTERES_RATE($INTERES_RATE) { $this->INTERES_RATE = $INTERES_RATE; }
	private function setTOTAL_AMOUNT($TOTAL_AMOUNT) { $this->TOTAL_AMOUNT = $TOTAL_AMOUNT; }
	private function setPARTIALS($PARTIALS) { $this->PARTIALS = $PARTIALS; }
	private function setBALANCE($BALANCE) { $this->BALANCE = $BALANCE; }
	private function setCURRENCY($CURRENCY) { $this->CURRENCY = $CURRENCY; }
	private function setSTATUS($STATUS) { $this->STATUS = $STATUS; }
	private function setTERM($TERM) { $this->TERM = $TERM; }
	private function setLOAN_RECEIPT($LOAN_RECEIPT) { $this->LOAN_RECEIPT = $LOAN_RECEIPT; }
	private function setINIT_DATE($INIT_DATE) { $this->INIT_DATE = $INIT_DATE; }
	private function setUSER_CREATE($USER_CREATE) { $this->USER_CREATE = $USER_CREATE; }
	private function setDATE_CREATE($DATE_CREATE) { $this->DATE_CREATE = $DATE_CREATE; }
	private function setUSER_UPDATE($USER_UPDATE) { $this->USER_UPDATE = $USER_UPDATE; }
	private function setDATE_UPDATE($DATE_UPDATE) { $this->DATE_UPDATE = $DATE_UPDATE; }

	public function __set($name,$value)
	{
		$function = 'set' . $name;
		return $this->$function($value);
	}

	public function __get($name)
	{
		$function = 'get'. $name; 
		return $this->$function();
	}
	#endregion

	public function __construct()
	{
		parent::__construct();
	}

    public function Save() 
    {
        try
        {
            $query = $this->prepare('INSERT INTO LOAN_DOCUMENTS( ID,  ID_LENDER,  ID_CLIENT,  GROSS_AMOUNT,  PARTIAL_AMOUNT,  INTERES_RATE,  TOTAL_AMOUNT,  PARTIALS,  BALANCE,  CURRENCY,  STATUS,  TERM,  LOAN_RECEIPT,  INIT_DATE,  USER_CREATE,  DATE_CREATE,  USER_UPDATE,  DATE_UPDATE)
            VALUES(:ID, :ID_LENDER, :ID_CLIENT, :GROSS_AMOUNT, :PARTIAL_AMOUNT, :INTERES_RATE, :TOTAL_AMOUNT, :PARTIALS, :BALANCE, :CURRENCY, :STATUS, :TERM, :LOAN_RECEIPT, :INIT_DATE, :USER_CREATE, :DATE_CREATE, :USER_UPDATE, :DATE_UPDATE)');
			$query->execute([
				'ID' => $this->ID,
				'ID_LENDER' => $this->ID_LENDER,
				'ID_CLIENT' => $this->ID_CLIENT,
				'GROSS_AMOUNT' => $this->GROSS_AMOUNT,
				'PARTIAL_AMOUNT' => $this->PARTIAL_AMOUNT,
				'INTERES_RATE' => $this->INTERES_RATE,
				'TOTAL_AMOUNT' => $this->TOTAL_AMOUNT,
				'PARTIALS' => $this->PARTIALS,
				'BALANCE' => $this->BALANCE,
				'CURRENCY' => $this->CURRENCY,
				'STATUS' => $this->STATUS,
				'TERM' => $this->TERM,
				'LOAN_RECEIPT' => $this->LOAN_RECEIPT,
				'INIT_DATE' => $this->INIT_DATE,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('LOAN_DOCUMENT::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM LOAN_DOCUMENTS');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new LOAN_DOCUMENT();
				$item->ID = $entidad['ID'];
				$item->ID_LENDER = $entidad['ID_LENDER'];
				$item->ID_CLIENT = $entidad['ID_CLIENT'];
				$item->GROSS_AMOUNT = $entidad['GROSS_AMOUNT'];
				$item->PARTIAL_AMOUNT = $entidad['PARTIAL_AMOUNT'];
				$item->INTERES_RATE = $entidad['INTERES_RATE'];
				$item->TOTAL_AMOUNT = $entidad['TOTAL_AMOUNT'];
				$item->PARTIALS = $entidad['PARTIALS'];
				$item->BALANCE = $entidad['BALANCE'];
				$item->CURRENCY = $entidad['CURRENCY'];
				$item->STATUS = $entidad['STATUS'];
				$item->TERM = $entidad['TERM'];
				$item->LOAN_RECEIPT = $entidad['LOAN_RECEIPT'];
				$item->INIT_DATE = $entidad['INIT_DATE'];
				$item->USER_CREATE = $entidad['USER_CREATE'];
				$item->DATE_CREATE = $entidad['DATE_CREATE'];
				$item->USER_UPDATE = $entidad['USER_UPDATE'];
				$item->DATE_UPDATE = $entidad['DATE_UPDATE'];

				array_push($result, $item);
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			error_log('LOAN_DOCUMENT::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

	public function GetByIdClient($id)
	{
		try
		{
			$result = [];
			$query = $this->prepare('SELECT * FROM LOAN_DOCUMENTS WHERE ID_CLIENT = :ID_CLIENT');
			$query->execute([
				'ID_CLIENT' => $id
			]);

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new LOAN_DOCUMENT();
				$item->From($entidad);
				array_push($result, $item);
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			error_log('LOAN_DOCUMENT::GetByIdClient->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM LOAN_DOCUMENTS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$loan_document = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $loan_document['ID'];
			$this->ID_LENDER = $loan_document['ID_LENDER'];
			$this->ID_CLIENT = $loan_document['ID_CLIENT'];
			$this->GROSS_AMOUNT = $loan_document['GROSS_AMOUNT'];
			$this->PARTIAL_AMOUNT = $loan_document['PARTIAL_AMOUNT'];
			$this->INTERES_RATE = $loan_document['INTERES_RATE'];
			$this->TOTAL_AMOUNT = $loan_document['TOTAL_AMOUNT'];
			$this->PARTIALS = $loan_document['PARTIALS'];
			$this->BALANCE = $loan_document['BALANCE'];
			$this->CURRENCY = $loan_document['CURRENCY'];
			$this->STATUS = $loan_document['STATUS'];
			$this->TERM = $loan_document['TERM'];
			$this->LOAN_RECEIPT = $loan_document['LOAN_RECEIPT'];
			$this->INIT_DATE = $loan_document['INIT_DATE'];
			$this->USER_CREATE = $loan_document['USER_CREATE'];
			$this->DATE_CREATE = $loan_document['DATE_CREATE'];
			$this->USER_UPDATE = $loan_document['USER_UPDATE'];
			$this->DATE_UPDATE = $loan_document['DATE_UPDATE'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('LOAN_DOCUMENT::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM LOAN_DOCUMENTS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('LOAN_DOCUMENT::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE LOAN_DOCUMENTS SET ID_LENDER = :ID_LENDER, ID_CLIENT = :ID_CLIENT, GROSS_AMOUNT = :GROSS_AMOUNT, PARTIAL_AMOUNT = :PARTIAL_AMOUNT, INTERES_RATE = :INTERES_RATE, TOTAL_AMOUNT = :TOTAL_AMOUNT, PARTIALS = :PARTIALS, BALANCE = :BALANCE, CURRENCY = :CURRENCY, STATUS = :STATUS, TERM = :TERM, LOAN_RECEIPT = :LOAN_RECEIPT, INIT_DATE = :INIT_DATE, USER_CREATE = :USER_CREATE, DATE_CREATE = :DATE_CREATE, USER_UPDATE = :USER_UPDATE, DATE_UPDATE = :DATE_UPDATE WHERE ID = :ID');
			$query->execute([
				'ID' => $this->ID,
				'ID_LENDER' => $this->ID_LENDER,
				'ID_CLIENT' => $this->ID_CLIENT,
				'GROSS_AMOUNT' => $this->GROSS_AMOUNT,
				'PARTIAL_AMOUNT' => $this->PARTIAL_AMOUNT,
				'INTERES_RATE' => $this->INTERES_RATE,
				'TOTAL_AMOUNT' => $this->TOTAL_AMOUNT,
				'PARTIALS' => $this->PARTIALS,
				'BALANCE' => $this->BALANCE,
				'CURRENCY' => $this->CURRENCY,
				'STATUS' => $this->STATUS,
				'TERM' => $this->TERM,
				'LOAN_RECEIPT' => $this->LOAN_RECEIPT,
				'INIT_DATE' => $this->INIT_DATE,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('LOAN_DOCUMENT::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
		$this->ID = $data['ID'];
		$this->ID_LENDER = $data['ID_LENDER'];
		$this->ID_CLIENT = $data['ID_CLIENT'];
		$this->GROSS_AMOUNT = $data['GROSS_AMOUNT'];
		$this->PARTIAL_AMOUNT = $data['PARTIAL_AMOUNT'];
		$this->INTERES_RATE = $data['INTERES_RATE'];
		$this->TOTAL_AMOUNT = $data['TOTAL_AMOUNT'];
		$this->PARTIALS = $data['PARTIALS'];
		$this->BALANCE = $data['BALANCE'];
		$this->CURRENCY = $data['CURRENCY'];
		$this->STATUS = $data['STATUS'];
		$this->TERM = $data['TERM'];
		$this->LOAN_RECEIPT = $data['LOAN_RECEIPT'];
		$this->INIT_DATE = $data['INIT_DATE'];
		$this->USER_CREATE = $data['USER_CREATE'];
		$this->DATE_CREATE = $data['DATE_CREATE'];
		$this->USER_UPDATE = $data['USER_UPDATE'];
		$this->DATE_UPDATE = $data['DATE_UPDATE'];

	}   
                
	public function jsonSerialize()
	{
		return json_encode(get_object_vars($this));
	}

	public function array()
	{
		return get_object_vars($this);
	}
}
?>