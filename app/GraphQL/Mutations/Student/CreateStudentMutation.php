<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateStudentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createStudent',
        'description' => 'Create a new student'
    ];

    public function type(): Type
    {
        return GraphQL::type('Student');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'age' => [
                'name' => 'age',
                'type' => Type::nonNull(Type::int())
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $student = new Student();
        $student->fill($args);
        $student->save();

        return $student;
    }
}
