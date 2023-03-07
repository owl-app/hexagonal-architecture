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

   private function getFilterName(): string
   {
      $pagination = $this->getPagination();

      if($pagination && isset($pagination['param_filter_name'])) {
         return $pagination['param_filter_name'];
      }

      return 'filters';
   }

   public function getPagination(): array
   {
      if(isset($this->parameters['pagination'])) {
         return $this->parameters['pagination'];
      }

      return [];
   }
}
