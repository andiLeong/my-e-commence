<?php
namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Str;

Abstract class Filter
{
    protected $data;

    public function handle($data  , Closure $next  )
    {
        logger('called');
        $this->data = $data;
        if( !isset($data[  $this->getFilterName() ]) ){
            return $next($data);
        }

        return $this->apply($data['builder']);
    }


    protected function getFilterName()
    {
        return Str::snake(class_basename( $this ));
    }


    abstract public function apply($builder);

}
