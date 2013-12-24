<?php namespace Protobox\Builder\Sections\Applications;

class Drupal extends Application {

	public function defaults()
	{
		return [

			'drupal_name' => 'drupal-test',
			'drupal_install' => 1,
			'drupal_path' => '/srv/www/web/drupal',
			'drupal_version' => '7.0',
			'drupal_dbname' => 'drupal',
			'drupal_user_email' => 'admin@admin.com',
			'drupal_user_name' => 'admin',
			'drupal_user_pass' => 'admin',
			'drupal_modules' => [
				'ctools',
				'wysiwyg'
			]

		];
	}

}