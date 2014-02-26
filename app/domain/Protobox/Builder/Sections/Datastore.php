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
			],

			//
			// Mariadb
			//
			
			'mariadb_install' => 0,
			'mariadb_versions' => ['5.5', '10.0'],
			'mariadb_root_password' => 'root',
			'mariadb_databases' => [
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
		$rules = [];
		$mysql = $this->builder->request()->get('mysql');
		$mariadb = $this->builder->request()->get('mariadb');

		// Mysql

		if (isset($mysql['install']) && (int) $mysql['install'] == 1)
		{
			$rules += [
				'mysql.root_password' => 'required'
			];

			if (isset($mysql['databases']))
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
		}

		// Mariadb

		if (isset($mariadb['install']) && (int) $mariadb['install'] == 1)
		{
			$rules += [
				'mariadb.root_password' => 'required'
			];

			if (isset($mariadb['databases']))
			{
				foreach($mariadb['databases'] as $dbid => $db)
				{
					$rules += [
						'mariadb.databases.'.$dbid.'.name' => 'required',
						'mariadb.databases.'.$dbid.'.host' => 'required',
						'mariadb.databases.'.$dbid.'.user' => 'required',
						'mariadb.databases.'.$dbid.'.password' => 'required'
					];
				}
			}
		}

		return $rules;
	}

	public function fields()
	{
		$fields = [];
		$mysql = $this->builder->request()->get('mysql');
		$mariadb = $this->builder->request()->get('mariadb');

		// Mysql

		$fields += [
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

		// Mariadb

		$fields += [
			'mariadb.install' => 'Data Store: MariaDB Installation',
			'mariadb.root_password' => 'Data Store: MariaDB Root Password',
		];

		if (isset($mariadb['databases']))
		{
			foreach($mariadb['databases'] as $dbid => $db)
			{
				$fields += [
					'mariadb.databases.'.$dbid.'.name' => 'Data Store: MariaDB Database #'.($dbid+1).' Name',
					'mariadb.databases.'.$dbid.'.host' => 'Data Store: MariaDB Database #'.($dbid+1).' Host',
					'mariadb.databases.'.$dbid.'.user' => 'Data Store: MariaDB Database #'.($dbid+1).' User',
					'mariadb.databases.'.$dbid.'.password' => 'Data Store: MariaDB Database #'.($dbid+1).' Password'
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

		// Check for unique database names
		if (isset($mysql['databases']))
		{
			$mysql_unique_names = [];

			foreach($mysql['databases'] as $dbid => $db)
			{
				$name = isset($db['name']) ? $db['name'] : 'noname';

				if (isset($mysql_unique_names[$name]))
				{
					$this->setError('Data Store: Make sure the MySQL database names are unique for each one.');

					return false;
				}

				$mysql_unique_names[$name] = true;
			}
		}

		// Check for unique database names
		if (isset($mariadb['databases']))
		{
			$mariadb_unique_names = [];

			foreach($mariadb['databases'] as $dbid => $db)
			{
				$name = isset($db['name']) ? $db['name'] : 'noname';

				if (isset($mariadb_unique_names[$name]))
				{
					$this->setError('Data Store: Make sure the MariaDB database names are unique for each one.');

					return false;
				}

				$mariadb_unique_names[$name] = true;
			}
		}

		return true;
	}

	public function load($output)
	{
		$mysql_databases = [];

		if (isset($output['mysql']['databases']))
		{
			foreach ($output['mysql']['databases'] as $dbid => $db)
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

		$mariadb_databases = [];

		if (isset($output['mariadb']['databases']))
		{
			foreach ($output['mariadb']['databases'] as $dbid => $db)
			{
				$mariadb_databases[] = [
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
				'version' => isset($output['mariadb']['version']) ? $output['mariadb']['version'] : '',
				'databases' => $mariadb_databases,
			]
		];
	}

	public function output($options = [])
	{
		$mysql = $this->builder->request()->get('mysql');
		$mariadb = $this->builder->request()->get('mariadb');

		$mysql_databases = [];

		if (isset($mysql['databases']))
		{
			foreach($mysql['databases'] as $dbid => $db)
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
		}

		$mariadb_databases = [];

		if (isset($mariadb['databases']))
		{
			foreach($mariadb['databases'] as $dbid => $db)
			{
				$mariadb_databases[] = [
					'name' => isset($db['name']) ? $db['name'] : '',
					'host' => isset($db['host']) ? $db['host'] : '',
					'user' => isset($db['user']) ? $db['user'] : '',
					'password' => isset($db['password']) ? $db['password'] : '',
					'grant' => isset($db['grant']) && count($db['grant']) ? $db['grant'] : '[]',
					'sql_file' => isset($db['sql_file']) ? $db['sql_file'] : '',
				];
			}
		}

		return [
			'mysql' => [
				'install' => isset($mysql['install']) ? (int) $mysql['install'] : 0,
				'root_password' => isset($mysql['root_password']) ? $mysql['root_password'] : '',
				'databases' => count($mysql_databases) ? $mysql_databases : '[]',
			],

			'mariadb' => [
				'install' => isset($mariadb['install']) ? (int) $mariadb['install'] : 0,
				'version' => isset($mariadb['version']) ? $mariadb['version'] : '',
				'root_password' => isset($mariadb['root_password']) ? $mariadb['root_password'] : '',
				'databases' => count($mariadb_databases) ? $mariadb_databases : '[]',
			]
		];
	}


}