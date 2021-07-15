<?php

require_once 'libs/model.php';

class FINANCIAL_ENTITY extends Model implements IModel
{
	private $ID;
	private $DESCRIPTION;
	private $USER_CREATE;
	private $DATE_CREATE;
	private $USER_UPDATE;
	private $DATE_UPDATE;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getDESCRIPTION() { return $this->DESCRIPTION; }
	private function getUSER_CREATE() { return $this->USER_CREATE; }
	private function getDATE_CREATE() { return $this->DATE_CREATE; }
	private function getUSER_UPDATE() { return $this->USER_UPDATE; }
	private function getDATE_UPDATE() { return $this->DATE_UPDATE; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setDESCRIPTION($DESCRIPTION) { $this->DESCRIPTION = $DESCRIPTION; }
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

	public function Exist($id)
	{
		$query = $this->prepare('SELECT * FROM FINANCIAL_ENTITIES WHERE ID = :ID');
		$query->execute([
			'ID' => $this->ID
		]);

		return ($query->rowCount() != 0);
	}

    public function Save() 
    {
        try
        {
            $query = $this->prepare('INSERT INTO FINANCIAL_ENTITIES( ID,  DESCRIPTION,  USER_CREATE,  DATE_CREATE,  USER_UPDATE,  DATE_UPDATE)
            VALUES(:ID, :DESCRIPTION, :USER_CREATE, :DATE_CREATE, :USER_UPDATE, :DATE_UPDATE)');
			$query->execute([
				'ID' => $this->ID,
				'DESCRIPTION' => $this->DESCRIPTION,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('FINANCIAL_ENTITY::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM FINANCIAL_ENTITIES');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new FINANCIAL_ENTITY();
				$item->ID = $entidad['ID'];
				$item->DESCRIPTION = $entidad['DESCRIPTION'];
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
			error_log('FINANCIAL_ENTITY::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM FINANCIAL_ENTITIES WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$financial_entity = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $financial_entity['ID'];
			$this->DESCRIPTION = $financial_entity['DESCRIPTION'];
			$this->USER_CREATE = $financial_entity['USER_CREATE'];
			$this->DATE_CREATE = $financial_entity['DATE_CREATE'];
			$this->USER_UPDATE = $financial_entity['USER_UPDATE'];
			$this->DATE_UPDATE = $financial_entity['DATE_UPDATE'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('FINANCIAL_ENTITY::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM FINANCIAL_ENTITIES WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('FINANCIAL_ENTITY::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE FINANCIAL_ENTITIES SET DESCRIPTION = :DESCRIPTION, USER_CREATE = :USER_CREATE, DATE_CREATE = :DATE_CREATE, USER_UPDATE = :USER_UPDATE, DATE_UPDATE = :DATE_UPDATE WHERE ID = :ID');
			$query->execute([
				'DESCRIPTION' => $this->DESCRIPTION,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('FINANCIAL_ENTITY::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
				$this->ID = $data['ID'];
		$this->DESCRIPTION = $data['DESCRIPTION'];
		$this->USER_CREATE = $data['USER_CREATE'];
		$this->DATE_CREATE = $data['DATE_CREATE'];
		$this->USER_UPDATE = $data['USER_UPDATE'];
		$this->DATE_UPDATE = $data['DATE_UPDATE'];

	}   
                
}
?>