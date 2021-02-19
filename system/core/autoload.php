<?php

    /**
     *
     * autoloader function
     *
     * Loads all core classes from system/core dir.
     *
     * @param string $class Class name.
     *
     * @return void
     *
     */
    function autoloader($class)
    {
        require_once "system/core/".$class.".php";
    }

    spl_autoload_register("autoloader");
