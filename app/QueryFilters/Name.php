<?php
namespace App\QueryFilters;


class Name extends Filter
{
    public function apply($builder)
    {
        return $builder->where( $this->getFilterName() , 'LIKE' , '%' . $this->data[$this->getFilterName()]. '%');
    }
}
