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

   public function hasPagination(): bool
   {
      if(\is_bool($this->parameters['pagination']) && !$this->parameters['pagination']) {
         return false;
      }

      return true;
   }

   public function getPagination(): array
   {
      if(isset($this->parameters['pagination']) && is_array($this->parameters['pagination'])) {
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

   public function getSort(string $paramName): array
   {
      if (isset($this->query[$paramName])) {
         return $this->query[$paramName];
      }

      return [];
   }

   public function getPerPage(): int
   {
      $perPageName = $this->getPerPageName();

      if (isset($this->query[$perPageName])) {
         return (int) $this->query[$perPageName];
      }

      return $this->getDefaultPerPage();
   }

   public function getPage(): int
   {
      $pageName = $this->getPageName();

      if (isset($this->query[$pageName])) {
         return (int) $this->query[$pageName];
      }

      return 1;
   }

   public function getOffset(): int
   {
      return ($this->getPage() - 1) * $this->getPerPage();
   }

   private function getFilterName(): string
   {
      $pagination = $this->getPagination();

      if($pagination && isset($pagination['param_filter_name'])) {
         return $pagination['param_filter_name'];
      }

      return 'filters';
   }

   private function getPerPageName(): string
   {
      $pagination = $this->getPagination();

      if($pagination && isset($pagination['param_per_page_name'])) {
         return $pagination['param_per_page_name'];
      }

      return 'per-page';
   }

   private function getPageName(): string
   {
      $pagination = $this->getPagination();

      if($pagination && isset($pagination['param_page_name'])) {
         return $pagination['param_page_name'];
      }

      return 'page';
   }

   private function getDefaultPerPage(): int
   {
      $pagination = $this->getPagination();

      if($pagination && isset($pagination['default_per_page'])) {
         return (int) $pagination['default_per_page'];
      }

      return 10;
   }
}
