<?php
namespace App\Builder;

use Illuminate\Database\Eloquent\Model;

Class WalletBuilder extends Model {
    
    public function active(){
        return $this->where('active', 1);
    }
    
}

?>