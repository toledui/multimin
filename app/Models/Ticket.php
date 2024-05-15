<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

     // Relación con el modelo Distributor
     public function distributor()
     {
         return $this->belongsTo(Distribuitor::class);
     }
 
     // Relación con el modelo Vendor
     public function vendor()
     {
         return $this->belongsTo(Vendor::class);
     }
 
     // Relación con el modelo User (si estás utilizando la autenticación de Laravel)
     public function user()
     {
         return $this->belongsTo(User::class);
     }
     public function user2()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

     public function distribuitor()
     {
         return $this->belongsTo(Distribuitor::class, 'distribuitor_id');
     }
 
     public function vendor2()
     {
         return $this->belongsTo(Vendor::class, 'vendor_id');
     }

     public function product()
     {
         return $this->belongsTo(Product::class);
     }
}
