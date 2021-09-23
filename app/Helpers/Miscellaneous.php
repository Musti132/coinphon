<?php
namespace App\Helpers;

Class Miscellaneous {

    /**
     * Calculates percentage change between two different numbers
     * 
     * @param int $newNumber
     * @param int $oldNumber
     * 
     * @return int
     */
    function calculatePercentageChange(int $newNumber, int $oldNumber) : int
    {
        if ($oldNumber == 0) {
            $oldNumber++;
            $newNumber++;
        }

        $change = (($newNumber - $oldNumber) / $oldNumber) * 100;

        return (int) number_format($change, 2);
    }
}

?>