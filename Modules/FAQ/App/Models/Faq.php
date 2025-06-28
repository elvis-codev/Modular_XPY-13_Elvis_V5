<?php

namespace Modules\FAQ\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\FAQ\App\Models\FaqTranslation;
use Modules\FAQ\Database\factories\FaqFactory;

class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): FaqFactory{}

    protected $hidden = ['front_translate'];

    protected $appends = ['question', 'answer'];

    public function translate(){
        return $this->belongsTo(FaqTranslation::class, 'id', 'faq_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(FaqTranslation::class, 'id', 'faq_id')->where('lang_code', front_lang());
    }

    public function getQuestionAttribute(){
        if($this->front_translate && $this->front_translate->question){
            return $this->front_translate->question;
        }elseif($this->translate && $this->translate->question){
            return $this->translate->question;
        }else{
            return 'Sin pregunta';
        }
    }

    public function getAnswerAttribute(){
        if($this->front_translate && $this->front_translate->answer){
            return $this->front_translate->answer;
        }elseif($this->translate && $this->translate->answer){
            return $this->translate->answer;
        }else{
            return 'Sin respuesta';
        }
    }


}
