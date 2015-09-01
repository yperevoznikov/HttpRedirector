<?php

	namespace YPRedirector;

	class Environment {

		/**
		 * @var array
		 */
		private $server;

		public function __construct(array $server){

			if (!isset($server['HTTP_HOST'])) {
				throw new Exception('No `HTTP_HOST` defined in $server parameter');
			}

			$this->server = $server;
		}

		public function getHost(){
			return $this->server['HTTP_HOST'];
		}

		public function getUri(){
			return isset($this->server['REQUEST_URI']) ? $this->server['REQUEST_URI'] : '';
		}

		public function setHeader($header){
			header($header);
		}

		public function finishOutput(){
			exit();
		}

	}