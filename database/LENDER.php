<?php

require_once 'libs/model.php';

class LENDER extends Model implements IModel
{
	private $ID;
	private $CAPITAL;
	private $ACCOUNTS_RECEIVABLE;
	private $LOANS;
	private $USER_CREATE;
	private $DATE_CREATE;
	private $USER_UPDATE;
	private $DATE_UPDATE;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getCAPITAL() { return $this->CAPITAL; }
	private function getACCOUNTS_RECEIVABLE() { return $this->ACCOUNTS_RECEIVABLE; }
	private function getLOANS() { return $this->LOANS; }
	private function getUSER_CREATE() { return $this->USER_CREATE; }
	private function getDATE_CREATE() { return $this->DATE_CREATE; }
	private function getUSER_UPDATE() { return $this->USER_UPDATE; }
	private function getDATE_UPDATE() { return $this->DATE_UPDATE; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setCAPITAL($CAPITAL) { $this->CAPITAL = $CAPITAL; }
	private function setACCOUNTS_RECEIVABLE($ACCOUNTS_RECEIVABLE) { $this->ACCOUNTS_RECEIVABLE = $ACCOUNTS_RECEIVABLE; }
	private function setLOANS($LOANS) { $this->LOANS = $LOANS; }
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
		$this->ID = '';
		$this->CAPITAL = '';
		$this->ACCOUNTS_RECEIVABLE = '';
		$this->LOANS = '';
		$this->USER_CREATE = '';
		$this->DATE_CREATE = '';
		$this->USER_UPDATE = '';
		$this->DATE_UPDATE = '';
	}
    public function Save() 
    {
        try
        {
            $query = $this->prepare('INSERT INTO LENDERS( ID,  CAPITAL,  ACCOUNTS_RECEIVABLE,  LOANS,  USER_CREATE,  DATE_CREATE,  USER_UPDATE,  DATE_UPDATE)
            VALUES(:ID, :CAPITAL, :ACCOUNTS_RECEIVABLE, :LOANS, :USER_CREATE, :DATE_CREATE, :USER_UPDATE, :DATE_UPDATE)');
			$query->execute([
				'ID' => $this->ID,
				'CAPITAL' => $this->CAPITAL,
				'ACCOUNTS_RECEIVABLE' => $this->ACCOUNTS_RECEIVABLE,
				'LOANS' => $this->LOANS,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('LENDER::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM LENDERS');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new LENDER();
				$item->ID = $entidad['ID'];
				$item->CAPITAL = $entidad['CAPITAL'];
				$item->ACCOUNTS_RECEIVABLE = $entidad['ACCOUNTS_RECEIVABLE'];
				$item->LOANS = $entidad['LOANS'];
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
			error_log('LENDER::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM LENDERS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$lender = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $lender['ID'];
			$this->CAPITAL = $lender['CAPITAL'];
			$this->ACCOUNTS_RECEIVABLE = $lender['ACCOUNTS_RECEIVABLE'];
			$this->LOANS = $lender['LOANS'];
			$this->USER_CREATE = $lender['USER_CREATE'];
			$this->DATE_CREATE = $lender['DATE_CREATE'];
			$this->USER_UPDATE = $lender['USER_UPDATE'];
			$this->DATE_UPDATE = $lender['DATE_UPDATE'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('LENDER::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM LENDERS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('LENDER::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE LENDERS SET CAPITAL = :CAPITAL, ACCOUNTS_RECEIVABLE = :ACCOUNTS_RECEIVABLE, LOANS = :LOANS, USER_CREATE = :USER_CREATE, DATE_CREATE = :DATE_CREATE, USER_UPDATE = :USER_UPDATE, DATE_UPDATE = :DATE_UPDATE WHERE ID = :ID');
			$query->execute([
				'CAPITAL' => $this->CAPITAL,
				'ACCOUNTS_RECEIVABLE' => $this->ACCOUNTS_RECEIVABLE,
				'LOANS' => $this->LOANS,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('LENDER::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
		$this->ID = $data['ID'];
		$this->CAPITAL = $data['CAPITAL'];
		$this->ACCOUNTS_RECEIVABLE = $data['ACCOUNTS_RECEIVABLE'];
		$this->LOANS = $data['LOANS'];
		$this->USER_CREATE = $data['USER_CREATE'];
		$this->DATE_CREATE = $data['DATE_CREATE'];
		$this->USER_UPDATE = $data['USER_UPDATE'];
		$this->DATE_UPDATE = $data['DATE_UPDATE'];

	}   
                
}
?>