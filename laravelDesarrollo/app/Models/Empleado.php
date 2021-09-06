<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';

    protected $fillable = ['id_empleado','codigo','nombres','apellidos','direccion','telefono','fecha_nacimiento','id_puesto'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function puesto()
    {
        return $this->hasOne('App\Models\Puesto', 'id_puesto', 'id_puesto');
    }
    
}
