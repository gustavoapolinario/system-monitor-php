<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseDynamicConnectionModel extends Model {

    public function __construct(array $attributes = array(), $dbconn_attributes)
    {
        parent::__construct($attributes);

        // Set the database connection name.
        $this->setDynamicConnection($dbconn_attributes);
        $this->setConnection($dbconn_attributes["host"]);
    }

	/**
	* Configures a tenant's database connection.

	* @param  array $attributes 
	* @return void
	*/
	function setDynamicConnection(array $attributes)
	{
		// Just get access to the config. 
		$config = App::make('config');

		$connections = $config->get('database.connections.'.$dbconn_attributes["host"]);

		die($connections);
		if( is_null($connections) || empty($connections) ) {
			// Will contain the array of connections that appear in our database config file.
			$connections = $config->get('database.connections');

			// This line pulls out the default connection by key (by default it's `mysql`)
			$defaultConnection = $connections[$config->get('database.default')];

			// Now we simply copy the default connection information to our new connection.
			$newConnection = $defaultConnection;

			// Override default settings
			$newConnection['host'] = $dbconn_attributes["host"];
			$newConnection['port'] = $dbconn_attributes["port"];
			$newConnection['database'] = $dbconn_attributes["database"];
			$newConnection['username'] = $dbconn_attributes["username"];
			$newConnection['password'] = $dbconn_attributes["password"];
			$newConnection['charset'] = $dbconn_attributes["charset"];

			// This will add our new connection to the run-time configuration for the duration of the request.
			App::make('config')->set('database.connections.'.$dbconn_attributes["host"], $newConnection);
		}

	}

}