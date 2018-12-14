<?php

namespace App\Transformers\Backend;

use App\Models\Banner;
use League\Fractal\TransformerAbstract;

class BannerTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['type'];

    public function transform(Banner $banner)
    {
        return [
            'id' => $banner->id,
            'url' => $banner->url,
            'title' => $banner->title,
            'image' => $banner->image,
            'image_url' => image_url($banner->image),
            'is_visible' => $banner->is_visible,
            'type_name' => $banner->type_name,
            'enabled_at' => is_null($banner->enabled_at) ? null : $banner->enabled_at->toDateTimeString(),
            'expired_at' => is_null($banner->expired_at) ? null : $banner->expired_at->toDateTimeString(),
            'created_at' => $banner->created_at->toDateTimeString(),
            'updated_at' => $banner->updated_at->toDateTimeString()
        ];
    }

    public function includeType(Banner $banner)
    {
        $type = $banner->type;
        return $this->item($type, new TypeTransformer());
    }
}
