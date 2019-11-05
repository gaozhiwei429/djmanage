<?php

namespace appcomponents\modules\admin;
use source\manager\BaseService;
class AdminService extends BaseService {
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'appcomponents\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
