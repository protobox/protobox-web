<?php namespace Protobox\Builder\Sections;

class Datastore extends Section {

	public function drivers()
	{
		return [
			'mysql' => 'MySQL',
			'mariadb' => 'MariaDB',
			'postgresql' => 'PostgreSQL',
			'mongodb' => 'MongoDB',
			'redis' => 'Redis',
			'riak' => 'Riak'
		];
	}

	public function defaults()
	{
		return [

			//
			// Mysql
			//
			
			'mysql_install' => 1,
			'mysql_root_password' => 'root',
			'mysql_databases' => [
				[
					'name' => 'app',
					'host' => 'localhost',
					'user' => 'user',
					'password' => 'user',
					'grant' => ['All'],
					'sql_file' => ''
				]
			]

		];
	}

	public function rules()
	{
		$mysql = $this->builder->request()->get('mysql');
		$mariadb = $this->builder->request()->get('mariadb');
		$rules = [];

		if (isset($mysql['install']) && (int) $mysql['install'] == 1 && isset($mysql['databases']))
		{
			foreach($mysql['databases'] as $dbid => $db)
			{
				$rules += [
					'mysql.databases.'.$dbid.'.name' => 'required',
					'mysql.databases.'.$dbid.'.host' => 'required',
					'mysql.databases.'.$dbid.'.user' => 'required',
					'mysql.databases.'.$dbid.'.password' => 'required'
				];
			}
		}

		return $rules;
	}

	public function fields()
	{
		$mysql = $this->builder->request()->get('mysql');
		$fields = [
			'mysql.install' => 'Data Store: MySQL Installation',
			'mysql.root_password' => 'Data Store: MySQL Root Password',
		];

		if (isset($mysql['databases']))
		{
			foreach($mysql['databases'] as $dbid => $db)
			{
				$fields += [
					'mysql.databases.'.$dbid.'.name' => 'Data Store: MySQL Database #'.($dbid+1).' Name',
					'mysql.databases.'.$dbid.'.host' => 'Data Store: MySQL Database #'.($dbid+1).' Host',
					'mysql.databases.'.$dbid.'.user' => 'Data Store: MySQL Database #'.($dbid+1).' User',
					'mysql.databases.'.$dbid.'.password' => 'Data Store: MySQL Database #'.($dbid+1).' Password'
				];
			}
		}

		return $fields;
	}

	public function valid()
	{
		$mysql = $this->builder->request()->get('mysql');
		$mariadb = $this->builder->request()->get('mariadb');

		// Check to see if mysql and mariadb is installed
		if (
			isset($mysql['install']) && 
			isset($mariadb['install']) && 
			(int) $mysql['install'] == 1 && 
			(int) $mariadb['install'] == 1
		)
		{
			$this->setError('Data Store: Please choose either mysql or mariadb for your database, not both.');

			return false;
		}

		return true;
	}

	public function load($output)
	{
		$mysql_databases = [];
		if (isset($output['mysql']['databases']))
		{
			foreach ($output['mysql']['databases'] as $db)
			{
				$mysql_databases[] = [
					'name' => isset($db['name']) ? $db['name'] : '',
					'host' => isset($db['host']) ? $db['host'] : '',
					'user' => isset($db['user']) ? $db['user'] : '',
					'password' => isset($db['password']) ? $db['password'] : '',
					'grant' => isset($db['grant']) ? $db['grant'] : [],
					'sql_file' => isset($vhost['sql_file']) ? $vhost['sql_file'] : '',
				];
			}
		}

		return [
			'mysql' => [
				'install' => isset($output['mysql']['install']) ? (int) $output['mysql']['install'] : 0,
				'root_password' => isset($output['mysql']['root_password']) ? $output['mysql']['root_password'] : '',
				'databases' => $mysql_databases,
			],

			'mariadb' => [
				'install' => isset($output['mariadb']['install']) ? (int) $output['mariadb']['install'] : 0,
				'repository' => isset($output['mariadb']['repository']) ? $output['mariadb']['repository'] : '',
			]
		];
	}

	public function output()
	{
		$mysql = $this->builder->request()->get('mysql');
		$mariadb = $this->builder->request()->get('mariadb');

		$mysql_databases = [
			[
				'name' => 'app',
				'host' => 'localhost',
				'user' => 'user',
				'password' => 'user',
				'grant' => ['All'],
				'sql_file' => ''
			]
		];

		foreach($mysql['databases'] as $db)
		{
			$mysql_databases[] = [
				'name' => isset($db['name']) ? $db['name'] : '',
				'host' => isset($db['host']) ? $db['host'] : '',
				'user' => isset($db['user']) ? $db['user'] : '',
				'password' => isset($db['password']) ? $db['password'] : '',
				'grant' => isset($db['grant']) && count($db['grant']) ? $db['grant'] : '[]',
				'sql_file' => isset($db['sql_file']) ? $db['sql_file'] : '',
			];
		}

		return [
			'mysql' => [
				'install' => isset($mysql['install']) ? (int) $mysql['install'] : 0,
				'root_password' => isset($mysql['mysql']['root_password']) ? $mysql['root_password'] : '',
				'databases' => $mysql_databases,
			],

			'mariadb' => [
				'install' => isset($mariadb['install']) ? (int) $mariadb['install'] : 0,
			]
		];
	}


}