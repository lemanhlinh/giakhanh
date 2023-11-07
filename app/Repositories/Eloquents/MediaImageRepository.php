<?php

namespace App\Repositories\Eloquents;

use App\Models\Media;
use App\Repositories\Contracts\MediaImageInterface;

class MediaImageRepository extends BaseRepository implements MediaImageInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Media';
    }
}
