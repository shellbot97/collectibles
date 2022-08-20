<?php

set_error_handler(array(&$this, 'exceptions_error_handler'));



public function exceptions_error_handler($severity, $message, $filename, $lineno) {
			if (error_reporting() == 0) {
				return;
			}
			if (error_reporting() & $severity) {
				throw new ErrorException($message, 0, $severity, $filename, $lineno);
			}
		}
