<?php

namespace App\Repositories\Eloquents;

use App\Models\Setting;
use App\Repositories\Contracts\SettingInterface;

class SettingRepository extends BaseRepository implements SettingInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Setting';
    }

    public function saveFileUpload($file, $type)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '-' . rand(1, 999) . '.' . $extension;
        $file->storeAs('public/setting/' . $type . '/', $fileName);

        return '/storage/setting/' . $type . '/' . $fileName;
    }
}
