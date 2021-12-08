<?php
namespace App\Http\Requests\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\Response;

trait HasSortRequest {
    protected function passedValidation()
    {
        if(!in_array($this->sort_by, $this->allowedColumns) && $this->sort_by !== null) {
            throw new HttpResponseException(Response::custom([
                'errors' => [
                    'The selected sort by is invalid.',
                ]
            ], 'validation_error', Response::HTTP_UNPROCESSABLE_ENTITY));
        }

        if(array_key_exists($this->sort_by, $this->mutateColumns)){
            $this->sort_by = $this->mutateColumns[$this->sort_by];
        }

        $this->replace([
            'sort_order' => $this->sort_order,
            'sort_by' => $this->sort_by
        ]);
    }
}
?>