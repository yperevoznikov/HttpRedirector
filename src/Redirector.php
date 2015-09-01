<?php

	namespace YPRedirector;

	class Redirector {

		public static function create(){
			return new Redirector(new Environment($_SERVER));
		}

		public function __construct(Environment $env){
			$this->env = $env;
		}

		public function requireNoWww() {
			$httpHost = $this->env->getHost();
			if (substr_count($httpHost, '.') > 1) {

				$httpHost = implode('.', array_slice(explode('.', $httpHost), 1));
				$uri = $this->env->getUri();

				$this->env->setHeader("HTTP/1.1 301 Moved Permanently");

				$redirectHeader = "Location: http://" . $httpHost . $uri;
				$this->env->setHeader($redirectHeader);

				$this->env->finishOutput();

			}
		}

		public function denyHost() {
			$this->env->setHeader("HTTP/1.0 404 Not Found");
			$this->env->finishOutput();
		}

	}