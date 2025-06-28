<?php

namespace Modules\Blog\App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\App\Models\BlogCategory;
use Modules\Blog\App\Models\BlogComment;
use Modules\Blog\App\Models\BlogTranslation;
use Modules\Blog\Database\factories\BlogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $hidden = ['front_translate'];

    protected $appends = ['title', 'description', 'seo_title', 'seo_description', 'total_comment', 'short_description'];

    protected static function newFactory(): BlogFactory{}

    public function author(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id')->select('id', 'name', 'image', 'about_me');
    }

    public function category(){
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function translate(){
        return $this->belongsTo(BlogTranslation::class, 'id', 'blog_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(BlogTranslation::class, 'id', 'blog_id')->where('lang_code', front_lang());
    }

    public function comments(){
        return $this->hasMany(BlogComment::class)->where('status', 1);
    }

    public function getTotalCommentAttribute(){
        return $this->comments->count();
    }

    public function getTitleAttribute(){
        if($this->front_translate && $this->front_translate->title){
            return $this->front_translate->title;
        }elseif($this->translate && $this->translate->title){
            return $this->translate->title;
        }else{
            return 'Sin título';
        }
    }

    public function getDescriptionAttribute(){
        if($this->front_translate && $this->front_translate->description){
            return $this->front_translate->description;
        }elseif($this->translate && $this->translate->description){
            return $this->translate->description;
        }else{
            return 'Sin descripción';
        }
    }

    public function getShortDescriptionAttribute(){
        if($this->front_translate && $this->front_translate->short_description){
            return $this->front_translate->short_description;
        }elseif($this->translate && $this->translate->short_description){
            return $this->translate->short_description;
        }else{
            return 'Sin descripción corta';
        }
    }

    public function getSeoTitleAttribute(){
        if($this->front_translate && $this->front_translate->seo_title){
            return $this->front_translate->seo_title;
        }elseif($this->translate && $this->translate->seo_title){
            return $this->translate->seo_title;
        }else{
            return null;
        }
    }

    public function getSeoDescriptionAttribute(){
        if($this->front_translate && $this->front_translate->seo_description){
            return $this->front_translate->seo_description;
        }elseif($this->translate && $this->translate->seo_description){
            return $this->translate->seo_description;
        }else{
            return null;
        }
    }







}
