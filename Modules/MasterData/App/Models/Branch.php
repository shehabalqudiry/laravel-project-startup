<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Modules\MasterData\Branch\App\Filters\BranchFilter;

class Branch extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia ;

    /**
     * The attributes that are mass assignable.
     */




    protected $guarded  = ['id'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json'
    ];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {

            if (auth()->check()) {
                $employee = auth()->user()->employee??null;
                if($employee && $employee->branches_accessibility != 1){
                    $query->where('id', $employee->branch_id);
                }else{

                }
            } else {
                // Define default behavior if user is not authenticated
            }

        });
    }



    public function scopeAccessibleByUser($query, $user)
    {
        // Implement logic to filter branches accessible by the user
        if (auth()->check()) {
            $employee = auth()->user()->employee??null;
            if($employee && $employee->branches_accessibility != 1){
                $query->where('id', $employee->branch_id);
            }else{

            }
        } else {
            // Define default behavior if user is not authenticated
        }
    }

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }


    public function area()
    {
        return $this->belongsTo(\Modules\MasterData\App\Models\Area::class, 'area_id', 'id');
    }
}
