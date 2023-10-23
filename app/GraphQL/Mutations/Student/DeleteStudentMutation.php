<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteStudentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteStudent',
        'description' => 'Delete a student'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['exists:students']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $student = Student::findOrFail($args['id']);
        return $student->delete() ? true : false;
    }
}
