<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //

    /**
     * 用户的文章列表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    /**
     * 关注我的Fan模型
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fans()
    {
        return $this->hasMany(Fan::class, 'star_id', 'id');
    }

    /**
     * 我关注的Fan模型
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stars()
    {
        return $this->hasMany(Fan::class, 'fan_id', 'id');
    }

    /**
     * 关注某人
     * @param $uid
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function doFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    /**
     * 取消关注
     * @param $uid
     * @return mixed
     */
    public function doUnfan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    /**
     * 当前用户是否被uid关注了
     * @param $uid
     * @return int
     */
    public function hanFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    /**当前用户是否关注了uid
     * @param $uid
     * @return int
     */
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }
}