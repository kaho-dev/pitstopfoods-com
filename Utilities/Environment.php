<?php 

declare(strict_types=1);

namespace Recipes\Utilities;

class Environment
{
    protected $env;

    public function __construct($env)
    {
        $this->env = $env;
    }

    private function checkEnvironments($environment) 
    {
        switch($environment) {

            case 'local':
                return 'D:\wordpress\htdocs\pitstopfoods\wp-content\themes\recipes\functions\\';
            case 'development':
                return get_stylesheet_directory() . '/functions/';
            case 'production':
                return get_stylesheet_directory() . '/functions/';
        }
    }

    public function get() 
    {
        return $this->checkEnvironments($this->env);
    }

}