<?php

namespace Modules\Page\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Page\App\Models\CustomPageTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Page\Database\factories\CustomPageFactory;

class CustomPage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $hidden = ['front_translate'];

    protected $appends = ['page_name', 'description'];

    public function translate(){
        return $this->belongsTo(CustomPageTranslation::class, 'id', 'custom_page_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(CustomPageTranslation::class, 'id', 'custom_page_id')->where('lang_code', front_lang());
    }

    public function getPageNameAttribute(){
        if($this->front_translate && $this->front_translate->page_name){
            return $this->front_translate->page_name;
        }elseif($this->translate && $this->translate->page_name){
            return $this->translate->page_name;
        }else{
            return 'Sin nombre de página';
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


}
