<?php
namespace App\QueryFilters;


class CategoryId extends Filter
{
    public function apply($builder)
    {
        return $builder->where('category_id' , $this->data[$this->getFilterName()]);
    }
}
