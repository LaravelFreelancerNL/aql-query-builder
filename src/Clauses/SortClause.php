<?php

namespace LaravelFreelancerNL\FluentAQL\Clauses;

use LaravelFreelancerNL\FluentAQL\Expressions\ExpressionInterface;
use LaravelFreelancerNL\FluentAQL\QueryBuilder;

class SortClause extends Clause
{
    /**
     * @var array $references
     */
    protected $references;

    public function __construct($references)
    {
        parent::__construct();

        $this->references = $references;
    }

    public function compile(QueryBuilder $queryBuilder): string
    {
        if (empty($this->references[0])) {
            return 'SORT null';
        }

        $this->references = array_map(function ($reference) use ($queryBuilder) {
            if (!$queryBuilder->grammar->isSortDirection($reference)) {
                return $queryBuilder->normalizeArgument($reference, ['Reference', 'Null', 'Query', 'Bind']);
            }
            return $reference;
        }, $this->references);

        $output = '';
        foreach ($this->references as $value) {
            if ($value instanceof ExpressionInterface) {
                $output .= ', ' . $value->compile($queryBuilder);
            }
            if (is_string($value)) {
                $output .= ' ' . $value;
            }
        }

        return 'SORT ' . ltrim($output, ', ');
    }
}
