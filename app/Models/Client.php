<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    /*coloco el nombre de la tabla y su id que es el que voy a referenciar */
    protected $table = 'clients';
    protected $primaryKey = 'client_id';
    public $timestamps = false;
    protected $fillable = ['name', 'last_name', 'customer_email', 'address', 'dpi'];
}
