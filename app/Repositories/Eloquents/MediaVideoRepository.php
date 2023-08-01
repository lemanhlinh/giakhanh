<?php

namespace App\Repositories\Eloquents;

use App\Models\Media;
use App\Repositories\Contracts\MediaVideoInterface;

class MediaVideoRepository extends BaseRepository implements MediaVideoInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Media';
    }
}
