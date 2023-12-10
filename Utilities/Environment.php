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
                return 'dev.pitstopfoods.com/wp-content/themes/recipes/functions/';
            case 'production':
                return 'pitstopfoods.com/wp-content/themes/recipes/functions/';
        }
    }

    public function get() 
    {
        return $this->checkEnvironments($this->env);
    }

}