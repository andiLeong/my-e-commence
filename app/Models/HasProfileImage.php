<?php
namespace App\Models;


use Illuminate\Support\Facades\Storage;

trait HasProfileImage
{

    public function getProfileImgAttribute($value)
    {
        return is_null($value)
            ? "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            : Storage::disk('digitalocean')->url($value);
    }

    public function hasProfilePicture()
    {
        return !is_null($this->getRawOriginal('profile_img')) || !empty($this->getRawOriginal('profile_img')) ;
    }
}
