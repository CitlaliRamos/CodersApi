<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTrait{
    public function scopeIncluded(Builder $query){

        /*if (empty($this->allowIncluded) || empty(request('included'))){
            return;
        }
        $relations = explode(',',request('included'));//['post','relación 2']
        $allowIncluded = collect($this->allowIncluded);
        foreach($relations as $key => $relation){
            if(!$allowIncluded->contains($relation)){
                unset($relations[$key]);
            }
        }
        $query->with($relations);*/

        if (!empty($this->allowIncluded)){
            $relations = explode(',',request('included'));//['post','relación 2']
            $allowIncluded = collect($this->allowIncluded); 
            foreach($relations as $key => $relation){
                if(!$allowIncluded->contains($relation)){
                    unset($relations[$key]);
                }
            }
            $query->with($relations);
        }

    }

    public function scopeFilter(Builder $query){
        /*if (empty($this->allowFilter) || empty(request('filter'))){
            return;
        }
        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);
        foreach($filters as $filter => $value){
            if($allowFilter->contains($filter)){
                $query->where($filter, 'LIKE', '%'.$value.'%' );
            }
        }*/
        if (empty($this->allowFilter) || empty(request('filter'))){
            return;
        }
        $filters = request('filter');

        $allowFilter = collect($this->allowFilter)->filter(function($field) use ($filters){
            return array_key_exists($field, $filters);
        });

        $allowFilter->each(function($field) use ($filters, $query){
            $query->where($field, 'LIKE', '%'.$filters[$field].'%');
        });
    }

    public function scopeSort(Builder $query){
        if (empty($this->allowSort) || empty(request('sort'))){
            return;
        }

        $sortFields = explode(',',request('sort'));
        $allowSort = collect($this->allowSort);
        foreach($sortFields as $sortField){
            $direccion='asc';
            if(substr($sortField,0,1)=='-'){
                $direccion='desc';
                $sortField=substr($sortField,1);
            }
            if($allowSort->contains($sortField)){
                $query->orderBy($sortField, $direccion);
            }
        }
    }
    
    public function scopeGetOrPaginate(Builder $query){
        if(request('perPage')){
            $perPage=intval(request('perPage'));
            if($perPage){
                return $query->paginate($perPage);
            }   
        }
        return $query->get();
    }
}