<?php

namespace Modules\Page\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Page\App\Models\FooterTranslation;
use Modules\Page\Database\factories\FooterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): FooterFactory{}

    protected $hidden = ['front_translate'];

    protected $appends = ['about_us'];

    public function translate(){
        return $this->belongsTo(FooterTranslation::class, 'id', 'footer_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(FooterTranslation::class, 'id', 'footer_id')->where('lang_code', front_lang());
    }

    public function getAboutUsAttribute(){
        if($this->front_translate && $this->front_translate->about_us){
            return $this->front_translate->about_us;
        }elseif($this->translate && $this->translate->about_us){
            return $this->translate->about_us;
        }else{
            return 'Sin información';
        }
    }
}
