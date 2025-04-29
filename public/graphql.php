<?php
require __DIR__ . '/../vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$queryType = new ObjectType([
  'name' => 'Query',
  'fields' => [
    'status' => [
      'type' => Type::string(),
      'resolve' => fn() => 'OK'
    ],
    // Add additional fields as needed
  ]
]);

$schema = new Schema(['query' => $queryType]);

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
$query = $input['query'];
$variableValues = $input['variables'] ?? null;

try {
  $result = GraphQL::executeQuery($schema, $query, null, null, $variableValues);
  $output = $result->toArray();
} catch (\Exception $e) {
  $output = ['error' => ['message' => $e->getMessage()]];
}

header('Content-Type: application/json');
echo json_encode($output);