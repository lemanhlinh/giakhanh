<?php

namespace App\Repositories\Contracts;

interface SettingInterface extends BaseInterface
{
    public function saveFileUpload($file, $type);
}
