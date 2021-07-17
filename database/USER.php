<?php

require_once 'libs/model.php';

class USER extends Model implements IModel, JsonSerializable
{
	private $ID;
	private $USERNAME;
	private $PASSWORD;
	private $ROLE;
	private $PHOTO;
	private $ADDRESS;
	private $PHONE;
	private $FIRST_NAME;
	private $SECOND_NAME;
	private $FIRST_LASTNAME;
	private $SECOND_LASTNAME;
	private $IDENTIFICATION;
	private $IDENTIFICATION_PHOTO;
	private $USER_CREATE;
	private $DATE_CREATE;
	private $USER_UPDATE;
	private $DATE_UPDATE;
	private $VERIFIED;

	#region get/set
	//getters
	private function getID() { return $this->ID; }
	private function getUSERNAME() { return $this->USERNAME; }
	private function getPASSWORD() { return $this->PASSWORD; }
	private function getROLE() { return $this->ROLE; }
	private function getPHOTO() { return $this->PHOTO; }
	private function getADDRESS() { return $this->ADDRESS; }
	private function getPHONE() { return $this->PHONE; }
	private function getFIRST_NAME() { return $this->FIRST_NAME; }
	private function getSECOND_NAME() { return $this->SECOND_NAME; }
	private function getFIRST_LASTNAME() { return $this->FIRST_LASTNAME; }
	private function getSECOND_LASTNAME() { return $this->SECOND_LASTNAME; }
	private function getIDENTIFICATION() { return $this->IDENTIFICATION; }
	private function getIDENTIFICATION_PHOTO() { return $this->IDENTIFICATION_PHOTO; }
	private function getUSER_CREATE() { return $this->USER_CREATE; }
	private function getDATE_CREATE() { return $this->DATE_CREATE; }
	private function getUSER_UPDATE() { return $this->USER_UPDATE; }
	private function getDATE_UPDATE() { return $this->DATE_UPDATE; }
	private function getVERIFIED() { return $this->VERIFIED; }

