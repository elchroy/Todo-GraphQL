<?php

namespace App\Http\GraphQL\Mutations;

use App\Todo;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TodoMutator
{
    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function createTodo($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        # Args contains all the passed-in parameters and the 'directive'
        
        $data = $this->processTodoInput($args);
        return Todo::create($data);
    }

    public function updateTodo($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        // Args contains all the passed-in parameters and the 'directive'
        
        $data = $this->processTodoInput($args);
        $todo = Todo::find($args['id']);

        $todo->update($data);

        return $todo;
    }

    private function processTodoInput (array $args)
    {
        $data = [];

        if(isset($args['completed']))
            $data['completed'] = $args['completed'];
        if(isset($args['title']))
            $data['title'] = $args['title'];
        if(isset($args['description']))
            $data['description'] = $args['description'];
        if(isset($args['deadline']))
            $data['deadline'] = $args['deadline'];

        return $data;
    }
}
