<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Request;

class CollectionRequestParams extends RequestParams implements CollectionRequestParamsInterface
{
   public function getDataFilters(): array
   {
      $filterName = $this->getFilterName();

      if(isset($this->query[$filterName])) {
         return $this->query[$filterName];
      }

      return [];
   }

   public function getPagination(): array
   {
      if(isset($this->parameters['pagination'])) {
         return $this->parameters['pagination'];
      }

      return [];
   }

   public function getSorting(): array
   {
      if(isset($this->parameters['sorting'])) {
         return $this->parameters['sorting'];
      }

      return [];
   }

   public function getSort(): array
   {
      $sortName = $this->getSortName();

      if (isset($this->query[$sortName])) {
         return $this->query[$sortName];
      }

      if(isset($this->parameters['default_sort'])) {
         return $this->parameters['default_sort'];
      }

      return [];
   }

   private function getFilterName(): string
   {
      $pagination = $this->getPagination();

      if($pagination && isset($pagination['param_filter_name'])) {
         return $pagination['param_filter_name'];
      }

      return 'filters';
   }

   private function getSortName(): string
   {
      $pagination = $this->getSorting();

      if($pagination && isset($pagination['param_sort_name'])) {
         return $pagination['param_sort_name'];
      }

      return 'sort';
   }
}
