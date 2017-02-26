<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseDynamicConnectionModel extends Model {

	/**
	* Configures a tenant's database connection.

	* @param  ServerInfo $serverInfo 
	* @return void
	*/
	function setDynamicConnection(ServerInfo $serverInfo)
	{
		// Just get access to the config. 
		$config = \App::make('config');

		$connections = $config->get('database.connections.'.$serverInfo->host);

		if( is_null($connections) || empty($connections) ) {
			// Will contain the array of connections that appear in our database config file.
			$connections = $config->get('database.connections');

			// This line pulls out the default connection by key (by default it's `mysql`)
			$defaultConnection = $connections[$config->get('database.default')];

			// Now we simply copy the default connection information to our new connection.
			$newConnection = $defaultConnection;

			// Override default settings
			$newConnection['host'] = $serverInfo->host;
			if( $newConnection['port'] ) {
				$newConnection['port'] = $serverInfo->port;
			}
			if( $newConnection['database'] ) {
				$newConnection['database'] = $serverInfo->database;
			}
			$newConnection['username'] = $serverInfo->username;
			$newConnection['password'] = $serverInfo->password;
			if( $newConnection['charset'] ) {
				$newConnection['charset'] = $serverInfo->charset;
			}

			// This will add our new connection to the run-time configuration for the duration of the request.
			\App::make('config')->set('database.connections.'.$serverInfo->host, $newConnection);
		}


        $this->setConnection($serverInfo->host);

	}

}