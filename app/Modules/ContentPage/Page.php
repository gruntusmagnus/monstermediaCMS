<?php

namespace App\Modules\ContentPage\Page;

use App\Employee;
use Illuminate\Database\Eloquent\Model;
use MonsterMedia\LoggableModels\Traits\Archivable;

class Page extends Model
{
    use Archivable;
    protected $table = 'page';
    protected $fillable = ['employee_id'];

    public function author()
    {
        return $this->belongsTo(Employee::class);
    }
}