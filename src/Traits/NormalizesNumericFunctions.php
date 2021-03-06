<?php

namespace LaravelFreelancerNL\FluentAQL\Traits;

use LaravelFreelancerNL\FluentAQL\QueryBuilder;

trait NormalizesNumericFunctions
{
    abstract protected function normalizeArrays(QueryBuilder $queryBuilder);

    protected function normalizeAverage(QueryBuilder $queryBuilder)
    {
        $this->normalizeArrays($queryBuilder);
    }

    protected function normalizeMax(QueryBuilder $queryBuilder)
    {
        $this->normalizeArrays($queryBuilder);
    }

    protected function normalizeMin(QueryBuilder $queryBuilder)
    {
        $this->normalizeArrays($queryBuilder);
    }

    protected function normalizeSum(QueryBuilder $queryBuilder)
    {
        $this->normalizeArrays($queryBuilder);
    }
}
