<?php

/**
 * @link 
 * @copyright 
 * @license 
 */

namespace app\components;

use Yii;

class Metadata extends \yii\base\Component {

    /**
     * Get all information about application
     * if modules of your application have controllers with same name, it will raise fatall error
     * 
     */
    public function getAll() {
        $meta = array(
            'models' => $this->getModels(),
            'controllers' => $this->getControllers(),
            'modules' => $this->getModules(),
        );
        foreach ($meta['controllers'] as &$controller) {
            $controller = array(
                'name' => $controller,
                'actions' => $this->getActions($controller)
            );
        }

        foreach ($meta['modules'] as &$module) {

            $controllers = $this->getControllers($module);

            foreach ($controllers as &$controller) {
                $controller = array(
                    'name' => $controller,
                    'actions' => $this->getActions($controller, $module)
                );
            }


            $module = array(
                'name' => $module,
                'controllers' => $controllers,
                'models' => $this->getModels($module),
            );
        }

        return $meta;
    }

    /**
     * Get actions of controller
     * 
     * @param mixed $controller
     * @param mixed $module
     * @return mixed
     */
    public function getActions($controller, $module = null) {
        if ($module != null) {
            $path = join(DIRECTORY_SEPARATOR, array(Yii::getAlias('@modulePath'), $module, 'controllers'));
            $reflectionPath = "\app\modules\\" . $module . "\controllers\\" . $controller;
            $this->setModuleIncludePaths($module);
        } else {
            $path = Yii::$app->getControllerPath();
            $reflectionPath = "\app\controllers\\" . $controller;
        }
        include_once($path . DIRECTORY_SEPARATOR . $controller . '.php');
        $reflection = new \ReflectionClass($reflectionPath);
        $methods = $reflection->getMethods();

        //$cInstance=new $controller(null);
        // var_dump($cInstance->actions());
        $actions = array();
        foreach ($methods as $method) {
            if (strpos($method->name, 'action') === 0 and ctype_upper($method->name[6])) {
                $actions[] = str_replace('action', '', $method->name);
            }
        }
        return $actions;
    }

    /**
     * Set php include paths for module
     * 
     * @param mixed $module
     */
    private function setModuleIncludePaths($module) {
        set_include_path(join(PATH_SEPARATOR, array(
            get_include_path(),
            //join(DIRECTORY_SEPARATOR,array(Yii::getAlias('@modulePath'),$module,'controllers')),
            join(DIRECTORY_SEPARATOR, array(Yii::getAlias('@modulePath'), $module, 'components')),
            join(DIRECTORY_SEPARATOR, array(Yii::getAlias('@modulePath'), $module, 'models')),
            join(DIRECTORY_SEPARATOR, array(Yii::getAlias('@modulePath'), $module, 'vendors')),
        )));
    }

    /**
     * Get list of controllers with actions
     * 
     * @param mixed $module
     * @return array
     */
    function getControllersActions($module = null) {
        $c = $this->getControllers($module);
        foreach ($c as &$controller) {
            $controller = array(
                'name' => $controller,
                'actions' => $this->getActions($controller, $module)
            );
        }
        return $c;
    }

    /**
     * Scans controller directory & return array of MVC controllers
     * 
     * @param mixed $module
     * @param mixed $include_classes
     * @return array
     */
    public function getControllers($module = null) {
        if ($module != null) {
            $path = join(DIRECTORY_SEPARATOR, array(Yii::getAlias('@modulePath'), $module, 'controllers'));
        } else {
            $path = Yii::$app->getControllerPath();
        }
        try {
            $controllers = array_filter(scandir($path), array($this, 'isController'));
            foreach ($controllers as &$c) {
                $c = str_ireplace(['.php', '~'], '', $c);
            }
            return array_unique($controllers);
        } catch (yii\db\Exception $ex) {
            
        }
    }

    /**
     * Scans models directory & return array of MVC models
     * 
     * @param mixed $module
     * @param mixed $include_classes
     * @return array
     */
    public function getModels($module = null, $include_classes = false) {
        if ($module != null) {
            $path = join(DIRECTORY_SEPARATOR, array(Yii::getAlias('@modulePath'), $module, 'models'));
        } else {
            $path = Yii::getAlias('@modelsPath');
        }

        try {
            $files = scandir($path);
            $models = array();
            foreach ($files as $f) {
                if (stripos($f, '.php') !== false) {
                    $models[] = str_ireplace(['.php', '~'], '', $f);
                    if ($include_classes) {
                        include_once($path . DIRECTORY_SEPARATOR . $f);
                    }
                }
            }
        } catch (yii\db\Exception $ex) {
            
        }
        return $models;
    }

    /**
     * Used in getModules() to filter array of files & directories
     * 
     * @param mixed $a
     */
    private function isController($a) {
        return stripos($a, 'Controller.php') !== false;
    }

    /**
     * Returns array of module names
     * 
     */
    public function getModules() {
        try {
            $modules = scandir(Yii::getAlias('@modulePath'));
            // $modules=array_filter($modules,function($a) {return true;});
            $modules = array_filter($modules, array($this, 'isModule'));
            return $modules;
        } catch (yii\db\Exception $ex) {
            
        }
    }

    /**
     * Used in getModules() to filter array of files & directories
     * 
     * @param mixed $a
     */
    private function isModule($a) {
        return $a != '.' and $a != '..' and is_dir(Yii::getAlias('@modulePath') . DIRECTORY_SEPARATOR . $a);
    }

}
