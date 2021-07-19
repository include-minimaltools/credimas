<?php

require_once 'libs/model.php';

class FEE_DOCUMENT extends Model implements IModel, JsonSerializable
{
	private $ID;
	private $ID_LOAN;
	private $N_PARTIAL;
	private $GROSS_AMOUNT;
	private $FINANCIAL_ENTITY;
	private $CURRENCY;
	private $INTERES_RATE;
	private $DEDUCTION;
	private $TOTAL_AMOUNT;
	private $BALANCE;
	private $TRANSACTION;
	private $STATUS;
	private $PAYMENT_DATE;
	private $USER_CREATE;
	private $DATE_CREATE;
	private $USER_UPDATE;
	private $DATE_UPDATE;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getID_LOAN() { return $this->ID_LOAN; }
	private function getN_PARTIAL() { return $this->N_PARTIAL; }
	private function getGROSS_AMOUNT() { return $this->GROSS_AMOUNT; }
	private function getFINANCIAL_ENTITY() { return $this->FINANCIAL_ENTITY; }
	private function getCURRENCY() { return $this->CURRENCY; }
	private function getINTERES_RATE() { return $this->INTERES_RATE; }
	private function getDEDUCTION() { return $this->DEDUCTION; }
	private function getTOTAL_AMOUNT() { return $this->TOTAL_AMOUNT; }
	private function getBALANCE() { return $this->BALANCE; }
	private function getTRANSACTION() { return $this->TRANSACTION; }
	private function getSTATUS() { return $this->STATUS; }
	private function getPAYMENT_DATE() { return $this->PAYMENT_DATE; }
	private function getUSER_CREATE() { return $this->USER_CREATE; }
	private function getDATE_CREATE() { return $this->DATE_CREATE; }
	private function getUSER_UPDATE() { return $this->USER_UPDATE; }
	private function getDATE_UPDATE() { return $this->DATE_UPDATE; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setID_LOAN($ID_LOAN) { $this->ID_LOAN = $ID_LOAN; }
	private function setN_PARTIAL($N_PARTIAL) { $this->N_PARTIAL = $N_PARTIAL; }
	private function setGROSS_AMOUNT($GROSS_AMOUNT) { $this->GROSS_AMOUNT = $GROSS_AMOUNT; }
	private function setFINANCIAL_ENTITY($FINANCIAL_ENTITY) { $this->FINANCIAL_ENTITY = $FINANCIAL_ENTITY; }
	private function setCURRENCY($CURRENCY) { $this->CURRENCY = $CURRENCY; }
	private function setINTERES_RATE($INTERES_RATE) { $this->INTERES_RATE = $INTERES_RATE; }
	private function setDEDUCTION($DEDUCTION) { $this->DEDUCTION = $DEDUCTION; }
	private function setTOTAL_AMOUNT($TOTAL_AMOUNT) { $this->TOTAL_AMOUNT = $TOTAL_AMOUNT; }
	private function setBALANCE($BALANCE) { $this->BALANCE = $BALANCE; }
	private function setTRANSACTION($TRANSACTION) { $this->TRANSACTION = $TRANSACTION; }
	private function setSTATUS($STATUS) { $this->STATUS = $STATUS; }
	private function setPAYMENT_DATE($PAYMENT_DATE) { $this->PAYMENT_DATE = $PAYMENT_DATE; }
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
            $query = $this->prepare('INSERT INTO FEES_DOCUMENTS( ID,  ID_LOAN,  N_PARTIAL,  GROSS_AMOUNT,  FINANCIAL_ENTITY,  CURRENCY,  INTERES_RATE,  DEDUCTION,  TOTAL_AMOUNT,  BALANCE,  TRANSACTION,  STATUS,  PAYMENT_DATE,  USER_CREATE,  DATE_CREATE,  USER_UPDATE,  DATE_UPDATE)
            VALUES(:ID, :ID_LOAN, :N_PARTIAL, :GROSS_AMOUNT, :FINANCIAL_ENTITY, :CURRENCY, :INTERES_RATE, :DEDUCTION, :TOTAL_AMOUNT, :BALANCE, :TRANSACTION, :STATUS, :PAYMENT_DATE, :USER_CREATE, :DATE_CREATE, :USER_UPDATE, :DATE_UPDATE)');
			$query->execute([
				'ID' => $this->ID,
				'ID_LOAN' => $this->ID_LOAN,
				'N_PARTIAL' => $this->N_PARTIAL,
				'GROSS_AMOUNT' => $this->GROSS_AMOUNT,
				'FINANCIAL_ENTITY' => $this->FINANCIAL_ENTITY,
				'CURRENCY' => $this->CURRENCY,
				'INTERES_RATE' => $this->INTERES_RATE,
				'DEDUCTION' => $this->DEDUCTION,
				'TOTAL_AMOUNT' => $this->TOTAL_AMOUNT,
				'BALANCE' => $this->BALANCE,
				'TRANSACTION' => $this->TRANSACTION,
				'STATUS' => $this->STATUS,
				'PAYMENT_DATE' => $this->PAYMENT_DATE,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('FEE_DOCUMENT::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM FEES_DOCUMENTS');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new FEE_DOCUMENT();
				$item->ID = $entidad['ID'];
				$item->ID_LOAN = $entidad['ID_LOAN'];
				$item->N_PARTIAL = $entidad['N_PARTIAL'];
				$item->GROSS_AMOUNT = $entidad['GROSS_AMOUNT'];
				$item->FINANCIAL_ENTITY = $entidad['FINANCIAL_ENTITY'];
				$item->CURRENCY = $entidad['CURRENCY'];
				$item->INTERES_RATE = $entidad['INTERES_RATE'];
				$item->DEDUCTION = $entidad['DEDUCTION'];
				$item->TOTAL_AMOUNT = $entidad['TOTAL_AMOUNT'];
				$item->BALANCE = $entidad['BALANCE'];
				$item->TRANSACTION = $entidad['TRANSACTION'];
				$item->STATUS = $entidad['STATUS'];
				$item->PAYMENT_DATE = $entidad['PAYMENT_DATE'];
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
			error_log('FEE_DOCUMENT::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM FEES_DOCUMENTS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$fee_document = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $fee_document['ID'];
			$this->ID_LOAN = $fee_document['ID_LOAN'];
			$this->N_PARTIAL = $fee_document['N_PARTIAL'];
			$this->GROSS_AMOUNT = $fee_document['GROSS_AMOUNT'];
			$this->FINANCIAL_ENTITY = $fee_document['FINANCIAL_ENTITY'];
			$this->CURRENCY = $fee_document['CURRENCY'];
			$this->INTERES_RATE = $fee_document['INTERES_RATE'];
			$this->DEDUCTION = $fee_document['DEDUCTION'];
			$this->TOTAL_AMOUNT = $fee_document['TOTAL_AMOUNT'];
			$this->BALANCE = $fee_document['BALANCE'];
			$this->TRANSACTION = $fee_document['TRANSACTION'];
			$this->STATUS = $fee_document['STATUS'];
			$this->PAYMENT_DATE = $fee_document['PAYMENT_DATE'];
			$this->USER_CREATE = $fee_document['USER_CREATE'];
			$this->DATE_CREATE = $fee_document['DATE_CREATE'];
			$this->USER_UPDATE = $fee_document['USER_UPDATE'];
			$this->DATE_UPDATE = $fee_document['DATE_UPDATE'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('FEE_DOCUMENT::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM FEES_DOCUMENTS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('FEE_DOCUMENT::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE FEES_DOCUMENTS SET ID_LOAN = :ID_LOAN, N_PARTIAL = :N_PARTIAL, GROSS_AMOUNT = :GROSS_AMOUNT, FINANCIAL_ENTITY = :FINANCIAL_ENTITY, CURRENCY = :CURRENCY, INTERES_RATE = :INTERES_RATE, DEDUCTION = :DEDUCTION, TOTAL_AMOUNT = :TOTAL_AMOUNT, BALANCE = :BALANCE, TRANSACTION = :TRANSACTION, STATUS = :STATUS, PAYMENT_DATE = :PAYMENT_DATE, USER_CREATE = :USER_CREATE, DATE_CREATE = :DATE_CREATE, USER_UPDATE = :USER_UPDATE, DATE_UPDATE = :DATE_UPDATE WHERE ID = :ID');
			$query->execute([
				'ID_LOAN' => $this->ID_LOAN,
				'N_PARTIAL' => $this->N_PARTIAL,
				'GROSS_AMOUNT' => $this->GROSS_AMOUNT,
				'FINANCIAL_ENTITY' => $this->FINANCIAL_ENTITY,
				'CURRENCY' => $this->CURRENCY,
				'INTERES_RATE' => $this->INTERES_RATE,
				'DEDUCTION' => $this->DEDUCTION,
				'TOTAL_AMOUNT' => $this->TOTAL_AMOUNT,
				'BALANCE' => $this->BALANCE,
				'TRANSACTION' => $this->TRANSACTION,
				'STATUS' => $this->STATUS,
				'PAYMENT_DATE' => $this->PAYMENT_DATE,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('FEE_DOCUMENT::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
				$this->ID = $data['ID'];
		$this->ID_LOAN = $data['ID_LOAN'];
		$this->N_PARTIAL = $data['N_PARTIAL'];
		$this->GROSS_AMOUNT = $data['GROSS_AMOUNT'];
		$this->FINANCIAL_ENTITY = $data['FINANCIAL_ENTITY'];
		$this->CURRENCY = $data['CURRENCY'];
		$this->INTERES_RATE = $data['INTERES_RATE'];
		$this->DEDUCTION = $data['DEDUCTION'];
		$this->TOTAL_AMOUNT = $data['TOTAL_AMOUNT'];
		$this->BALANCE = $data['BALANCE'];
		$this->TRANSACTION = $data['TRANSACTION'];
		$this->STATUS = $data['STATUS'];
		$this->PAYMENT_DATE = $data['PAYMENT_DATE'];
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