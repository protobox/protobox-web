<?php namespace Protobox\User;

use Hashids;
use Protobox\Core\EloquentBaseModel;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends EloquentBaseModel implements UserInterface, RemindableInterface {

    protected $table      = 'users';
    protected $fillable   = ['name', 'email', 'active', 'password'];
    protected $hidden     = ['password'];

    public function posts()
    {
        return $this->hasMany('Protobox\Builder\Box');
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function publicID()
    {
        return Hashids::encrypt($this->id);
    }

}