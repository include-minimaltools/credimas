<?php

class CONSECUTIVE extends Model implements IModel
{
	private $ID;
	private $USERS;
	private $FEES_DOCUMENTS;
	private $LOAN_DOCUMENTS;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getUSERS() { return $this->USERS; }
	private function getFEES_DOCUMENTS() { return $this->FEES_DOCUMENTS; }
	private function getLOAN_DOCUMENTS() { return $this->LOAN_DOCUMENTS; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setUSERS($USERS) { $this->USERS = $USERS; }
	private function setFEES_DOCUMENTS($FEES_DOCUMENTS) { $this->FEES_DOCUMENTS = $FEES_DOCUMENTS; }
	private function setLOAN_DOCUMENTS($LOAN_DOCUMENTS) { $this->LOAN_DOCUMENTS = $LOAN_DOCUMENTS; }

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
            $query = $this->prepare('INSERT INTO CONSECUTIVE( ID,  USERS,  FEES_DOCUMENTS,  LOAN_DOCUMENTS)
            VALUES(:ID, :USERS, :FEES_DOCUMENTS, :LOAN_DOCUMENTS)');
			$query->execute([
				'ID' => $this->ID,
				'USERS' => $this->USERS,
				'FEES_DOCUMENTS' => $this->FEES_DOCUMENTS,
				'LOAN_DOCUMENTS' => $this->LOAN_DOCUMENTS
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('CONSECUTIVE::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM CONSECUTIVE');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new CONSECUTIVE();
				$item->ID = $entidad['ID'];
				$item->USERS = $entidad['USERS'];
				$item->FEES_DOCUMENTS = $entidad['FEES_DOCUMENTS'];
				$item->LOAN_DOCUMENTS = $entidad['LOAN_DOCUMENTS'];

				array_push($result, $item);
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			error_log('CONSECUTIVE::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM CONSECUTIVE WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$consecutive = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $consecutive['ID'];
			$this->USERS = $consecutive['USERS'];
			$this->FEES_DOCUMENTS = $consecutive['FEES_DOCUMENTS'];
			$this->LOAN_DOCUMENTS = $consecutive['LOAN_DOCUMENTS'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('CONSECUTIVE::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM CONSECUTIVE WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('CONSECUTIVE::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE CONSECUTIVE SET USERS = :USERS, FEES_DOCUMENTS = :FEES_DOCUMENTS, LOAN_DOCUMENTS = :LOAN_DOCUMENTS WHERE ID = :ID');
			$query->execute([
                'ID' => $this->ID,
				'USERS' => $this->USERS,
				'FEES_DOCUMENTS' => $this->FEES_DOCUMENTS,
				'LOAN_DOCUMENTS' => $this->LOAN_DOCUMENTS
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('CONSECUTIVE::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
		$this->ID = $data['ID'];
		$this->USERS = $data['USERS'];
		$this->FEES_DOCUMENTS = $data['FEES_DOCUMENTS'];
		$this->LOAN_DOCUMENTS = $data['LOAN_DOCUMENTS'];
	}           
}
?>