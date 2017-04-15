<?php

namespace App;


class MyLog{

	public static function persist($file, $log_type, $txt) {
		$file = storage_path('logs/' . $file . '-' . $log_type . '.log');
        file_put_contents($file, $txt, FILE_APPEND);
	}
	
}
