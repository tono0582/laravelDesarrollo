<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'puestos';
    protected $primaryKey = 'id_puesto';

    protected $fillable = ['id_puesto','puesto'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado', 'id_puesto', 'id_puesto');
    }
    
}
