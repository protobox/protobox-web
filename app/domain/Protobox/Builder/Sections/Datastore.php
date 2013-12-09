<?php namespace Protobox\Builder\Sections;

class Datastore extends Section {

	public function drivers()
	{
		return [
			'mysql' => 'MySQL',
			'postgresql' => 'PostgreSQL',
			'mariadb' => 'MariaDB',
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

}