	//setters
	private function setID($ID) { $this->ID = $ID; }
	private function setUSERNAME($USERNAME) { $this->USERNAME = $USERNAME; }
	private function setPASSWORD($PASSWORD) { $this->PASSWORD = $this->getHashedPassword($PASSWORD); }
	private function setROLE($ROLE) { $this->ROLE = $ROLE; }
	private function setPHOTO($PHOTO) { $this->PHOTO = $PHOTO; }
	private function setADDRESS($ADDRESS) { $this->ADDRESS = $ADDRESS; }
	private function setPHONE($PHONE) { $this->PHONE = $PHONE; }
	private function setFIRST_NAME($FIRST_NAME) { $this->FIRST_NAME = $FIRST_NAME; }
	private function setSECOND_NAME($SECOND_NAME) { $this->SECOND_NAME = $SECOND_NAME; }
	private function setFIRST_LASTNAME($FIRST_LASTNAME) { $this->FIRST_LASTNAME = $FIRST_LASTNAME; }
	private function setSECOND_LASTNAME($SECOND_LASTNAME) { $this->SECOND_LASTNAME = $SECOND_LASTNAME; }
	private function setIDENTIFICATION($IDENTIFICATION) { $this->IDENTIFICATION = $IDENTIFICATION; }
	private function setIDENTIFICATION_PHOTO($IDENTIFICATION_PHOTO) { $this->IDENTIFICATION_PHOTO = $IDENTIFICATION_PHOTO; }
	private function setUSER_CREATE($USER_CREATE) { $this->USER_CREATE = $USER_CREATE; }
	private function setDATE_CREATE($DATE_CREATE) { $this->DATE_CREATE = $DATE_CREATE; }
	private function setUSER_UPDATE($USER_UPDATE) { $this->USER_UPDATE = $USER_UPDATE; }
	private function setDATE_UPDATE($DATE_UPDATE) { $this->DATE_UPDATE = $DATE_UPDATE; }
	private function setVERIFIED($VERIFIED) { $this->VERIFIED = $VERIFIED; }

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
		$this->VERIFIED = false;
	}

	private function getHashedPassword($password)
	{
		return password_hash($password, PASSWORD_DEFAULT, ['cost' => 5]);
	}

	public function Exists($id)
	{
		try
		{
			$query = $this->prepare('SELECT * FROM USERS WHERE ID = :ID');
			$query->execute(['ID' => $id]);

			error_log('USER::Exist() -> rowCount'.$query->rowCount());

			return ($query->rowCount() != 0);
		}
		catch (PDOException $ex)
		{
            error_log('USER::Exists->PDOException: '. $ex);
            return false;
        }
	}

	public function ExistsUsername($username)
	{
		try
		{
			error_log('USER::Exist('.$username.')');
			$query = $this->prepare('SELECT * FROM USERS WHERE USERNAME = :USERNAME');
			$query->execute(['USERNAME' => $username]);

			error_log('USER::Exist() -> rowCount'.$query->rowCount());

			return ($query->rowCount() != 0);
		}
		catch (PDOException $ex)
		{
            error_log('USER::Exists->PDOException: '. $ex);
            return false;
        }
	}

	public function ComparePassword($password, $id)
	{
		try
		{
			$user = $this->Get($id);
			return password_verify($password, $user->PASSWORD);
		}
		catch (PDOException $ex)
		{
            error_log('USER::ComparePassword->PDOException: '. $ex);
            return false;
        }
	}

    public function Save() 
    {
        try
        {
            $query = $this->prepare('INSERT INTO USERS(USERNAME,  PASSWORD,  ROLE,  PHOTO,  ADDRESS,  PHONE,  FIRST_NAME,  SECOND_NAME,  FIRST_LASTNAME,  SECOND_LASTNAME,  IDENTIFICATION, IDENTIFICATION_PHOTO, USER_CREATE,  DATE_CREATE,  USER_UPDATE,  DATE_UPDATE,  VERIFIED)
            VALUES(:USERNAME, :PASSWORD, :ROLE, :PHOTO, :ADDRESS, :PHONE, :FIRST_NAME, :SECOND_NAME, :FIRST_LASTNAME, :SECOND_LASTNAME, :IDENTIFICATION, :IDENTIFICATION_PHOTO,:USER_CREATE, :DATE_CREATE, :USER_UPDATE, :DATE_UPDATE, :VERIFIED)');
			$query->execute([
				'USERNAME' => $this->USERNAME,
				'PASSWORD' => $this->PASSWORD,
				'ROLE' => $this->ROLE,
				'PHOTO' => $this->PHOTO,
				'ADDRESS' => $this->ADDRESS,
				'PHONE' => $this->PHONE,
				'FIRST_NAME' => $this->FIRST_NAME,
				'SECOND_NAME' => $this->SECOND_NAME,
				'FIRST_LASTNAME' => $this->FIRST_LASTNAME,
				'SECOND_LASTNAME' => $this->SECOND_LASTNAME,
				'IDENTIFICATION' => $this->IDENTIFICATION,
				'IDENTIFICATION_PHOTO' => $this->IDENTIFICATION_PHOTO,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE,
				'VERIFIED' => $this->VERIFIED
            ]);

            return true;
        }
        catch (PDOException $ex)
		{
            error_log('USERS::Save->PDOException: '. $ex);
            return false;
        }
    }

    public function GetAll() 
	{
		$result = [];

		try
		{
			$query = $this->query('SELECT * FROM USERS');

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new USER();
				$item->ID = $entidad['ID'];
				$item->USERNAME = $entidad['USERNAME'];
				$item->PASSWORD = $entidad['PASSWORD'];
				$item->ROLE = $entidad['ROLE'];
				$item->PHOTO = $entidad['PHOTO'];
				$item->ADDRESS = $entidad['ADDRESS'];
				$item->PHONE = $entidad['PHONE'];
				$item->FIRST_NAME = $entidad['FIRST_NAME'];
				$item->SECOND_NAME = $entidad['SECOND_NAME'];
				$item->FIRST_LASTNAME = $entidad['FIRST_LASTNAME'];
				$item->SECOND_LASTNAME = $entidad['SECOND_LASTNAME'];
				$item->IDENTIFICATION = $entidad['IDENTIFICATION'];
				$item->IDENTIFICATION_PHOTO = $entidad['IDENTIFICATION_PHOTO'];
				$item->USER_CREATE = $entidad['USER_CREATE'];
				$item->DATE_CREATE = $entidad['DATE_CREATE'];
				$item->USER_UPDATE = $entidad['USER_UPDATE'];
				$item->DATE_UPDATE = $entidad['DATE_UPDATE'];
				$item->VERIFIED = $entidad['VERIFIED'];

				array_push($result, $item);
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			error_log('USERS::GetAll->PDOException: ' . $ex);
			return false;
		}
	}

	public function GetByRole($role) 
	{
		$result = [];

		try
		{
			$query = $this->prepare('SELECT * FROM USERS WHERE ROLE = :ROLE');
			$query->execute([
				'ROLE' => $role
			]);

			while($entidad = $query->fetch(PDO::FETCH_ASSOC))
			{
				$item = new USER();
				$item->ID = $entidad['ID'];
				$item->USERNAME = $entidad['USERNAME'];
				$item->PASSWORD = $entidad['PASSWORD'];
				$item->ROLE = $entidad['ROLE'];
				$item->PHOTO = $entidad['PHOTO'];
				$item->ADDRESS = $entidad['ADDRESS'];
				$item->PHONE = $entidad['PHONE'];
				$item->FIRST_NAME = $entidad['FIRST_NAME'];
				$item->SECOND_NAME = $entidad['SECOND_NAME'];
				$item->FIRST_LASTNAME = $entidad['FIRST_LASTNAME'];
				$item->SECOND_LASTNAME = $entidad['SECOND_LASTNAME'];
				$item->IDENTIFICATION = $entidad['IDENTIFICATION'];
				$item->IDENTIFICATION_PHOTO = $entidad['IDENTIFICATION_PHOTO'];
				$item->USER_CREATE = $entidad['USER_CREATE'];
				$item->DATE_CREATE = $entidad['DATE_CREATE'];
				$item->USER_UPDATE = $entidad['USER_UPDATE'];
				$item->DATE_UPDATE = $entidad['DATE_UPDATE'];
				$item->VERIFIED = $entidad['VERIFIED'];

				array_push($result, $item);
			}
			
			return $result;
		}
		catch(PDOException $ex)
		{
			error_log('USERS::GetByRole->PDOException: ' . $ex);
			return false;
		}
	}

    public function Get($id) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM USERS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);

			$users = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $users['ID'];
			$this->USERNAME = $users['USERNAME'];
			$this->PASSWORD = $users['PASSWORD'];
			$this->ROLE = $users['ROLE'];
			$this->PHOTO = $users['PHOTO'];
			$this->ADDRESS = $users['ADDRESS'];
			$this->PHONE = $users['PHONE'];
			$this->FIRST_NAME = $users['FIRST_NAME'];
			$this->SECOND_NAME = $users['SECOND_NAME'];
			$this->FIRST_LASTNAME = $users['FIRST_LASTNAME'];
			$this->SECOND_LASTNAME = $users['SECOND_LASTNAME'];
			$this->IDENTIFICATION = $users['IDENTIFICATION'];
			$this->IDENTIFICATION_PHOTO = $users['IDENTIFICATION_PHOTO'];
			$this->USER_CREATE = $users['USER_CREATE'];
			$this->DATE_CREATE = $users['DATE_CREATE'];
			$this->USER_UPDATE = $users['USER_UPDATE'];
			$this->DATE_UPDATE = $users['DATE_UPDATE'];
			$this->VERIFIED = $users['VERIFIED'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('USERS::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

	public function GetByUsername($username) 
	{
		try
		{
			$query = $this->prepare('SELECT * FROM USERS WHERE USERNAME = :USERNAME');
			$query->execute([
				'USERNAME' => $username
			]);

			$users = $query->fetch(PDO::FETCH_ASSOC);
			$this->ID = $users['ID'];
			$this->USERNAME = $users['USERNAME'];
			$this->PASSWORD = $users['PASSWORD'];
			$this->ROLE = $users['ROLE'];
			$this->PHOTO = $users['PHOTO'];
			$this->ADDRESS = $users['ADDRESS'];
			$this->PHONE = $users['PHONE'];
			$this->FIRST_NAME = $users['FIRST_NAME'];
			$this->SECOND_NAME = $users['SECOND_NAME'];
			$this->FIRST_LASTNAME = $users['FIRST_LASTNAME'];
			$this->SECOND_LASTNAME = $users['SECOND_LASTNAME'];
			$this->IDENTIFICATION = $users['IDENTIFICATION'];
			$this->IDENTIFICATION_PHOTO = $users['IDENTIFICATION_PHOTO'];
			$this->USER_CREATE = $users['USER_CREATE'];
			$this->DATE_CREATE = $users['DATE_CREATE'];
			$this->USER_UPDATE = $users['USER_UPDATE'];
			$this->DATE_UPDATE = $users['DATE_UPDATE'];
			$this->VERIFIED = $users['VERIFIED'];

			
			return $this;
		}
		catch(PDOException $ex)
		{
			error_log('USERS::GetItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function Delete($id) 
	{
		try
		{
			$query = $this->prepare('DELETE FROM USERS WHERE ID = :ID');
			$query->execute([
				'ID' => $id
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('USERS::DeleteItem->PDOException: ' . $ex);
			return false;
		}	
	}
    
    public function Update() 
	{
		try
		{
			$query = $this->prepare('UPDATE USERS SET USERNAME = :USERNAME, PASSWORD = :PASSWORD, ROLE = :ROLE, PHOTO = :PHOTO, ADDRESS = :ADDRESS, PHONE = :PHONE, FIRST_NAME = :FIRST_NAME, SECOND_NAME = :SECOND_NAME, FIRST_LASTNAME = :FIRST_LASTNAME, SECOND_LASTNAME = :SECOND_LASTNAME, IDENTIFICATION = :IDENTIFICATION, IDENTIFICATION_PHOTO = :IDENTIFICATION_PHOTO, USER_CREATE = :USER_CREATE, DATE_CREATE = :DATE_CREATE, USER_UPDATE = :USER_UPDATE, DATE_UPDATE = :DATE_UPDATE, VERIFIED = :VERIFIED WHERE ID = :ID');
			$query->execute([
				'ID' => $this->ID,
				'USERNAME' => $this->USERNAME,
				'PASSWORD' => $this->PASSWORD,
				'ROLE' => $this->ROLE,
				'PHOTO' => $this->PHOTO,
				'ADDRESS' => $this->ADDRESS,
				'PHONE' => $this->PHONE,
				'FIRST_NAME' => $this->FIRST_NAME,
				'SECOND_NAME' => $this->SECOND_NAME,
				'FIRST_LASTNAME' => $this->FIRST_LASTNAME,
				'SECOND_LASTNAME' => $this->SECOND_LASTNAME,
				'IDENTIFICATION' => $this->IDENTIFICATION,
				'IDENTIFICATION_PHOTO' => $this->IDENTIFICATION_PHOTO,
				'USER_CREATE' => $this->USER_CREATE,
				'DATE_CREATE' => $this->DATE_CREATE,
				'USER_UPDATE' => $this->USER_UPDATE,
				'DATE_UPDATE' => $this->DATE_UPDATE,
				'VERIFIED' => $this->VERIFIED
			]);
			
			return true;
		}
		catch(PDOException $ex)
		{
			error_log('USERS::UpdateItem->PDOException: ' . $ex);
			return false;
		}
	}

    public function From($data) 
	{
		$this->ID = $data['ID'];
		$this->USERNAME = $data['USERNAME'];
		$this->PASSWORD = $data['PASSWORD'];
		$this->ROLE = $data['ROLE'];
		$this->PHOTO = $data['PHOTO'];
		$this->ADDRESS = $data['ADDRESS'];
		$this->PHONE = $data['PHONE'];
		$this->FIRST_NAME = $data['FIRST_NAME'];
		$this->SECOND_NAME = $data['SECOND_NAME'];
		$this->FIRST_LASTNAME = $data['FIRST_LASTNAME'];
		$this->SECOND_LASTNAME = $data['SECOND_LASTNAME'];
		$this->IDENTIFICATION = $data['IDENTIFICATION'];
		$this->IDENTIFICATION_PHOTO = $data['IDENTIFICATION_PHOTO'];
		$this->USER_CREATE = $data['USER_CREATE'];
		$this->DATE_CREATE = $data['DATE_CREATE'];
		$this->USER_UPDATE = $data['USER_UPDATE'];
		$this->DATE_UPDATE = $data['DATE_UPDATE'];
		$this->setVERIFIED($data['VERIFIED']);
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