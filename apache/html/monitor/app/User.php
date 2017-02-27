<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'company_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Get the user that owns the phone.
	 */
	public function company()
	{
		return $this->belongsTo('App\Company');
	}





	/********* ROLES *********/

	/**
	 * Get the roles a user has
	 */
	public function roles()
	{
		return $this->belongsToMany('App\Role', 'users_roles');
	}

	 /**
	 * Find out if user has a specific role
	 *
	 * $return boolean
	 */
	public function hasRole($check)
	{
		return in_array($check, array_pluck($this->roles()->get()->toArray(), 'name'));
	}

	/**
	 * Get key in array with corresponding value
	 *
	 * @return int
	 */
	private function getIdInArray($array, $term)
	{
		foreach ($array as $key => $value) {
			if ($value == $term) {
				return $key;
			}
		}

		throw new UnexpectedValueException;
	}

	/**
	 * Add roles to user to make them a concierge
	 */
	public function makeRoles($title)
	{
		$assigned_roles = array();

		$roles = array_fetch(Role::all()->toArray(), 'name');

		switch ($title) {
			case 'monitor_admin':
				$assigned_roles[] = $this->getIdInArray($roles, 'manage_admins');
				$assigned_roles[] = $this->getIdInArray($roles, 'manage_companys');
			case 'company_admin':
				$assigned_roles[] = $this->getIdInArray($roles, 'manage_users');
			case 'viewer':
				$assigned_roles[] = $this->getIdInArray($roles, 'view_reports');
				break;
			default:
				throw new \Exception("The employee status entered does not exist");
		}

		$this->roles()->attach($assigned_roles);
	}

	
}
