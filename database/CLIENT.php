<?php

require_once 'libs/model.php';

class CLIENT extends Model implements IModel
{
	private $ID;
	private $ACCOUNTS_PAYABLE;
	private $LOANS;
	private $TYPE;
	private $USER_CREATE;
	private $DATE_CREATE;
	private $USER_UPDATE;
	private $DATE_UPDATE;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getACCOUNTS_PAYABLE() { return $this->ACCOUNTS_PAYABLE; }
	private function getLOANS() { return $this->LOANS; }
	private function getTYPE() { return $this->TYPE; }
	private function getUSER_CREATE() { return $this->USER_CREATE; }
	private function getDATE_CREATE() { return $this->DATE_CREATE; }
	private function getUSER_UPDATE() { return $this->USER_UPDATE; }
	private function getDATE_UPDATE() { return $this->DATE_UPDATE; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setACCOUNTS_PAYABLE($ACCOUNTS_PAYABLE) { $this->ACCOUNTS_PAYABLE = $ACCOUNTS_PAYABLE; }
	private function setLOANS($LOANS) { $this->LOANS = $LOANS; }
	private function setTYPE($TYPE) { $this->TYPE = $TYPE; }
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
            $query = $this->prepare('INSERT INTO CLIENTS( ID,  ACCOUNTS_PAYABLE,  LOANS,  TYPE,  USER_CREATE,  DATE_CREATE,  USER_UPDATE,  DATE_UPDATE)
            VALUES(:ID, :ACCOUNTS_PAYABLE, :LOANS, :TYPE, :USER_CREATE, :DATE_CREATE, :USER_UPDATE, :DATE_UPDATE)');
			$query->execute([
				'ID' => $this->ID,
				'ACCOUNTS_PAYABLE' => $this->ACCOUNTS_PAYABLE,
				'LOANS' => $this->LOANS,
				'TYPE' => $this->TYPE,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('CLIENT::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM CLIENTS');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new CLIENT();
				$item->ID = $entidad['ID'];
				$item->ACCOUNTS_PAYABLE = $entidad['ACCOUNTS_PAYABLE'];
				$item->LOANS = $entidad['LOANS'];
				$item->TYPE = $entidad['TYPE'];
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
			error_log('CLIENT::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM CLIENTS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$client = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $client['ID'];
			$this->ACCOUNTS_PAYABLE = $client['ACCOUNTS_PAYABLE'];
			$this->LOANS = $client['LOANS'];
			$this->TYPE = $client['TYPE'];
			$this->USER_CREATE = $client['USER_CREATE'];
			$this->DATE_CREATE = $client['DATE_CREATE'];
			$this->USER_UPDATE = $client['USER_UPDATE'];
			$this->DATE_UPDATE = $client['DATE_UPDATE'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('CLIENT::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM CLIENTS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('CLIENT::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE CLIENTS SET ACCOUNTS_PAYABLE = :ACCOUNTS_PAYABLE, LOANS = :LOANS, TYPE = :TYPE, USER_CREATE = :USER_CREATE, DATE_CREATE = :DATE_CREATE, USER_UPDATE = :USER_UPDATE, DATE_UPDATE = :DATE_UPDATE WHERE ID = :ID');
			$query->execute([
				'ID' => $this->ID,
				'ACCOUNTS_PAYABLE' => $this->ACCOUNTS_PAYABLE,
				'LOANS' => $this->LOANS,
				'TYPE' => $this->TYPE,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('CLIENT::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
		$this->ID = $data['ID'];
		$this->ACCOUNTS_PAYABLE = $data['ACCOUNTS_PAYABLE'];
		$this->LOANS = $data['LOANS'];
		$this->TYPE = $data['TYPE'];
		$this->USER_CREATE = $data['USER_CREATE'];
		$this->DATE_CREATE = $data['DATE_CREATE'];
		$this->USER_UPDATE = $data['USER_UPDATE'];
		$this->DATE_UPDATE = $data['DATE_UPDATE'];

	}   
                
}
?>