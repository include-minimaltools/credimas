<?php

class PAYMENT_DETAIL extends Model implements IModel
{
	private $ID;
	private $ID_FEE_DOCUMENT;
	private $ID_CLIENT;
	private $AMOUNT;
	private $CURRENCY;
	private $EXCHANGE_RATE;
	private $FINANCIAL_ENTITY;
	private $TRANSACTION;
	private $STATUS;
	private $USER_CREATE;
	private $DATE_CREATE;
	private $USER_UPDATE;
	private $DATE_UPDATE;
	private $CURRENCY_DOCUMENT;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getID_FEE_DOCUMENT() { return $this->ID_FEE_DOCUMENT; }
	private function getID_CLIENT() { return $this->ID_CLIENT; }
	private function getAMOUNT() { return $this->AMOUNT; }
	private function getCURRENCY() { return $this->CURRENCY; }
	private function getEXCHANGE_RATE() { return $this->EXCHANGE_RATE; }
	private function getFINANCIAL_ENTITY() { return $this->FINANCIAL_ENTITY; }
	private function getTRANSACTION() { return $this->TRANSACTION; }
	private function getSTATUS() { return $this->STATUS; }
	private function getUSER_CREATE() { return $this->USER_CREATE; }
	private function getDATE_CREATE() { return $this->DATE_CREATE; }
	private function getUSER_UPDATE() { return $this->USER_UPDATE; }
	private function getDATE_UPDATE() { return $this->DATE_UPDATE; }
	private function getCURRENCY_DOCUMENT() { return $this->CURRENCY_DOCUMENT; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setID_FEE_DOCUMENT($ID_FEE_DOCUMENT) { $this->ID_FEE_DOCUMENT = $ID_FEE_DOCUMENT; }
	private function setID_CLIENT($ID_CLIENT) { $this->ID_CLIENT = $ID_CLIENT; }
	private function setAMOUNT($AMOUNT) { $this->AMOUNT = $AMOUNT; }
	private function setCURRENCY($CURRENCY) { $this->CURRENCY = $CURRENCY; }
	private function setEXCHANGE_RATE($EXCHANGE_RATE) { $this->EXCHANGE_RATE = $EXCHANGE_RATE; }
	private function setFINANCIAL_ENTITY($FINANCIAL_ENTITY) { $this->FINANCIAL_ENTITY = $FINANCIAL_ENTITY; }
	private function setTRANSACTION($TRANSACTION) { $this->TRANSACTION = $TRANSACTION; }
	private function setSTATUS($STATUS) { $this->STATUS = $STATUS; }
	private function setUSER_CREATE($USER_CREATE) { $this->USER_CREATE = $USER_CREATE; }
	private function setDATE_CREATE($DATE_CREATE) { $this->DATE_CREATE = $DATE_CREATE; }
	private function setUSER_UPDATE($USER_UPDATE) { $this->USER_UPDATE = $USER_UPDATE; }
	private function setDATE_UPDATE($DATE_UPDATE) { $this->DATE_UPDATE = $DATE_UPDATE; }
	private function setCURRENCY_DOCUMENT($CURRENCY_DOCUMENT) { $this->CURRENCY_DOCUMENT = $CURRENCY_DOCUMENT; }

	public function jsonSerialize()
	{
		return json_encode(get_object_vars($this));
	}

	public function array()
	{
		return get_object_vars($this);
	}

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
            $query = $this->prepare('INSERT INTO PAYMENTS_DETAILS( ID,  ID_FEE_DOCUMENT,  ID_CLIENT,  AMOUNT,  CURRENCY,  EXCHANGE_RATE,  FINANCIAL_ENTITY,  TRANSACTION,  STATUS,  USER_CREATE,  DATE_CREATE,  USER_UPDATE,  DATE_UPDATE,  CURRENCY_DOCUMENT)
            VALUES(:ID, :ID_FEE_DOCUMENT, :ID_CLIENT, :AMOUNT, :CURRENCY, :EXCHANGE_RATE, :FINANCIAL_ENTITY, :TRANSACTION, :STATUS, :USER_CREATE, :DATE_CREATE, :USER_UPDATE, :DATE_UPDATE, :CURRENCY_DOCUMENT)');
			$query->execute([
				'ID' => $this->ID,
				'ID_FEE_DOCUMENT' => $this->ID_FEE_DOCUMENT,
				'ID_CLIENT' => $this->ID_CLIENT,
				'AMOUNT' => $this->AMOUNT,
				'CURRENCY' => $this->CURRENCY,
				'EXCHANGE_RATE' => $this->EXCHANGE_RATE,
				'FINANCIAL_ENTITY' => $this->FINANCIAL_ENTITY,
				'TRANSACTION' => $this->TRANSACTION,
				'STATUS' => $this->STATUS,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE,
				'CURRENCY_DOCUMENT' => $this->CURRENCY_DOCUMENT
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('PAYMENT_DETAIL::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM PAYMENTS_DETAILS');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new PAYMENT_DETAIL();
				$item->ID = $entidad['ID'];
				$item->ID_FEE_DOCUMENT = $entidad['ID_FEE_DOCUMENT'];
				$item->ID_CLIENT = $entidad['ID_CLIENT'];
				$item->AMOUNT = $entidad['AMOUNT'];
				$item->CURRENCY = $entidad['CURRENCY'];
				$item->EXCHANGE_RATE = $entidad['EXCHANGE_RATE'];
				$item->FINANCIAL_ENTITY = $entidad['FINANCIAL_ENTITY'];
				$item->TRANSACTION = $entidad['TRANSACTION'];
				$item->STATUS = $entidad['STATUS'];
				$item->USER_CREATE = $entidad['USER_CREATE'];
				$item->DATE_CREATE = $entidad['DATE_CREATE'];
				$item->USER_UPDATE = $entidad['USER_UPDATE'];
				$item->DATE_UPDATE = $entidad['DATE_UPDATE'];
				$item->CURRENCY_DOCUMENT = $entidad['CURRENCY_DOCUMENT'];

				array_push($result, $item);
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			error_log('PAYMENT_DETAIL::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM PAYMENTS_DETAILS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$payment_detail = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $payment_detail['ID'];
			$this->ID_FEE_DOCUMENT = $payment_detail['ID_FEE_DOCUMENT'];
			$this->ID_CLIENT = $payment_detail['ID_CLIENT'];
			$this->AMOUNT = $payment_detail['AMOUNT'];
			$this->CURRENCY = $payment_detail['CURRENCY'];
			$this->EXCHANGE_RATE = $payment_detail['EXCHANGE_RATE'];
			$this->FINANCIAL_ENTITY = $payment_detail['FINANCIAL_ENTITY'];
			$this->TRANSACTION = $payment_detail['TRANSACTION'];
			$this->STATUS = $payment_detail['STATUS'];
			$this->USER_CREATE = $payment_detail['USER_CREATE'];
			$this->DATE_CREATE = $payment_detail['DATE_CREATE'];
			$this->USER_UPDATE = $payment_detail['USER_UPDATE'];
			$this->DATE_UPDATE = $payment_detail['DATE_UPDATE'];
			$this->CURRENCY_DOCUMENT = $payment_detail['CURRENCY_DOCUMENT'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('PAYMENT_DETAIL::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM PAYMENTS_DETAILS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('PAYMENT_DETAIL::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE PAYMENTS_DETAILS SET ID_FEE_DOCUMENT = :ID_FEE_DOCUMENT, ID_CLIENT = :ID_CLIENT, AMOUNT = :AMOUNT, CURRENCY = :CURRENCY, EXCHANGE_RATE = :EXCHANGE_RATE, FINANCIAL_ENTITY = :FINANCIAL_ENTITY, TRANSACTION = :TRANSACTION, STATUS = :STATUS, USER_CREATE = :USER_CREATE, DATE_CREATE = :DATE_CREATE, USER_UPDATE = :USER_UPDATE, DATE_UPDATE = :DATE_UPDATE, CURRENCY_DOCUMENT = :CURRENCY_DOCUMENT WHERE ID = :ID');
			$query->execute([
				'ID' => $this->ID,
				'ID_FEE_DOCUMENT' => $this->ID_FEE_DOCUMENT,
				'ID_CLIENT' => $this->ID_CLIENT,
				'AMOUNT' => $this->AMOUNT,
				'CURRENCY' => $this->CURRENCY,
				'EXCHANGE_RATE' => $this->EXCHANGE_RATE,
				'FINANCIAL_ENTITY' => $this->FINANCIAL_ENTITY,
				'TRANSACTION' => $this->TRANSACTION,
				'STATUS' => $this->STATUS,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE,
				'CURRENCY_DOCUMENT' => $this->CURRENCY_DOCUMENT
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('PAYMENT_DETAIL::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
		$this->ID = $data['ID'];
		$this->ID_FEE_DOCUMENT = $data['ID_FEE_DOCUMENT'];
		$this->ID_CLIENT = $data['ID_CLIENT'];
		$this->AMOUNT = $data['AMOUNT'];
		$this->CURRENCY = $data['CURRENCY'];
		$this->EXCHANGE_RATE = $data['EXCHANGE_RATE'];
		$this->FINANCIAL_ENTITY = $data['FINANCIAL_ENTITY'];
		$this->TRANSACTION = $data['TRANSACTION'];
		$this->STATUS = $data['STATUS'];
		$this->USER_CREATE = $data['USER_CREATE'];
		$this->DATE_CREATE = $data['DATE_CREATE'];
		$this->USER_UPDATE = $data['USER_UPDATE'];
		$this->DATE_UPDATE = $data['DATE_UPDATE'];
		$this->CURRENCY_DOCUMENT = $data['CURRENCY_DOCUMENT'];

	}   
                
}
?>