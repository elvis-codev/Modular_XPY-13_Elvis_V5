<?php

namespace Modules\Testimonial\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Testimonial\App\Models\TestimonialTrasnlation;
use Modules\Testimonial\Database\factories\TestimonialFactory;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): TestimonialFactory{}

    public function translate(){
        return $this->belongsTo(TestimonialTrasnlation::class, 'id', 'testimonial_id')->where('lang_code' , admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(TestimonialTrasnlation::class, 'id', 'testimonial_id')->where('lang_code' , front_lang());
    }

    protected $hidden = ['front_translate'];

    protected $appends = ['name', 'designation', 'comment'];

    public function getNameAttribute(){
        if($this->front_translate && $this->front_translate->name){
            return $this->front_translate->name;
        }elseif($this->translate && $this->translate->name){
            return $this->translate->name;
        }else{
            return 'Sin nombre';
        }
    }

    public function getCommentAttribute(){
        if($this->front_translate && $this->front_translate->comment){
            return $this->front_translate->comment;
        }elseif($this->translate && $this->translate->comment){
            return $this->translate->comment;
        }else{
            return 'Sin comentario';
        }
    }

    public function getDesignationAttribute(){
        if($this->front_translate && $this->front_translate->designation){
            return $this->front_translate->designation;
        }elseif($this->translate && $this->translate->designation){
            return $this->translate->designation;
        }else{
            return 'Sin cargo';
        }
    }
    
}
