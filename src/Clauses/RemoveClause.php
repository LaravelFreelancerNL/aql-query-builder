<?php

namespace LaravelFreelancerNL\FluentAQL\Clauses;

use LaravelFreelancerNL\FluentAQL\QueryBuilder;

class RemoveClause extends Clause
{
    protected $document;

    protected $collection;

    public function __construct($document, $collection)
    {
        parent::__construct();

        $this->document = $document;
        $this->collection = $collection;
    }

    public function compile(QueryBuilder $queryBuilder): string
    {
        $this->document = $queryBuilder->normalizeArgument(
            $this->document,
            ['RegisteredVariable', 'Key', 'Object', 'Bind']
        );
        $queryBuilder->registerCollections($this->collection);
        $this->collection = $queryBuilder->normalizeArgument($this->collection, ['Collection', 'Bind']);

        return "REMOVE {$this->document->compile($queryBuilder)} IN {$this->collection->compile($queryBuilder)}";
    }
}
