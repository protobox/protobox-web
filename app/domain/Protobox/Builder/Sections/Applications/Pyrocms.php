<?php namespace Protobox\Builder\Sections\Applications;

class Pyrocms extends Application {

  public function defaults()
  {
    return [

      'pyrocms_name' => 'pyrocms-test',
      'pyrocms_install' => 1,
      'pyrocms_path' => '/vagrant/web/pyrocms',

      'pyrocms_version' => '2.2.3',
      'pyrocms_dbname' => 'pyrocms',

      'pyrocms_firstname' => 'Admin',
      'pyrocms_lastname' => 'Admin',
      'pyrocms_email' => 'admin@admin.com',
      'pyrocms_username' => 'admin',
      'pyrocms_password' => 'admin',

    ];
  }

  public function rules()
  {
    $app = $this->section->getBuilder()->request()->get('applications');

    if ( ! isset($app['pyrocms'])) return [];

    $rules = [];

    foreach((array)$app['pyrocms'] as $id => $dat)
    {
      //if (isset($dat['install']) && (int) $dat['install'] == 1)
      //{
        $rules += [
          'applications.pyrocms.'.$id.'.name' => 'required',
          'applications.pyrocms.'.$id.'.path' => 'required',
          'applications.pyrocms.'.$id.'.version' => 'required',
          'applications.pyrocms.'.$id.'.dbname' => 'required',
          'applications.pyrocms.'.$id.'.firstname' => 'required',
          'applications.pyrocms.'.$id.'.lastname' => 'required',
          'applications.pyrocms.'.$id.'.email' => 'required',
          'applications.pyrocms.'.$id.'.username' => 'required',
          'applications.pyrocms.'.$id.'.password' => 'required',
        ];
      //}
    }

    return $rules;
  }

  public function fields()
  {
    $app = $this->section->getBuilder()->request()->get('applications');

    if ( ! isset($app['pyrocms'])) return [];

    $fields = [];

    foreach((array)$app['pyrocms'] as $id => $dat)
    {
      $fields += [
        'applications.pyrocms.'.$id.'.name' => 'Application: PyroCMS #'.($id+1).' Name',
        'applications.pyrocms.'.$id.'.path' => 'Application: PyroCMS #'.($id+1).' Document Root',
        'applications.pyrocms.'.$id.'.version' => 'Application: PyroCMS #'.($id+1).' Version',
        'applications.pyrocms.'.$id.'.dbname' => 'Application: PyroCMS #'.($id+1).' Database Name',
        'applications.pyrocms.'.$id.'.firstname' => 'Application: PyroCMS #'.($id+1).' Admin First Name',
        'applications.pyrocms.'.$id.'.lastname' => 'Application: PyroCMS #'.($id+1).' Admin Last Name',
        'applications.pyrocms.'.$id.'.email' => 'Application: PyroCMS #'.($id+1).' Admin Email',
        'applications.pyrocms.'.$id.'.username' => 'Application: PyroCMS #'.($id+1).' Admin Username',
        'applications.pyrocms.'.$id.'.password' => 'Application: PyroCMS #'.($id+1).' Admin Password',
      ];
    }

    return $fields;
  }

  public function load($output)
  {
    if ( ! isset($output['applications']['pyrocms'])) return [];

    $app = $output['applications']['pyrocms'];
    $repos = [];

    foreach((array)$app as $id => $dat)
    {
      $repos[] = [
        'name' => isset($dat['name']) ? $dat['name'] : '',
        'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
        'path' => isset($dat['path']) ? $dat['path'] : '',
        'version' => isset($dat['options']['version']) ? $dat['options']['version'] : '',
        'dbname' => isset($dat['options']['dbname']) ? $dat['options']['dbname'] : '',
        'firstname' => isset($dat['options']['user_firstname']) ? $dat['options']['user_firstname'] : '',
        'lastname' => isset($dat['options']['user_lastname']) ? $dat['options']['user_lastname'] : '',
        'email' => isset($dat['options']['user_email']) ? $dat['options']['user_email'] : '',
        'username' => isset($dat['options']['user_name']) ? $dat['options']['user_name'] : '',
        'password' => isset($dat['options']['user_password']) ? $dat['options']['user_password'] : '',
      ];
    }

    return [
      'pyrocms' => $repos
    ];
  }

  public function output()
  {
    $app = $this->section->getBuilder()->request()->get('applications');

    if ( ! isset($app['pyrocms'])) return [];

    $repos = [];

    foreach((array)$app['pyrocms'] as $id => $dat)
    {
      $repos[] = [
        'name' => isset($dat['name']) ? $dat['name'] : '',
        'install' => isset($dat['install']) ? (int) $dat['install'] : 0,
        'path' => isset($dat['path']) ? $dat['path'] : '',
        'options' => [
          'version' => isset($dat['version']) ? $dat['version'] : '',
          'dbhost' => 'localhost',
          'dbname' => isset($dat['dbname']) ? $dat['dbname'] : '',
          'dbuser' => 'root',
          'dbpass' => 'root',
          'user_firstname' => isset($dat['firstname']) ? $dat['firstname'] : '',
          'user_lastname' => isset($dat['lastname']) ? $dat['lastname'] : '',
          'user_email' => isset($dat['email']) ? $dat['email'] : '',
          'user_name' => isset($dat['username']) ? $dat['username'] : '',
          'user_password' => isset($dat['password']) ? $dat['password'] : '',
        ]
      ];
    }

    return [
      'pyrocms' => $repos
    ];
  }

}
