<?php

namespace App\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class Greetings implements QueryInterface
{
    public function __invoke(ResolveInfo $info, string $name): string
    {
        if ($info->fieldName === 'hello') {
            return sprintf('hello %s!!!', $name);
        } elseif ($info->fieldName === 'goodbye') {
            return sprintf('goodbye %s!!!', $name);
        } else {
            throw new \DomainException('Unknown greetings');
        }
    }
}